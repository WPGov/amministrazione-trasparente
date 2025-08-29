<?php
/**
 * Checkup page for Amministrazione Trasparente plugin.
 *
 * @package AmministrazioneTrasparente
 */
$selected_sections = [];
$selected_sections_unique = [];

$atTerms = get_terms([
    'taxonomy'   => 'tipologie',
    'parent'     => 0,
    'hide_empty' => false,
]);

if ( is_array( at_getGroupConf() ) ) {
    foreach ( at_getGroupConf() as $arrayTipologie ) {
        $selected_sections = array_merge( $selected_sections, $arrayTipologie );
        $selected_sections_unique = array_unique( array_merge( $selected_sections, $arrayTipologie ) );
    }
}

$diff = array_diff_assoc( $selected_sections, array_unique( $selected_sections ) );
$alert_duplicates = esc_js( "Elenco duplicati:\n\n" );
if ( is_array( $diff ) && !empty( $diff ) ) {
    foreach ( $diff as $x ) {
        $duplicate_term = get_term_by( 'id', $x, 'tipologie' );
        if ( $duplicate_term && $duplicate_term->name ) {
            // Trova i gruppi (array) in cui si trova la duplicazione
            $contexts = [];
            foreach ( at_getGroupConf() as $group_slug => $arrayTipologie ) {
                if (in_array($x, $arrayTipologie)) {
                    $contexts[] = $group_slug;
                }
            }
            $context_str = '';
            if (!empty($contexts)) {
                $context_str = ' <span style=\"color:#888;font-size:0.95em;\">(' . implode(', ', array_map('esc_js', $contexts)) . ')</span>';
            }
            $alert_duplicates .= '- <b>' . esc_js( $duplicate_term->name ) . '</b>' . $context_str . '\n';
        }
    }
}

$green_svg = '<span style="color:green" aria-label="OK">&#x2714;</span>';
$red_svg = '<span style="color:red;" aria-label="Errore">&#x26A0;</span>';

$warning_count = '';
$alert_count = esc_js( "Elenco tipologie non associate:\n\n" );
if ( wp_count_terms( 'tipologie' ) != count( array_count_values( $selected_sections ) ) ) {
    foreach ( $atTerms as $term ) {
        if ( !in_array( $term->term_id, $selected_sections_unique ) ) {
            $alert_count .= '- <b>' . esc_js( $term->name ) . '</b>\n';
            if ( !empty( $selected_sections_unique ) ) {
                $max = max( array_keys( $selected_sections_unique ) );
                $selected_sections_unique[ ++$max ] = $term->term_id;
            }
        }
    }
    $warning_count = ' ' . esc_html( wp_count_terms( 'tipologie' ) - count( array_count_values( $selected_sections ) ) ) . ' tipologie non sono associate a un gruppo - <a href="#" class="at-open-modal" data-modal-content="' . esc_attr( str_replace('\n', '<br>', $alert_count) ) . '">Clicca qui per i dettagli</a>';
} else {
    $warning_count = $green_svg;
}

