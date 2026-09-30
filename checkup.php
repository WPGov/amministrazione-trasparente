<?php
/**
 * Configuration checkup panel, shared by the "Revisione" screen and the
 * "Gestione sezioni" settings tab.
 *
 * Leaves $atTerms defined for settings.php, which builds its group editor from it.
 *
 * @package AmministrazioneTrasparente
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$atTerms = get_terms(
	array(
		'taxonomy'   => 'tipologie',
		'parent'     => 0,
		'hide_empty' => false,
	)
);
if ( is_wp_error( $atTerms ) ) {
	$atTerms = array();
}

$at_tree  = at_get_revision_tree();
$at_total = count( $at_tree['terms'] );

/**
 * Render one line of the checkup list.
 *
 * $modal_body is markup built from escaped fragments; it is shown inside a modal.
 */
if ( ! function_exists( 'at_checkup_row' ) ) :
function at_checkup_row( $ok, $label, $detail = '', $modal_title = '', $modal_body = '' ) {
	printf(
		'<li><span class="dashicons dashicons-%s %s" aria-hidden="true"></span> <strong>%s</strong>',
		$ok ? 'yes-alt' : 'warning',
		$ok ? 'at-ok' : 'at-warn',
		esc_html( $label )
	);

	if ( $detail ) {
		echo ' <span class="at-muted">— ' . esc_html( $detail ) . '</span>';
	}

	if ( $modal_body ) {
		printf(
			' <a href="#" class="at-open-modal" data-modal-title="%s" data-modal-content="%s">%s</a>',
			esc_attr( $modal_title ),
			esc_attr( $modal_body ),
			esc_html__( 'Dettagli', 'amministrazione-trasparente' )
		);
	}

	echo '</li>';
}
endif;

// --- Check 1: are there any sections at all? ---
$at_checks_failed = 0;

// --- Check 2: sections not reachable from any group ---
$at_orphans_body = '';
foreach ( $at_tree['orphans'] as $term_id ) {
	$term = $at_tree['terms'][ $term_id ];
	$at_orphans_body .= '- <b>' . esc_html( $term->name ) . '</b><br>';
}

// --- Check 3: sections configured in more than one group ---
$at_duplicates_body = '';
foreach ( $at_tree['duplicates'] as $term_id => $group_names ) {
	$term = $at_tree['terms'][ $term_id ];
	$at_duplicates_body .= '- <b>' . esc_html( $term->name ) . '</b> <span class="at-muted">('
		. esc_html( implode( ', ', $group_names ) ) . ')</span><br>';
}

// --- Check 4: documents with no section ---
$at_no_term_query = new WP_Query(
	array(
		'post_type'      => 'amm-trasparente',
		'post_status'    => array( 'publish', 'draft', 'pending', 'future', 'private' ),
		'posts_per_page' => 20,
		'fields'         => 'ids',
		'tax_query'      => array(
			array(
				'taxonomy' => 'tipologie',
				'operator' => 'NOT EXISTS',
			),
		),
	)
);
$at_no_term_count = (int) $at_no_term_query->found_posts;

$at_no_term_body = '';
foreach ( $at_no_term_query->posts as $post_id ) {
	$at_no_term_body .= '- <a href="' . esc_url( get_edit_post_link( $post_id ) ) . '">'
		. esc_html( get_the_title( $post_id ) ) . '</a> <span class="at-muted">('
		. esc_html( get_the_date( 'd/m/Y', $post_id ) ) . ' – '
		. esc_html( get_the_author_meta( 'display_name', get_post_field( 'post_author', $post_id ) ) )
		. ')</span><br>';
}
if ( $at_no_term_count > count( $at_no_term_query->posts ) ) {
	$at_no_term_body .= '<span class="at-muted">…e altri ' . esc_html( $at_no_term_count - count( $at_no_term_query->posts ) ) . '</span>';
}
wp_reset_postdata();

// --- Check 5: group configuration pointing at deleted terms ---
$at_stale_count = count( $at_tree['stale'] );

