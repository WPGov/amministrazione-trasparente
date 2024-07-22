<?php
    class AmministrazioneTrasparente_Backend {
        function __construct() {
            add_action( 'admin_notices', [ $this, 'adminMessages' ] );
            add_action( 'manage_amm-trasparente_posts_columns', [ $this, 'modified_column_register' ] );
            add_action( 'manage_amm-trasparente_posts_custom_column', [ $this, 'modified_column_display' ], 10, 2  );
            add_action( 'manage_edit-amm-trasparente_sortable_columns', [ $this, 'modified_column_register_sortable' ] );
        }
        function adminMessages() {
            global $current_screen ;

            $get_at_option_id = at_option('page_id');
            if ($get_at_option_id == '0') { /* Se  non è stato compilato l'url per "Torna al Sommario", informiamo brutalmente l'admin fino a quando non provvede :-) */
                echo '
                <div class="notice notice-error">
                    <p><b>AMMINISTRAZIONE TRASPARENTE</b></p>
                    <p>Crea una nuova pagina per "Amministrazione Trasparente" utilizzando gli <a href="https://github.com/WPGov/amministrazione-trasparente/wiki/Shortcode" target="_blank">shortcode</a> del plugin.<br />
                    Aggiungere l\'ID della pagina creata in <b>"Trasparenza -> Impostazioni -> Generale -> ID Pagina"</b></p>
                </div>';
            }

            if ( is_active_widget( false, false, 'atwidget', true ) && ( get_option( 'at_option_widget' ) || get_option( 'at_logic_widget') ) ) {
                get_option( 'at_option_widget' ) ? $a = 'SI' : $a = 'NO';
                get_option( 'at_logic_widget' ) ? $b = 'SI' : $b = 'NO';
                echo '
                <div class="notice notice-error">
                    <p><b>AMMINISTRAZIONE TRASPARENTE</b></p>
                    <p>A seguito di alcuni aggiornamenti al <b>widget</b> abbiamo rilevato che in questo sito è necessario salvare nuovamente le impostazioni in "Aspetto -> Widget -> Amministrazione Trasparente".</p>
                    <p>La configurazione del widget è resettata ai valori di default.</p>
                    <p>Vecchia configurazione: <b>Voci espandibili = '.$a.', Visualizzazione condizionale = '.$b.'</b>
                </div>';
            }
        }

        function modified_column_register( $columns ) {
            $columns['Modified'] = 'Ultima modifica';
            return $columns;
        }

        function modified_column_display( $column_name, $post_id ) {
            switch ( $column_name ) {
            case 'Modified':
                echo get_the_modified_author().'<br>';
                echo get_the_modified_date( 'd/m/Y', $post_id ).' alle '.get_the_modified_time( 'G:i' );
                break; // end all case breaks
            }
        }

        function modified_column_register_sortable( $columns ) {
            $columns['Modified'] = 'modified';
            return $columns;
        }
    }
?>