$warning_duplicates = '';
if ( ( count( $selected_sections ) - count( array_count_values( $selected_sections ) ) ) != 0 ) {
    $warning_duplicates = $red_svg . ' Verificare se intenzionale - <a href="#" class="at-open-modal" data-modal-content="' . esc_attr( str_replace('\n', '<br>', $alert_duplicates) ) . '">Clicca qui per i dettagli</a>';
} else {
    $warning_duplicates = $green_svg;
}
?>
<style>
    .at-checklist-table {
        margin-top: 32px;
        margin-bottom: 48px; /* Improved bottom margin */
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        font-family: system-ui, Arial, sans-serif;
        font-size: 1em;
    }
    .at-checklist-table th, .at-checklist-table td {
        padding: 14px 18px;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }
    .at-checklist-table th {
        background: #f7f7f7;
        font-weight: 600;
        text-align: left;
        letter-spacing: 0.02em;
    }
    .at-checklist-table tr:last-child td {
        border-bottom: none;
    }
    .at-checklist-status {
        text-align: center;
        width: 60px;
    }
    .at-checklist-details a {
        color: #1976d2;
        text-decoration: underline;
        font-size: 0.98em;
        word-break: break-word;
    }
    .at-checklist-details {
        font-size: 0.98em;
        word-break: break-word;
    }
    .at-modal-overlay {
        position: fixed;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0,0,0,0.3);
        z-index: 9999;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        transition: opacity 0.2s;
    }
    .at-modal-content {
        background: #fff;
        padding: 32px 28px;
        max-width: 480px;
        margin: 80px auto;
        border-radius: 8px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.12);
        position: relative;
        max-height: 80vh;
        overflow: auto;
        animation: at-modal-in 0.2s;
    }
    @keyframes at-modal-in {
        from { transform: translateY(-30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    .at-modal-close {
        position: absolute;
        top: 12px;
        right: 16px;
        font-size: 1.3em;
        background: none;
        border: none;
        cursor: pointer;
        color: #888;
        transition: color 0.2s;
    }
    .at-modal-close:hover {
        color: #d32f2f;
    }
</style>
<table class="at-checklist-table">
    <thead>
        <tr>
            <th><?php esc_html_e( 'Controllo', 'amministrazione-trasparente' ); ?></th>
            <th class="at-checklist-status"><?php esc_html_e( 'Esito', 'amministrazione-trasparente' ); ?></th>
            <th class="at-checklist-details"><?php esc_html_e( 'Dettagli', 'amministrazione-trasparente' ); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo esc_html( wp_count_terms( 'tipologie' ) ); ?> tipologie gestite</td>
            <td class="at-checklist-status"><?php echo ( wp_count_terms( 'tipologie' ) > 0 ? $green_svg : $red_svg ); ?></td>
            <td class="at-checklist-details"><?php echo ( wp_count_terms( 'tipologie' ) > 0 ? esc_html__('OK', 'amministrazione-trasparente') : esc_html__('Nessuna tipologia trovata', 'amministrazione-trasparente') ); ?></td>
        </tr>
        <tr>
            <td><?php echo esc_html( count( array_count_values( $selected_sections ) ) ); ?> tipologie correttamente associate a sezioni</td>
            <td class="at-checklist-status"><?php echo ( wp_count_terms( 'tipologie' ) == count( array_count_values( $selected_sections ) ) ? $green_svg : $red_svg ); ?></td>
            <td class="at-checklist-details">
                <?php
                if ( wp_count_terms( 'tipologie' ) != count( array_count_values( $selected_sections ) ) ) {
                    echo esc_html( wp_count_terms( 'tipologie' ) - count( array_count_values( $selected_sections ) ) ) . ' tipologie non associate - ';
                    echo '<a href="#" class="at-open-modal" data-modal-content="' . esc_attr( str_replace('\n', '<br>', $alert_count) ) . '">Dettagli</a>';
                } else {
                    echo esc_html__('Tutte associate', 'amministrazione-trasparente');
                }
                ?>
            </td>
        </tr>
        <tr>
            <td><?php echo esc_html( count( $selected_sections ) - count( array_count_values( $selected_sections ) ) ); ?> tipologie sono associate a più sezioni</td>
            <td class="at-checklist-status"><?php echo ( ( count( $selected_sections ) - count( array_count_values( $selected_sections ) ) ) == 0 ? $green_svg : $red_svg ); ?></td>
            <td class="at-checklist-details">
                <?php
                if ( ( count( $selected_sections ) - count( array_count_values( $selected_sections ) ) ) != 0 ) {
                    echo esc_html__('Verificare se intenzionale', 'amministrazione-trasparente') . ' - ';
                    echo '<a href="#" class="at-open-modal" data-modal-content="' . esc_attr( str_replace('\n', '<br>', $alert_duplicates) ) . '">Dettagli</a>';
                } else {
                    echo esc_html__('Nessun duplicato', 'amministrazione-trasparente');
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                // Count posts without "tipologie" taxonomy
                $no_term_args = [
                    'post_type'      => 'amm-trasparente',
                    'posts_per_page' => 20,
                    'tax_query'      => [
                        [
                            'taxonomy' => 'tipologie',
                            'operator' => 'NOT EXISTS',
                        ],
                    ],
                    'fields'         => 'ids',
                ];
                $no_term_query = new WP_Query($no_term_args);
                $no_term_count = $no_term_query->found_posts;
                echo esc_html($no_term_count) . ' documenti non categorizzati';
                ?>
            </td>
            <td class="at-checklist-status">
                <?php echo ($no_term_count == 0 ? $green_svg : $red_svg); ?>
            </td>
            <td class="at-checklist-details">
                <?php
                if ($no_term_count > 0) {
                    $details = '';
                    foreach ($no_term_query->posts as $post_id) {
                        $title = get_the_title($post_id);
                        $edit_link = get_edit_post_link($post_id);
                        $date = get_the_date('d/m/Y', $post_id);
                        $author_id = get_post_field('post_author', $post_id);
                        $author = get_the_author_meta('display_name', $author_id);
                        $details .= '- <a href="' . esc_url($edit_link) . '" style="color:#d32f2f;font-weight:bold;text-decoration:underline;">' . esc_html($title) . '</a>';
                        $details .= ' <span style="color:#888;font-size:0.95em;">(' . esc_html($date) . ' - ' . esc_html($author) . ')</span><br>';
                    }
                    if ($no_term_count > 20) {
                        $details .= '...e altri';
                    }
                    echo '<a href="#" class="at-open-modal" data-modal-content="' . esc_attr($details) . '">Dettagli</a>';
                } else {
                    echo esc_html__('Tutti i documenti hanno una tipologia', 'amministrazione-trasparente');
                }
                wp_reset_postdata();
                ?>
            </td>
        </tr>
    </tbody>
</table>
<!-- Modal JS (improved, dismissable by clicking outside or close button) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.at-open-modal').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var content = this.getAttribute('data-modal-content');
            var overlay = document.createElement('div');
            overlay.className = 'at-modal-overlay';
            overlay.innerHTML = '<div class="at-modal-content">'
                + '<button class="at-modal-close" aria-label="Chiudi" title="Chiudi">&times;</button>'
                + '<div>' + content + '</div></div>';
            document.body.appendChild(overlay);

            // Close on button click
            overlay.querySelector('.at-modal-close').onclick = function() {
                overlay.remove();
            };
            // Close on click outside modal content
            overlay.addEventListener('click', function(ev) {
                if (ev.target === overlay) {
                    overlay.remove();
                }
            });
            // Optional: close on ESC key
            document.addEventListener('keydown', function escListener(ev) {
                if (ev.key === 'Escape') {
                    overlay.remove();
                    document.removeEventListener('keydown', escListener);
                }
            });
        });
    });
});
</script>