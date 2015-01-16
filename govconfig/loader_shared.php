<?php

add_action( 'admin_menu', 'register_at_wpgov_menu_page' );

function register_at_wpgov_menu_page(){
    add_menu_page('Impostazioni soluzioni WPGOV.IT', 'WPGov.it', 'manage_options', 'impostazioni-wpgov', 'at_wpgov_settings', 'dashicons-share-alt', 40);
}

function at_wpgov_settings () {

    echo '<div class="wrap">';
    echo '<style>.box { max-height:110px; width: 70%;position: absolute;left: 300px; } .box h4 { margin-bottom: 0px; } .box li { float: left; width: 250px; padding: 0px 10px 5px 0px; }</style>';
    echo '<div class="box">';
    echo '<h4>Ultimi articoli:</h4>';
    include_once( ABSPATH . WPINC . '/feed.php' );
    $rss = fetch_feed( 'http://www.wpgov.it/feed' );
    if ( ! is_wp_error( $rss ) ) :
    $maxitems = $rss->get_item_quantity( 3 );
    $rss_items = $rss->get_items( 0, $maxitems );
    endif;?>

<ul>
    <?php if ( $maxitems == 0 ) : ?>
        <li><?php _e( 'No items', 'my-text-domain' ); ?></li>
    <?php else : ?>
        <?php // Loop through each feed item and display each item as a hyperlink. ?>
        <?php foreach ( $rss_items as $item ) : ?>
            <li>
                <a href="<?php echo esc_url( $item->get_permalink() ); ?>" target="_blank"
                    title="<?php printf( __( 'Posted %s', 'my-text-domain' ), $item->get_date('j F Y | g:i a') ); ?>">
                    <?php echo substr(esc_html( $item->get_title() ), 0, 40);
                    if (strlen(esc_html( $item->get_title() )) > 40) { echo '...'; } ?>
                </a>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>
    <?php
    echo '</div>';
    echo '<div style="float:right;">
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="hosted_button_id" value="F2JK36SCXKTE2">
    <input type="image" src="https://www.paypalobjects.com/it_IT/IT/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - Il metodo rapido, affidabile e innovativo per pagare e farsi pagare.">
    <img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
    </form>
    </div>';
    echo '<a href="http://www.wpgov.it" target="_blank" title="WordPress per la Pubblica Amministrazione"><img src="' . plugin_dir_url(__FILE__) . 'panels/includes/wpa_black.png' . '" alt=""></a>';

    global $pagenow;
    $settings = get_option( "wpgov_theme_settings" );

    //generic HTML and code goes here

    if(isset($_POST['FlushButton'])) {
        flush_rewrite_rules();
    }
    if ( isset ( $_GET['tab'] ) ) { at_wpgov_admin_tabs($_GET['tab']);  } else { at_wpgov_admin_tabs('general');}
    if ( isset ( $_GET['tab'] ) ) { $tab = $_GET['tab']; } else { $tab = 'general'; }

   echo '<table class="form-table">';
   switch ( $tab ){
      case 'general' :
        include(plugin_dir_path(__FILE__) . 'panels/p_wpgov_settings.php');
      break;
      case 'at' :
        if (is_plugin_active( 'amministrazione-trasparente/amministrazionetrasparente.php' )) {
            include(ABSPATH . 'wp-content/plugins/amministrazione-trasparente/govconfig/panels/p_at_settings.php');
        } else {
            echo 'Plugin non installato!';
        }
      break;
      case 'avcp' :
        if (is_plugin_active( 'avcp/avcp.php' )) {
            include(ABSPATH . 'wp-content/plugins/avcp/govconfig/panels/p_avcp_settings.php');
        } else {
            echo 'Plugin non installato!';
        }
      break;
      case 'aa' :
        if (is_plugin_active( 'amministrazione-aperta/amministrazioneaperta.php' )) {
            include(ABSPATH . 'wp-content/plugins/amministrazione-aperta/govconfig/panels/p_aa_settings.php');
        } else {
            echo 'Plugin non installato!';
        }
      break;
   }
   echo '</table>';

    echo '<center>
    Sviluppo e ideazione Wordpress a cura di <a href="http://marcomilesi.ml" target="_blank" title="www.marcomilesi.ml">Marco Milesi</a><br/><small>Per la preparazione di questo programma sono state impiegate diverse ore a titolo volontario. Se vuoi, puoi effettuare una piccola donazione utilizzando il link che trovi in alto a destra.<br/>Per qualsiasi informazione e per segnalare un problema è attivo il forum di supporto su <a href="http://wpgov.it/supporto" target="_blank" title="www.marcomilesi.ml/supporto">www.wpgov.it/supporto</a></small><br/><a href="http://www.comune.sanpellegrinoterme.bg.it" title="Made in San Pellegrino Terme">+ Proudly made in San Pellegrino Terme</a></center></div>';
}

function at_wpgov_admin_tabs( $current = 'homepage' ) {
    $tabs = array( 'general' => 'Info', 'at' => 'Amministrazione Trasparente', 'avcp' => 'Avcp XML', 'aa' => 'Amministrazione Aperta' );
    echo '<h2 class="nav-tab-wrapper">';
    echo '<div style="float:right;">
        <a class="add-new-h2" href="http://wpgov.it/soluzioni/">Documentazione</a>
        <a class="add-new-h2" href="http://wpgov.it/supporto/">Forum di Supporto</a>
    </div>';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=impostazioni-wpgov&tab=$tab'>$name</a>";

    }
    echo '</h2>';
}
?>
