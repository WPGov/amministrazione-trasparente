<?php
/**
 * "Revisione" screen: one row per section, grouped the way the public page is.
 *
 * @package AmministrazioneTrasparente
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** Documents older than this are flagged as needing a review. */
if ( ! defined( 'AT_REVIEW_YEARS' ) ) {
	define( 'AT_REVIEW_YEARS', 5 );
}

if ( ! function_exists( 'at_count_posts_by_term_status' ) ) {
	/**
	 * Count documents in a section for a given status.
	 */
	function at_count_posts_by_term_status( $term_id, $status = 'publish' ) {
		$query = new WP_Query(
			array(
				'post_type'      => 'amm-trasparente',
				'post_status'    => $status,
				'posts_per_page' => 1,
				'fields'         => 'ids',
				'no_found_rows'  => false,
				'tax_query'      => array(
					array(
						'taxonomy' => 'tipologie',
						'field'    => 'term_id',
						'terms'    => $term_id,
					),
				),
			)
		);

		return (int) $query->found_posts;
	}
}

if ( ! function_exists( 'at_count_old_posts_by_term' ) ) {
	/**
	 * Count published documents in a section older than $years.
	 */
	function at_count_old_posts_by_term( $term_id, $years = AT_REVIEW_YEARS ) {
		$query = new WP_Query(
			array(
				'post_type'      => 'amm-trasparente',
				'post_status'    => 'publish',
				'posts_per_page' => 1,
				'fields'         => 'ids',
				'tax_query'      => array(
					array(
						'taxonomy' => 'tipologie',
						'field'    => 'term_id',
						'terms'    => $term_id,
					),
				),
				'date_query'     => array(
					array(
						'column' => 'post_date',
						'before' => date( 'Y-m-d', strtotime( '-' . (int) $years . ' years' ) ),
					),
				),
			)
		);

		return (int) $query->found_posts;
	}
}

if ( ! function_exists( 'at_revision_url' ) ) {
	/**
	 * Build a URL back to this screen, keeping the other filters intact.
	 */
	function at_revision_url( $args = array() ) {
		$base = array(
			'post_type' => 'amm-trasparente',
			'page'      => 'at_tipologie_dashboard',
		);

		return add_query_arg( array_filter( array_merge( $base, $args ), 'strlen' ), admin_url( 'edit.php' ) );
	}
}

$at_tree = at_get_revision_tree();

// --- Current filters -------------------------------------------------------
$at_view   = isset( $_GET['at_view'] ) ? sanitize_key( $_GET['at_view'] ) : 'all';
$at_group  = isset( $_GET['at_group'] ) ? sanitize_title( $_GET['at_group'] ) : '';
$at_search = isset( $_GET['at_search'] ) ? sanitize_text_field( wp_unslash( $_GET['at_search'] ) ) : '';

if ( ! in_array( $at_view, array( 'all', 'draft', 'old', 'empty' ), true ) ) {
	$at_view = 'all';
}

// --- Pass 1: collect every section with its counters ------------------------
$at_sections = array();
$at_totals   = array( 'all' => 0, 'draft' => 0, 'old' => 0, 'empty' => 0 );
$at_counted  = array();

/**
 * Flatten a section and its descendants into $at_sections.
 */
$at_collect = function ( $term_id, $group, $depth ) use ( &$at_collect, $at_tree, &$at_sections, &$at_totals, &$at_counted ) {
	if ( ! isset( $at_tree['terms'][ $term_id ] ) ) {
		return;
	}

	$term = $at_tree['terms'][ $term_id ];

	// $term->count already holds the number of published documents.
	$published = (int) $term->count;
	$draft     = at_count_posts_by_term_status( $term_id, 'draft' );
	$old       = at_count_old_posts_by_term( $term_id );

	$at_sections[] = array(
		'term'      => $term,
		'group'     => $group,
		'depth'     => $depth,
		'published' => $published,
		'draft'     => $draft,
		'old'       => $old,
	);

	// Count each section once, even when it is configured in several groups.
	if ( ! isset( $at_counted[ $term_id ] ) ) {
		$at_counted[ $term_id ] = true;

		$at_totals['all']++;
		if ( $draft ) {
			$at_totals['draft']++;
		}
		if ( $old ) {
			$at_totals['old']++;
		}
		if ( ! $published ) {
			$at_totals['empty']++;
		}
	}

	if ( isset( $at_tree['children'][ $term_id ] ) ) {
		foreach ( $at_tree['children'][ $term_id ] as $child_id ) {
			$at_collect( $child_id, $group, $depth + 1 );
		}
	}
};

