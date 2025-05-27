<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php
/**
 * Render settings tabs.
 */
function at_setting_tabs( $id ) {
    $tabs = [
        0 => [ 'Generale', 'edit.php?post_type=amm-trasparente&page=wpgov_at' ],
        1 => [ 'Gestione sezioni', 'edit.php?post_type=amm-trasparente&page=wpgov_at&at_action=config' ],
        2 => [ 'Debug', 'edit.php?post_type=amm-trasparente&page=wpgov_at&at_action=debug' ],
    ];
    echo '<h2 class="nav-tab-wrapper wp-clearfix">';
    foreach ( $tabs as $i => $tab ) {
        $active = ( $i === $id ) ? ' nav-tab-active' : '';
        printf(
            '<a href="%s" class="nav-tab%s">%s</a>',
            esc_url( admin_url( $tab[1] ) ),
            esc_attr( $active ),
            esc_html( $tab[0] )
        );
    }
    echo '</h2>';
}
?>

<div class="wrap">
    <?php
    $plugin_slug = 'amministrazione-trasparente';
    $wporg_logo_url = 'https://ps.w.org/' . $plugin_slug . '/assets/icon-256x256.jpg';
    ?>
    <div class="at-intro-banner" style="background:#fff;border:1px solid #e5e5e5;border-radius:8px;padding:24px 32px;margin-bottom:24px;box-shadow:0 2px 8px rgba(0,0,0,0.03);display:flex;align-items:center;gap:32px;">
        <div style="flex:0 0 auto;">
            <img src="<?php echo esc_url( $wporg_logo_url ); ?>"
                 alt="Amministrazione Trasparente"
                 style="width:64px;height:64px;padding:8px;">
        </div>
        <div style="flex:1 1 auto;">
            <h2 style="margin-top:0;margin-bottom:8px;font-size:1.5em;"><?php esc_html_e( 'Benvenuto in Amministrazione Trasparente', 'amministrazione-trasparente' ); ?></h2>
            <p style="margin:0 0 12px 0;color:#555;">
                <?php esc_html_e( 'Gestisci la trasparenza della tua amministrazione pubblica in modo semplice e conforme alle normative italiane. Consulta la documentazione, contribuisci allo sviluppo o scopri chi ha reso possibile questo progetto.', 'amministrazione-trasparente' ); ?>
            </p>
            <div style="display:flex;flex-wrap:wrap;gap:12px;">
                <a href="https://github.com/WPGov/amministrazione-trasparente/wiki" class="button button-primary" target="_blank" rel="noopener noreferrer">
                    <?php esc_html_e( 'Documentazione', 'amministrazione-trasparente' ); ?>
                </a>
                <a href="https://github.com/WPGov/amministrazione-trasparente" class="button" target="_blank" rel="noopener noreferrer">
                    <?php esc_html_e( 'Contribuisci su GitHub', 'amministrazione-trasparente' ); ?>
                </a>
                <a href="https://www.marcomilesi.com/" class="button" target="_blank" rel="noopener noreferrer">
                    <?php esc_html_e( 'Autore', 'amministrazione-trasparente' ); ?>
                </a>
                <a href="http://www.porteapertesulweb.it/" class="button" target="_blank" rel="noopener noreferrer">
                    <?php esc_html_e( 'Community Porte Aperte sul Web', 'amministrazione-trasparente' ); ?>
                </a>
            </div>
        </div>
    </div>

    <?php
    // Debug tab
    if ( isset($_GET['at_action']) && $_GET['at_action'] === 'debug' ) {
        at_setting_tabs( 2 );
        echo '<pre>';
        $a = get_option('wpgov_at');
        if ( is_array( $a ) ) {
            $e = filter_var_array( $a, FILTER_SANITIZE_SPECIAL_CHARS );
            print_r( $e );
        } else {
            esc_html_e( 'Nessuna impostazione presente', 'amministrazione-trasparente' );
        }
        echo '</pre>';

        echo '<pre>';
        $a = get_option('atGroupConf');
        if ( is_array( $a ) ) {
            $e = filter_var_array( $a, FILTER_SANITIZE_SPECIAL_CHARS );
            print_r( $e );
        } else {
            esc_html_e( 'Nessuna configurazione presente', 'amministrazione-trasparente' );
        }
        echo '</pre>';

    // Config tab
    } elseif ( isset($_GET['at_action']) ) {
        at_setting_tabs( 1 );

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
        $alert_duplicates = esc_js( "Elenco duplicati:\n" );
        if ( is_array( $diff ) && !empty( $diff ) ) {
            foreach ( $diff as $x ) {
                $duplicate_term = get_term_by( 'id', $x, 'tipologie' );
                if ( $duplicate_term && $duplicate_term->name ) {
                    $alert_duplicates .= '- ' . esc_js( $duplicate_term->name ) . '\n';
                }
            }
        }

        $green_svg = '<span style="color:green" aria-label="OK">&#x2714;</span>';
        $red_svg = '<span style="color:red;" aria-label="Errore">&#x26A0;</span>';

        $warning_count = '';
        $alert_count = esc_js( "Elenco tipologie non associate:\n" );
        if ( wp_count_terms( 'tipologie' ) != count( array_count_values( $selected_sections ) ) ) {
            foreach ( $atTerms as $term ) {
                if ( !in_array( $term->term_id, $selected_sections_unique ) ) {
                    $alert_count .= '- ' . esc_js( $term->name ) . '\n';
                    if ( !empty( $selected_sections_unique ) ) {
                        $max = max( array_keys( $selected_sections_unique ) );
                        $selected_sections_unique[ ++$max ] = $term->term_id;
                    }
                }
            }
            $warning_count = ' ' . esc_html( wp_count_terms( 'tipologie' ) - count( array_count_values( $selected_sections ) ) ) . ' tipologie non sono associate a un gruppo - <a href="#" onclick="alert(\'' . $alert_count . '\');return false;">Clicca qui per i dettagli</a>';
        } else {
            $warning_count = $green_svg;
        }

        $warning_duplicates = '';
        if ( ( count( $selected_sections ) - count( array_count_values( $selected_sections ) ) ) != 0 ) {
            $warning_duplicates = $red_svg . ' Verificare se intenzionale - <a href="#" onclick="alert(\'' . $alert_duplicates . '\');return false;">Clicca qui per i dettagli</a>';
        } else {
            $warning_duplicates = $green_svg;
        }
        ?>
        <h3><?php esc_html_e( 'Tipologie', 'amministrazione-trasparente' ); ?></h3>
        <table class="widefat fixed striped" cellspacing="0">
            <thead>
                <tr>
                    <th class="manage-column"><?php esc_html_e( 'Controllo', 'amministrazione-trasparente' ); ?></th>
                    <th class="manage-column num"><?php esc_html_e( 'Esito', 'amministrazione-trasparente' ); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr class="alternate">
                    <td><?php echo esc_html( wp_count_terms( 'tipologie' ) ); ?> tipologie gestite</td>
                    <td><?php echo ( wp_count_terms( 'tipologie' ) > 0 ? $green_svg : $red_svg ); ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html( count( array_count_values( $selected_sections ) ) ); ?> tipologie correttamente associate nei gruppi</td>
                    <td><?php echo $warning_count; ?></td>
                </tr>
                <tr class="alternate">
                    <td><?php echo esc_html( count( $selected_sections ) - count( array_count_values( $selected_sections ) ) ); ?> tipologie sono associate a più gruppi</td>
                    <td><?php echo $warning_duplicates; ?></td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <p><?php esc_html_e( 'Puoi aggiungere o modificare le singole sezioni di Amministrazione trasparente:', 'amministrazione-trasparente' ); ?></p>
        <a href="<?php echo esc_url( admin_url( 'edit-tags.php?taxonomy=tipologie&post_type=amm-trasparente' ) ); ?>" class="button-secondary"><?php esc_html_e( 'Aggiungi o modifica tipologie', 'amministrazione-trasparente' ); ?></a>
        <hr>
        <h3><?php esc_html_e( 'Gruppi', 'amministrazione-trasparente' ); ?></h3>
        <?php submit_button( __( 'Salva configurazione', 'amministrazione-trasparente' ) ); ?>
        <form method="post" action="options.php" id="at-groupconf-form">
            <?php
            settings_fields( 'wpgov_at_option_groups' );
            $options = get_option( 'atGroupConf' );
            $all_terms = [];
            foreach ( $atTerms as $term ) {
                $all_terms[ $term->term_id ] = $term->name;
            }
            ?>
            <div class="at-groups-stack">
            <?php foreach ( at_get_taxonomy_groups() as $group ) :
                $group_slug = sanitize_title( $group );
                $sezione = at_getGroupConf( $group_slug );
            ?>
                <div class="at-group-card" style="background:#fff;border:1px solid #e5e5e5;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.03);padding:20px;max-width:700px;margin:0 auto 24px auto;">
                    <h4 style="margin-top:0;margin-bottom:12px;font-size:1.1em;display:flex;align-items:center;justify-content:space-between;">
                        <span><?php echo esc_html( $group ); ?></span>
                        <span style="color:#888;font-size:0.9em;"><?php echo esc_html( count( $sezione ) ); ?> tipologie</span>
                    </h4>
                    <ul class="at-sortable-list" id="sortable-<?php echo esc_attr( $group_slug ); ?>" style="margin-bottom:10px;padding-left:0;list-style:none;min-height:36px;">
                        <?php
                        if ( !empty( $sezione ) ) :
                            foreach ( $sezione as $term_id ) :
                                if ( isset( $all_terms[ $term_id ] ) ) :
                        ?>
                            <li class="at-sortable-item" style="margin:2px 0;padding:8px 12px;background:#f7f7f7;border:1px solid #e5e5e5;border-radius:4px;cursor:move;display:flex;align-items:center;justify-content:space-between;">
                                <span><?php echo esc_html( $all_terms[ $term_id ] ); ?></span>
                                <button type="button" class="button-link at-remove-term" data-term="<?php echo esc_attr( $term_id ); ?>" title="<?php esc_attr_e( 'Rimuovi', 'amministrazione-trasparente' ); ?>">&times;</button>
                                <input type="hidden" name="atGroupConf[<?php echo esc_attr( $group_slug ); ?>][]" value="<?php echo esc_attr( $term_id ); ?>">
                            </li>
                        <?php
                                endif;
                            endforeach;
                        endif;
                        ?>
                    </ul>
                    <div style="display:flex;gap:8px;">
                        <select class="at-add-term-select" style="min-width:180px;">
                            <option value=""><?php esc_html_e( 'Aggiungi tipologia…', 'amministrazione-trasparente' ); ?></option>
                            <?php
                            foreach ( $all_terms as $term_id => $term_name ) {
                                if ( empty( $sezione ) || !in_array( $term_id, $sezione ) ) {
                                    echo '<option value="' . esc_attr( $term_id ) . '">' . esc_html( $term_name ) . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <button type="button" class="button at-add-term-btn"><?php esc_html_e( 'Aggiungi', 'amministrazione-trasparente' ); ?></button>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php submit_button( __( 'Salva configurazione', 'amministrazione-trasparente' ) ); ?>
        </form>
        <script>
        jQuery(function($){
            // Enable sortable for each group
            $('.at-sortable-list').sortable({
                placeholder: "ui-state-highlight",
                axis: "y"
            });

            // Remove term from group
            $('.at-sortable-list').on('click', '.at-remove-term', function(){
                $(this).closest('li').remove();
            });

            // Add term to group
            $('.at-add-term-btn').on('click', function(){
                var $container = $(this).closest('.at-group-card');
                var $select = $container.find('.at-add-term-select');
                var termId = $select.val();
                var termName = $select.find('option:selected').text();
                if(termId){
                    var $list = $container.find('.at-sortable-list');
                    // Prevent duplicates
                    if($list.find('input[value="'+termId+'"]').length === 0){
                        var groupSlug = $list.attr('id').replace('sortable-','');
                        var $li = $('<li class="at-sortable-item" style="margin:2px 0;padding:8px 12px;background:#f7f7f7;border:1px solid #e5e5e5;border-radius:4px;cursor:move;display:flex;align-items:center;justify-content:space-between;">'
                            + '<span>'+termName+'</span>'
                            + '<button type="button" class="button-link at-remove-term" data-term="'+termId+'" title="<?php esc_attr_e( 'Rimuovi', 'amministrazione-trasparente' ); ?>">&times;</button>'
                            + '<input type="hidden" name="atGroupConf['+groupSlug+'][]" value="'+termId+'">'
                            + '</li>');
                        $list.append($li);
                        $select.find('option[value="'+termId+'"]').remove();
                    }
                }
                $select.val('');
            });
        });
        </script>
        <style>
        .at-groups-stack {
            display: block;
        }
        .at-group-card {
            width: 100%;
            max-width: 700px;
            margin: 0 auto 24px auto;
        }
        .at-sortable-list .ui-state-highlight { background: #e0f7fa; border: 1px dashed #0073aa; min-height: 36px; }
        .at-sortable-item .at-remove-term { color: #b32d2e; font-size: 1.2em; margin-left: 8px; }
        .at-sortable-item .at-remove-term:hover { color: #dc3232; }
        </style>
        <?php

    // General tab
    } else {
        at_setting_tabs( 0 );
        ?>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'wpgov_at_options' );
            wp_nonce_field( 'wpgov_at_save_settings', 'wpgov_at_nonce' );
            $options = get_option( 'wpgov_at' );
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="at_option_id"><?php esc_html_e( 'ID Pagina', 'amministrazione-trasparente' ); ?></label>
                    </th>
                    <td>
                        <input id="at_option_id" type="number" min="0" name="wpgov_at[page_id]" value="<?php echo esc_attr( isset( $options['page_id'] ) ? $options['page_id'] : '' ); ?>" size="55" />
                        <br>
                        <small>
                            <?php esc_html_e( 'ID della pagina di WordPress in cui è stato inserito lo shortcode del plugin.', 'amministrazione-trasparente' ); ?><br>
                            <?php esc_html_e( 'Lista shortcode:', 'amministrazione-trasparente' ); ?>
                            <a href="https://github.com/WPGov/amministrazione-trasparente/wiki/Shortcode" target="_blank" rel="noopener noreferrer">link</a>
                        </small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="at_option_opacity"><?php esc_html_e( 'Sfuma sezioni vuote', 'amministrazione-trasparente' ); ?></label>
                    </th>
                    <td>
                        <input id="at_option_opacity" name="wpgov_at[opacity]" type="checkbox" value="1" <?php checked( '1', isset( $options['opacity'] ) && $options['opacity'] ); ?> />
                        <br>
                        <small><?php esc_html_e( 'Aumenta la trasparenza visiva delle sezioni senza alcun contenuto. Consigliato: ON', 'amministrazione-trasparente' ); ?></small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="at_enable_tag"><?php esc_html_e( 'Abilita tag', 'amministrazione-trasparente' ); ?></label>
                    </th>
                    <td>
                        <input id="at_enable_tag" name="wpgov_at[enable_tag]" type="checkbox" value="1" <?php checked( '1', isset( $options['enable_tag'] ) && $options['enable_tag'] ); ?> />
                        <br>
                        <small><?php esc_html_e( 'Consenti di associare dei tag ai post di Amministrazione Trasparente. Consigliato: OFF', 'amministrazione-trasparente' ); ?></small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="at_show_love"><?php esc_html_e( 'Mostra credits', 'amministrazione-trasparente' ); ?></label>
                    </th>
                    <td>
                        <input id="at_show_love" name="wpgov_at[show_love]" type="checkbox" value="1" <?php checked( '1', isset( $options['show_love'] ) && $options['show_love'] ); ?> />
                        <br>
                        <small><?php esc_html_e( 'Aiutaci a far conoscere il progetto e ottieni una via preferenziale per il supporto. Consigliato: ON', 'amministrazione-trasparente' ); ?></small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" colspan="2">
                        <h2><?php esc_html_e( 'Avanzate', 'amministrazione-trasparente' ); ?></h2>
                    </th>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="at_enable_ucc"><?php esc_html_e( 'Abilita uffici e Centri di costo', 'amministrazione-trasparente' ); ?></label>
                    </th>
                    <td>
                        <input id="at_enable_ucc" name="at_enable_ucc" type="checkbox" value="1" <?php checked( '1', isset( $options['enable_ucc'] ) && $options['enable_ucc'] ); ?> />
                        <br>
                        <small><?php esc_html_e( 'Consenti di associare i contenuti a una nuova tassonomia per uffici e centri di costo. Consigliato: OFF, attivare solo se necessario.', 'amministrazione-trasparente' ); ?></small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="at_map_cap"><?php esc_html_e( 'Mappa capacità', 'amministrazione-trasparente' ); ?></label>
                    </th>
                    <td>
                        <input id="at_map_cap" name="wpgov_at[map_cap]" type="checkbox" value="1" <?php checked( '1', isset( $options['map_cap'] ) && $options['map_cap'] ); ?> />
                        <br>
                        <small><?php esc_html_e( 'Mappa le meta capacità per personalizzare ruoli e permessi. [per utenti esperti] + [richiede componenti aggiuntivi]. Consigliato: OFF', 'amministrazione-trasparente' ); ?></small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="at_pasw_2013"><?php esc_html_e( 'Forza PASW2013', 'amministrazione-trasparente' ); ?></label>
                    </th>
                    <td>
                        <input id="at_pasw_2013" name="wpgov_at[pasw_2013]" type="checkbox" value="1" <?php checked( '1', isset( $options['pasw_2013'] ) && $options['pasw_2013'] ); ?> />
                        <br>
                        <small><?php esc_html_e( 'Spunta casella se vuoi attivare ottimizzazioni per il template PASW2013. [abilitare solo se il tema attivo è una versione precedente al 2013 o se è stato cambiato il nome della cartella di "pasw2013"]', 'amministrazione-trasparente' ); ?></small>
                    </td>
                </tr>
                <tr valign="top" <?php if ( !isset( $options['custom_terms'] ) || !$options['custom_terms'] ) { echo 'style="display:none;"'; } ?>>
                    <th scope="row">
                        <label for="custom_terms"><?php esc_html_e( 'Custom Terms', 'amministrazione-trasparente' ); ?></label>
                    </th>
                    <td>
                        <input id="custom_terms" name="wpgov_at[custom_terms]" type="checkbox" value="1" <?php checked( '1', isset( $options['custom_terms'] ) && $options['custom_terms'] ); ?> />
                        <br>
                        <small><?php esc_html_e( 'Utile in caso di test da parte del servizio di supporto. Mantienila disattivata!', 'amministrazione-trasparente' ); ?></small>
                    </td>
                </tr>
            </table>
            <?php submit_button( __( 'Salva configurazione', 'amministrazione-trasparente' ) ); ?>
        </form>
        <?php
        // Optional: Debug info for advanced users
        if ( at_option('debug') ) {
            echo '<hr><h3>DEBUG</h3>';
            $terms = get_terms( [ 'taxonomy' => 'tipologie', 'hide_empty' => false ] );
            echo esc_html__( 'Numero sezioni installate:', 'amministrazione-trasparente' ) . ' ' . esc_html( count( $terms ) ) . '<br>';
            $count = 0;
            $merge = [];
            foreach ( amministrazionetrasparente_getarray() as $inner ) {
                $count += count( $inner[1] );
                $merge = array_merge( $merge, $inner[1] );
            }
            sort( $merge );
            echo esc_html__( 'Numero sezioni supportate dal plugin:', 'amministrazione-trasparente' ) . ' ' . esc_html( $count );
            echo '<hr>';
            echo '<div style="width:45%;float:left;"><h4>' . esc_html__( 'Installate:', 'amministrazione-trasparente' ) . '</h4><ul>';
            foreach ( $terms as $term ) {
                echo '<li>' . esc_html( $term->name ) . '</li>';
            }
            echo '</ul></div>';
            echo '<div style="width:45%;float:left;"><h4>' . esc_html__( 'Supportate:', 'amministrazione-trasparente' ) . '</h4><ul>';
            foreach ( $merge as $merge_item ) {
                echo '<li>' . esc_html( $merge_item ) . '</li>';
            }
            echo '</ul></div><hr>';
        }
    }
    ?>
</div>