$at_checks_failed = ( 0 === $at_total ? 1 : 0 )
	+ ( $at_tree['orphans'] ? 1 : 0 )
	+ ( $at_tree['duplicates'] ? 1 : 0 )
	+ ( $at_no_term_count ? 1 : 0 )
	+ ( $at_stale_count ? 1 : 0 );
?>

<div class="notice notice-<?php echo $at_checks_failed ? 'warning' : 'success'; ?> inline at-checkup">
	<p>
		<strong><?php esc_html_e( 'Stato della configurazione', 'amministrazione-trasparente' ); ?></strong>
		<?php if ( $at_checks_failed ) : ?>
			<span class="at-muted">
				<?php
				printf(
					esc_html( _n( '— %d punto da verificare', '— %d punti da verificare', $at_checks_failed, 'amministrazione-trasparente' ) ),
					(int) $at_checks_failed
				);
				?>
			</span>
		<?php endif; ?>
	</p>
	<ul>
		<?php
		at_checkup_row(
			$at_total > 0,
			sprintf(
				/* translators: %d: number of sections. */
				esc_html( _n( '%d sezione gestita', '%d sezioni gestite', $at_total, 'amministrazione-trasparente' ) ),
				$at_total
			),
			$at_total ? '' : __( 'Nessuna tipologia trovata', 'amministrazione-trasparente' )
		);

		at_checkup_row(
			empty( $at_tree['orphans'] ),
			empty( $at_tree['orphans'] )
				? __( 'Tutte le sezioni sono assegnate a un gruppo', 'amministrazione-trasparente' )
				: sprintf(
					/* translators: %d: number of sections. */
					esc_html( _n( '%d sezione non assegnata a un gruppo', '%d sezioni non assegnate a un gruppo', count( $at_tree['orphans'] ), 'amministrazione-trasparente' ) ),
					count( $at_tree['orphans'] )
				),
			empty( $at_tree['orphans'] ) ? '' : __( 'non compaiono nella pagina pubblica', 'amministrazione-trasparente' ),
			__( 'Sezioni senza gruppo', 'amministrazione-trasparente' ),
			$at_orphans_body
		);

		at_checkup_row(
			empty( $at_tree['duplicates'] ),
			empty( $at_tree['duplicates'] )
				? __( 'Nessuna sezione duplicata fra i gruppi', 'amministrazione-trasparente' )
				: sprintf(
					/* translators: %d: number of sections. */
					esc_html( _n( '%d sezione presente in più gruppi', '%d sezioni presenti in più gruppi', count( $at_tree['duplicates'] ), 'amministrazione-trasparente' ) ),
					count( $at_tree['duplicates'] )
				),
			empty( $at_tree['duplicates'] ) ? '' : __( 'verificare se intenzionale', 'amministrazione-trasparente' ),
			__( 'Sezioni in più gruppi', 'amministrazione-trasparente' ),
			$at_duplicates_body
		);

		at_checkup_row(
			0 === $at_no_term_count,
			0 === $at_no_term_count
				? __( 'Tutti i documenti hanno una sezione', 'amministrazione-trasparente' )
				: sprintf(
					/* translators: %d: number of documents. */
					esc_html( _n( '%d documento senza sezione', '%d documenti senza sezione', $at_no_term_count, 'amministrazione-trasparente' ) ),
					$at_no_term_count
				),
			$at_no_term_count ? __( 'non raggiungibili dalla pagina pubblica', 'amministrazione-trasparente' ) : '',
			__( 'Documenti senza sezione', 'amministrazione-trasparente' ),
			$at_no_term_body
		);

		if ( $at_stale_count ) {
			at_checkup_row(
				false,
				sprintf(
					/* translators: %d: number of stale references. */
					esc_html( _n( '%d riferimento a una sezione eliminata', '%d riferimenti a sezioni eliminate', $at_stale_count, 'amministrazione-trasparente' ) ),
					$at_stale_count
				),
				__( 'ripulisci salvando la configurazione dei gruppi', 'amministrazione-trasparente' )
			);
		}
		?>
	</ul>
</div>
