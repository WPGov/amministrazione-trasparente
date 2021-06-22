<?php
if ( get_option('at_version_number') != '' ) {
    if (  version_compare( get_option('at_version_number'), 6, '<') ) {
        $arr = array();
        if ( get_option('at_option_id') ) {
            $arr['page_id'] = get_option('at_option_id');
        }
        if ( get_option('at_option_opacity') ) {
            $arr['opacity'] = get_option('at_option_opacity');
        }
        if ( get_option('at_option_tag') ) {
            $arr['enable_tag'] = get_option('at_option_tag');
        }
        if ( get_option('wpgov_show_love') ) {
            $arr['show_love'] = get_option('wpgov_show_love');
        }
        if ( get_option('at_ruoli_option_enable') ) {
            $arr['map_cap'] = get_option('at_ruoli_option_enable');
        }
        if ( get_option('at_pasw_developer') ) {
            $arr['pasw_2013'] = get_option('at_pasw_developer');
        }
        update_option( 'wpgov_at', $arr );

        $old = 'Controlli e rilievi sull\'amministrazione';
        $new = 'Organismi indipendenti di valutazione, nuclei di valutazione o altri organismi con funzioni analoghe';
        if ( term_exists( $old , 'tipologie') && !term_exists( $new , 'tipologie') ) {
            $term = get_term_by('name', $old,'tipologie');
            wp_update_term( $term->term_id , 'tipologie',
                array(
                    'name' => $new,
                    'slug' => 'organismi-indipendenti-di-valutazione-nuclei-di-valutazione-o-altri-organismi-con-funzioni-analoghe')
            );
        }

        // 25 luglio 2017
        $old = 'Programma per la Trasparenza e l\'Integrità';
        $new = 'Piano triennale per la prevenzione della corruzione e della trasparenza';
        if ( term_exists( $old , 'tipologie') && !term_exists( $new , 'tipologie') ) {
            $term = get_term_by('name', $old,'tipologie');
            wp_update_term( $term->term_id , 'tipologie',
                array(
                    'name' => $new,
                    'slug' => 'piano-triennale-per-la-prevenzione-della-corruzione-e-della-trasparenza')
            );
        }
        $old = 'Corruzione';
        $new = 'Prevenzione della Corruzione';
        if ( term_exists( $old , 'tipologie') && !term_exists( $new , 'tipologie') ) {
            $term = get_term_by('name', $old,'tipologie');
            wp_update_term( $term->term_id , 'tipologie',
                array(
                    'name' => $new,
                    'slug' => 'prevenzione-della-corruzione')
            );
        }
        $old = 'Consulenti e Collaboratori';
        $new = 'Titolari di incarichi di collaborazione o consulenza';
        if ( term_exists( $old , 'tipologie') && !term_exists( $new , 'tipologie') ) {
            $term = get_term_by('name', $old,'tipologie');
            wp_update_term( $term->term_id , 'tipologie',
                array(
                    'name' => $new,
                    'slug' => 'titolari-di-incarichi-di-collaborazione-o-consulenza')
            );
        }
    }
    if (  version_compare( get_option('at_version_number'), 6.1, '<') ) {
        $old = 'Organi di indirizzo politico-amministrativo';
        $new = 'Titolari di incarichi politici, di amministrazione, di direzione o di governo';
        if ( term_exists( $old , 'tipologie') && !term_exists( $new , 'tipologie') ) {
            $term = get_term_by('name', $old,'tipologie');
            wp_update_term( $term->term_id , 'tipologie',
                array(
                    'name' => $new,
                    'slug' => 'titolari-di-incarichi-politici-di-amministrazione-di-direzione-o-di-governo')
            );
        }
        $old = 'Incarichi amministrativi di vertice';
        $new = 'Titolari di incarichi dirigenziali amministrativi di vertice';
        if ( term_exists( $old , 'tipologie') && !term_exists( $new , 'tipologie') ) {
            $term = get_term_by('name', $old,'tipologie');
            wp_update_term( $term->term_id , 'tipologie',
                array(
                    'name' => $new,
                    'slug' => 'titolari-di-incarichi-dirigenziali-amministrativi-di-vertice')
            );
        }
        $old = 'Dirigenti';
        $new = 'Titolari di incarichi dirigenziali (dirigenti non generali)';
        if ( term_exists( $old , 'tipologie') && !term_exists( $new , 'tipologie') ) {
            $term = get_term_by('name', $old,'tipologie');
            wp_update_term( $term->term_id , 'tipologie',
                array(
                    'name' => $new,
                    'slug' => 'titolari-di-incarichi-dirigenziali-dirigenti-non-generali')
            );
        }
        $old = 'Incarichi conferiti e autorizzati ai dipendenti';
        $new = 'Incarichi conferiti e autorizzati ai dipendenti (dirigenti e non dirigenti)';
        if ( term_exists( $old , 'tipologie') && !term_exists( $new , 'tipologie') ) {
            $term = get_term_by('name', $old,'tipologie');
            wp_update_term( $term->term_id , 'tipologie',
                array(
                    'name' => $new,
                    'slug' => 'incarichi-conferiti-e-autorizzati-ai-dipendenti-dirigenti-e-non-dirigenti')
            );
        }
        $old = 'Bandi di gara e contratti';
        $new = 'Informazioni sulle singole procedure in formato tabellare';
        if ( term_exists( $old , 'tipologie') && !term_exists( $new , 'tipologie') ) {
            $term = get_term_by('name', $old,'tipologie');
            wp_update_term( $term->term_id , 'tipologie',
                array(
                    'name' => $new,
                    'slug' => 'informazioni-sulle-singole-procedure-in-formato-tabellare')
            );
        }
        $old = 'Opere pubbliche';
        $new = 'Atti di programmazione delle opere pubbliche';
        if ( term_exists( $old , 'tipologie') && !term_exists( $new , 'tipologie') ) {
            $term = get_term_by('name', $old,'tipologie');
            wp_update_term( $term->term_id , 'tipologie',
                array(
                    'name' => $new,
                    'slug' => 'atti-di-programmazione-delle-opere-pubbliche')
            );
        }
    }
}

foreach (amministrazionetrasparente_getarray() as $inner) {
    foreach ($inner[1] as $value) {
        if (!term_exists( $value , 'tipologie')) {
            wp_insert_term( $value , 'tipologie');
        }
    }
}
require_once(plugin_dir_path(__FILE__) . 'taxonomydescgenerator.php');

?>
