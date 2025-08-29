<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

    <div class="wrap">
        <h1 style="margin-bottom: 0.2em;">
            <span style="display:block;font-size:1em;font-weight:400;color:#555;">Revisione</span>
        </h1>

        <?php
        
        require 'checkup.php';

        // Get all groups for the filter dropdown
        $all_terms = get_terms([
            'taxonomy' => 'tipologie',
            'hide_empty' => false,
        ]);
        $groups = [];
        if (function_exists('at_getGroupNameByTerm')) {
            foreach ($all_terms as $term) {
                $group = at_getGroupNameByTerm($term->term_id);
                if ($group && !in_array($group, $groups)) {
                    $groups[] = $group;
                }
            }
        }
        $selected_group = isset($_GET['at_group']) ? sanitize_text_field($_GET['at_group']) : '';
        $search_value = isset($_GET['at_search']) ? esc_attr($_GET['at_search']) : '';
        $filters_active = ($selected_group !== '' || $search_value !== '');
        ?>
        <form method="get" action="<?php echo esc_url( admin_url('edit.php') ); ?>" style="margin-bottom:16px;display:flex;flex-wrap:wrap;gap:8px;align-items:center;">
            <input type="hidden" name="post_type" value="amm-trasparente">
            <input type="hidden" name="page" value="at_tipologie_dashboard">
            <label for="at_group">Filtra per gruppo:</label>
            <select name="at_group" id="at_group" onchange="this.form.submit()">
                <option value="">Tutti i gruppi</option>
                <?php foreach ($groups as $group): ?>
                    <option value="<?php echo esc_attr($group); ?>" <?php selected($selected_group, $group); ?>>
                        <?php echo esc_html($group); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="at_search">Cerca termine:</label>
            <input type="text" name="at_search" id="at_search" value="<?php echo $search_value; ?>" placeholder="Nome termine..." style="margin-right:8px;">

            <input type="submit" class="button button-primary" value="Filtra">

            <?php if ($filters_active): ?>
                <a href="<?php echo esc_url( admin_url('edit.php?post_type=amm-trasparente&page=at_tipologie_dashboard') ); ?>" class="button" style="margin-left:8px;">Rimuovi filtri</a>
            <?php endif; ?>
        </form>

        <style>
            .at-group-row {
                background-color: #23282d !important;
                color: #fff !important;
                font-weight: bold;
                font-size: 1.1em;
                border-top: 2px solid #2271b1;
                padding: 12px 8px;
            }
            .at-group-row td {
                background-color: #23282d !important;
                color: #fff !important;
                padding: 14px 10px;
            }
            .at-actions-col {
                min-width: 200px;
                text-align: center;
            }
            .at-actions-col .button {
                margin: 2px 4px 2px 0;
                display: inline-block;
                vertical-align: middle;
            }
            .at-icon-link-list, .at-icon-link-old {
                color: #2271b1;
                font-size: 18px;
                margin-left: 4px;
                vertical-align: middle;
            }
            .at-icon-link-old { color: #d63638; }
            .at-term-name {
                font-weight: 500;
                font-size: 1.05em;
            }
            .at-term-indent {
                color: #888;
            }
            .at-big-number {
                font-size: 1.6em;
                font-weight: bold;
                text-decoration: none;
                margin-right: 4px;
                vertical-align: middle;
                display: inline-block;
                text-align: center;
                width: 100%;
            }
            td > .at-big-number {
                display: block;
                margin: 0 auto;
            }
        </style>
        <table class="widefat fixed striped">
            <thead>
                <tr>
                    <th>Termine</th>
                    <th>Pubblicati</th>
                    <th>Bozze</th>
                    <th>Vecchi (&gt;5 anni)</th>
                    <th class="at-actions-col">Azioni</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $terms = get_terms([
                'taxonomy' => 'tipologie',
                'hide_empty' => false,
                'orderby' => 'parent',
                'order' => 'ASC',
            ]);
            $last_group = null;
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $group = function_exists('at_getGroupNameByTerm') ? at_getGroupNameByTerm($term->term_id) : '';
                    // Filter by group if selected
                    if ($selected_group && $group !== $selected_group) {
                        continue;
                    }
                    $search = isset($_GET['at_search']) ? strtolower(sanitize_text_field($_GET['at_search'])) : '';
                    if ($search && strpos(strtolower($term->name), $search) === false) {
                        continue;
                    }
                    // Draw a group separator row if group changes
                    if ($group !== $last_group) {
                        echo '<tr class="at-group-row"><td colspan="5"><span class="dashicons dashicons-category"></span> ' . esc_html($group ? $group : 'Senza gruppo') . '</td></tr>';
                        $last_group = $group;
                    }
                    $published = at_count_posts_by_term_status($term->term_id, 'publish');
                    $draft = at_count_posts_by_term_status($term->term_id, 'draft');
                    $older_than_5y = at_count_old_posts_by_term($term->term_id, 5);
                    $indent = '';
                    if ( $term->parent ) {
                        $indent = '<span class="at-term-indent">' . str_repeat('&mdash; ', at_get_term_depth($term, $terms)) . '</span>';
                    }
                    $frontend_link = get_term_link($term);
                    $backend_link = admin_url('term.php?taxonomy=tipologie&tag_ID=' . $term->term_id . '&post_type=amm-trasparente');
                    $backend_list_link = admin_url('edit.php?post_type=amm-trasparente&tipologie=' . $term->slug);

                    echo '<tr>';
                    // Termine
                    echo '<td class="at-term-name">' . $indent . esc_html($term->name) . '</td>';

                    // Pubblicati
                    echo '<td>';
                    if ($published > 0) {
                        echo '<a class="at-icon-link-list at-big-number" href="' . esc_url($backend_list_link . '&post_status=publish') . '" target="_blank" title="Vedi pubblicati">' . intval($published) . '</a>';
                    }
                    echo '</td>';

                    // Bozze
                    echo '<td>';
                    if ($draft > 0) {
                        echo '<a class="at-icon-link-list at-big-number" href="' . esc_url($backend_list_link . '&post_status=draft') . '" target="_blank" title="Vedi bozze">' . intval($draft) . '</a>';
                    }
                    echo '</td>';

                    // Vecchi (>5 anni)
                    echo '<td>';
                    if ($older_than_5y > 0) {
                        echo '<a class="at-icon-link-old at-big-number" href="' . esc_url($backend_list_link . '&at_older_than=5') . '" target="_blank" title="Vedi documenti più vecchi di 5 anni">' . intval($older_than_5y) . '</a>';
                    }
                    echo '</td>';

                    // Azioni
                    echo '<td class="at-actions-col">' .
                        '<a class="button button-small" href="' . esc_url($frontend_link) . '" target="_blank" title="Vedi front-end">Vedi</a> ' .
                        '<a class="button button-small" href="' . esc_url($backend_link) . '" target="_blank" title="Modifica termine">Modifica</a>' .
                        '</td>';

                    echo '</tr>';
                }
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php