foreach ( $at_tree['groups'] as $at_group_def ) {
	foreach ( $at_group_def['term_ids'] as $term_id ) {
		$at_collect( $term_id, $at_group_def, 0 );
	}
}

$at_no_group = array(
	'name' => __( 'Senza gruppo', 'amministrazione-trasparente' ),
	'slug' => 'senza-gruppo',
);
foreach ( $at_tree['orphans'] as $term_id ) {
	if ( isset( $at_tree['terms'][ $term_id ] ) && 0 === (int) $at_tree['terms'][ $term_id ]->parent ) {
		$at_collect( $term_id, $at_no_group, 0 );
	}
}

// --- Pass 2: apply the filters ---------------------------------------------
$at_visible = array_filter(
	$at_sections,
	function ( $row ) use ( $at_view, $at_group, $at_search ) {
		if ( $at_group && $row['group']['slug'] !== $at_group ) {
			return false;
		}
		if ( $at_search && false === stripos( $row['term']->name, $at_search ) ) {
			return false;
		}
		if ( 'draft' === $at_view && ! $row['draft'] ) {
			return false;
		}
		if ( 'old' === $at_view && ! $row['old'] ) {
			return false;
		}
		if ( 'empty' === $at_view && $row['published'] ) {
			return false;
		}

		return true;
	}
);

$at_filtered = ( 'all' !== $at_view || $at_group || '' !== $at_search );