// Helper: Count posts by status for a term
function at_count_posts_by_term_status($term_id, $status = 'publish') {
    $query = new WP_Query([
        'post_type' => 'amm-trasparente',
        'post_status' => $status,
        'tax_query' => [
            [
                'taxonomy' => 'tipologie',
                'field'    => 'term_id',
                'terms'    => $term_id,
            ]
        ],
        'fields' => 'ids'
    ]);
    return $query->found_posts;
}

// Helper: Count posts older than X years for a term
function at_count_old_posts_by_term($term_id, $years = 5) {
    $date_query = array(
        array(
            'column' => 'post_date',
            'before' => date('Y-m-d', strtotime('-' . intval($years) . ' years')),
        ),
    );
    $query = new WP_Query([
        'post_type' => 'amm-trasparente',
        'post_status' => 'publish',
        'tax_query' => [
            [
                'taxonomy' => 'tipologie',
                'field'    => 'term_id',
                'terms'    => $term_id,
            ]
        ],
        'date_query' => $date_query,
        'fields' => 'ids'
    ]);
    return $query->found_posts;
}

// Helper: Get term depth for indentation
function at_get_term_depth($term, $all_terms, $depth = 0) {
    if ( $term->parent == 0 ) return $depth;
    foreach ( $all_terms as $parent_term ) {
        if ( $parent_term->term_id == $term->parent ) {
            return at_get_term_depth($parent_term, $all_terms, $depth + 1);
        }
    }
    return $depth;
}