$at_views = array(
	'all'   => __( 'Tutte', 'amministrazione-trasparente' ),
	'draft' => __( 'Con bozze', 'amministrazione-trasparente' ),
	'old'   => sprintf(
		/* translators: %d: number of years. */
		__( 'Da rivedere (oltre %d anni)', 'amministrazione-trasparente' ),
		AT_REVIEW_YEARS
	),
	'empty' => __( 'Senza documenti', 'amministrazione-trasparente' ),
);
?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php esc_html_e( 'Revisione', 'amministrazione-trasparente' ); ?></h1>
	<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=amm-trasparente' ) ); ?>" class="page-title-action">
		<?php esc_html_e( 'Aggiungi documento', 'amministrazione-trasparente' ); ?>
	</a>
	<p class="description">
		<?php esc_html_e( 'Panoramica di tutte le sezioni di Amministrazione Trasparente, nell\'ordine in cui compaiono nella pagina pubblica. Usa i filtri per trovare le sezioni che richiedono attenzione.', 'amministrazione-trasparente' ); ?>
	</p>
	<hr class="wp-header-end">

	<?php require 'checkup.php'; ?>

	<ul class="subsubsub">
		<?php
		$at_keys = array_keys( $at_views );
		$at_last = end( $at_keys );
		foreach ( $at_views as $at_key => $at_label ) :
			$at_url = at_revision_url(
				array(
					'at_view'   => 'all' === $at_key ? '' : $at_key,
					'at_group'  => $at_group,
					'at_search' => $at_search,
				)
			);
			?>
			<li>
				<a href="<?php echo esc_url( $at_url ); ?>" <?php echo $at_view === $at_key ? 'class="current" aria-current="page"' : ''; ?>>
					<?php echo esc_html( $at_label ); ?>
					<span class="count">(<?php echo (int) $at_totals[ $at_key ]; ?>)</span>
				</a><?php echo $at_key === $at_last ? '' : ' |'; ?>
			</li>
		<?php endforeach; ?>
	</ul>

	<form method="get" action="<?php echo esc_url( admin_url( 'edit.php' ) ); ?>" class="search-form wp-clearfix">
		<input type="hidden" name="post_type" value="amm-trasparente">
		<input type="hidden" name="page" value="at_tipologie_dashboard">
		<input type="hidden" name="at_view" value="<?php echo esc_attr( 'all' === $at_view ? '' : $at_view ); ?>">

		<p class="search-box">
			<label class="screen-reader-text" for="at_group"><?php esc_html_e( 'Filtra per gruppo', 'amministrazione-trasparente' ); ?></label>
			<select name="at_group" id="at_group">
				<option value=""><?php esc_html_e( 'Tutti i gruppi', 'amministrazione-trasparente' ); ?></option>
				<?php foreach ( $at_tree['groups'] as $at_group_def ) : ?>
					<option value="<?php echo esc_attr( $at_group_def['slug'] ); ?>" <?php selected( $at_group, $at_group_def['slug'] ); ?>>
						<?php echo esc_html( $at_group_def['name'] ); ?>
					</option>
				<?php endforeach; ?>
				<?php if ( $at_tree['orphans'] ) : ?>
					<option value="senza-gruppo" <?php selected( $at_group, 'senza-gruppo' ); ?>>
						<?php esc_html_e( 'Senza gruppo', 'amministrazione-trasparente' ); ?>
					</option>
				<?php endif; ?>
			</select>

			<label class="screen-reader-text" for="at_search"><?php esc_html_e( 'Cerca sezione', 'amministrazione-trasparente' ); ?></label>
			<input type="search" name="at_search" id="at_search" value="<?php echo esc_attr( $at_search ); ?>"
				placeholder="<?php esc_attr_e( 'Nome della sezione…', 'amministrazione-trasparente' ); ?>">

			<input type="submit" class="button" value="<?php esc_attr_e( 'Filtra', 'amministrazione-trasparente' ); ?>">

			<?php if ( $at_filtered ) : ?>
				<a href="<?php echo esc_url( at_revision_url() ); ?>" class="button-link">
					<?php esc_html_e( 'Azzera filtri', 'amministrazione-trasparente' ); ?>
				</a>
			<?php endif; ?>
		</p>
	</form>

	<table class="wp-list-table widefat striped at-table">
		<thead>
			<tr>
				<th scope="col"><?php esc_html_e( 'Sezione', 'amministrazione-trasparente' ); ?></th>
				<th scope="col" class="at-num"><?php esc_html_e( 'Pubblicati', 'amministrazione-trasparente' ); ?></th>
				<th scope="col" class="at-num"><?php esc_html_e( 'Bozze', 'amministrazione-trasparente' ); ?></th>
				<th scope="col" class="at-num at-num-wide">
					<?php esc_html_e( 'Da rivedere', 'amministrazione-trasparente' ); ?>
					<span class="at-muted"><?php
						printf(
							/* translators: %d: number of years. */
							esc_html__( '(oltre %d anni)', 'amministrazione-trasparente' ),
							(int) AT_REVIEW_YEARS
						);
					?></span>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php if ( empty( $at_visible ) ) : ?>
			<tr>
				<td colspan="4" class="at-empty-state">
					<p><strong><?php esc_html_e( 'Nessuna sezione corrisponde ai filtri.', 'amministrazione-trasparente' ); ?></strong></p>
					<?php if ( $at_filtered ) : ?>
						<a href="<?php echo esc_url( at_revision_url() ); ?>" class="button"><?php esc_html_e( 'Azzera filtri', 'amministrazione-trasparente' ); ?></a>
					<?php else : ?>
						<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=amm-trasparente&page=wpgov_at&at_action=config' ) ); ?>" class="button">
							<?php esc_html_e( 'Configura le sezioni', 'amministrazione-trasparente' ); ?>
						</a>
					<?php endif; ?>
				</td>
			</tr>
		<?php else : ?>
			<?php
			$at_last_group = null;
			foreach ( $at_visible as $at_row ) :
				$at_term      = $at_row['term'];
				$at_list_link = admin_url( 'edit.php?post_type=amm-trasparente&tipologie=' . $at_term->slug );
				$at_term_link = get_term_link( $at_term );

				if ( $at_last_group !== $at_row['group']['slug'] ) :
					$at_last_group = $at_row['group']['slug'];
					?>
					<tr class="at-group">
						<td colspan="4">
							<?php echo esc_html( $at_row['group']['name'] ); ?>
							<?php if ( ! $at_group ) : ?>
								<a class="at-group-meta" href="<?php echo esc_url( at_revision_url( array( 'at_group' => $at_row['group']['slug'], 'at_view' => 'all' === $at_view ? '' : $at_view ) ) ); ?>">
									<?php esc_html_e( 'Mostra solo questo gruppo', 'amministrazione-trasparente' ); ?>
								</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endif; ?>

				<tr>
					<td>
						<?php if ( $at_row['depth'] ) : ?>
							<span class="at-depth" aria-hidden="true"><?php echo str_repeat( '— ', (int) $at_row['depth'] ); ?></span>
						<?php endif; ?>
						<strong><a href="<?php echo esc_url( $at_list_link ); ?>"><?php echo esc_html( $at_term->name ); ?></a></strong>
						<div class="row-actions">
							<?php if ( ! is_wp_error( $at_term_link ) ) : ?>
								<span class="view">
									<a href="<?php echo esc_url( $at_term_link ); ?>" target="_blank" rel="noopener">
										<?php esc_html_e( 'Vedi nel sito', 'amministrazione-trasparente' ); ?>
									</a> |
								</span>
							<?php endif; ?>
							<span class="edit">
								<a href="<?php echo esc_url( admin_url( 'term.php?taxonomy=tipologie&post_type=amm-trasparente&tag_ID=' . $at_term->term_id ) ); ?>">
									<?php esc_html_e( 'Modifica sezione', 'amministrazione-trasparente' ); ?>
								</a>
							</span>
						</div>
					</td>

					<td class="at-num">
						<?php if ( $at_row['published'] ) : ?>
							<a href="<?php echo esc_url( $at_list_link . '&post_status=publish' ); ?>"
								aria-label="<?php echo esc_attr( sprintf( __( '%1$d documenti pubblicati in %2$s', 'amministrazione-trasparente' ), $at_row['published'], $at_term->name ) ); ?>">
								<?php echo (int) $at_row['published']; ?>
							</a>
						<?php else : ?>
							<span class="at-muted" title="<?php esc_attr_e( 'Nessun documento pubblicato', 'amministrazione-trasparente' ); ?>">—</span>
						<?php endif; ?>
					</td>

					<td class="at-num">
						<?php if ( $at_row['draft'] ) : ?>
							<a href="<?php echo esc_url( $at_list_link . '&post_status=draft' ); ?>"
								aria-label="<?php echo esc_attr( sprintf( __( '%1$d bozze in %2$s', 'amministrazione-trasparente' ), $at_row['draft'], $at_term->name ) ); ?>">
								<?php echo (int) $at_row['draft']; ?>
							</a>
						<?php else : ?>
							<span class="at-muted">—</span>
						<?php endif; ?>
					</td>

					<td class="at-num at-num-wide">
						<?php if ( $at_row['old'] ) : ?>
							<a class="at-warn" href="<?php echo esc_url( $at_list_link . '&at_older_than=' . AT_REVIEW_YEARS ); ?>"
								aria-label="<?php echo esc_attr( sprintf( __( '%1$d documenti da rivedere in %2$s', 'amministrazione-trasparente' ), $at_row['old'], $at_term->name ) ); ?>">
								<?php echo (int) $at_row['old']; ?>
							</a>
						<?php else : ?>
							<span class="at-muted">—</span>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		</tbody>
	</table>
</div>
