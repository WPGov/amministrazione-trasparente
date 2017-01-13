<?php
echo '<div class="wrap">
    <div id="welcome-panel" class="welcome-panel" style="padding-bottom: 20px;background: #23282d;">
            <div class="welcome-panel-content">
                            <center><a href="admin.php?page=impostazioni-wpgov"><img src="' .plugins_url('inc/wpgov.png',__FILE__). '" /></a>
                            <br>
                            <a class="add-new-h2" href="http://wpgov.it/docs">Documentazione</a>
                            <a class="add-new-h2" href="http://wpgov.it/supporto/">Supporto</a>
                            <a class="add-new-h2" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=F2JK36SCXKTE2">Donazione</a>
                            </center>
            </div>
        </div>';

//TAB CONDITION START
if ( isset($_GET['open']) ) {
    include(ABSPATH . 'wp-content/plugins/'.$_GET['open']);
} else {
    echo '
        <div id="welcome-panel" class="welcome-panel" style="padding-bottom: 20px;">
                <div class="welcome-panel-column-container">';

    include_once( ABSPATH . WPINC . '/feed.php' );

    $rss = fetch_feed( 'http://wpgov.it/feed/' );

    $maxitems = 0;

    if ( ! is_wp_error( $rss ) ) :
        $maxitems = $rss->get_item_quantity( 3 ); 
        $rss_items = $rss->get_items( 0, $maxitems );
    endif;
    ?>

        <?php if ( $maxitems == 0 ) : ?>
            <li><?php _e( 'No items', 'my-text-domain' ); ?></li>
        <?php else : ?>
            <?php foreach ( $rss_items as $item ) : ?>
                <div style="float:left;width:33%;text-align: center;">
                    <a target="_blank" href="<?php echo esc_url( $item->get_permalink() ); ?>"
                        title="<?php printf( __( 'Posted %s', 'my-text-domain' ), $item->get_date('j F Y | g:i a') ); ?>">
                        <?php echo esc_html( $item->get_title() ); ?>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php
    echo '
            </div>
        </div>
        
        <div id="welcome-panel" class="welcome-panel" style="padding-bottom: 20px;">
            <div class="welcome-panel-column-container">
                <div class="welcome-panel-column" style="text-align:center;padding-top:50px; ">
                
                </div>
            <div class="welcome-panel-column">
            <h4>Impostazioni</h4>
            
            <ul>';

            $plugins_array = apply_filters('wpgov_s', '');
            for( $i = 0; $i < count($plugins_array); $i++) {
                echo '<li><a href="?page=impostazioni-wpgov&open='.$plugins_array[$i][2].'"  class="welcome-icon '.$plugins_array[$i][1].'">' . $plugins_array[$i][0] . '</a></li>';
            }
    
            echo '
            </ul>
        </div>
        <div class="welcome-panel-column welcome-panel-last">
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/it_IT/sdk.js#xfbml=1&version=v2.4&appId=251544361535439";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, \'script\', \'facebook-jssdk\'));</script>
            <div class="fb-page" data-href="https://www.facebook.com/WPGov" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/WPGov"><a href="https://www.facebook.com/WPGov">WPGov.it</a></blockquote></div></div>
            </div>
        </div>
    </div>';
} //TAB CONDITION END

    echo '<div id="welcome-panel" class="welcome-panel" style="padding-bottom:20px;text-align:center;">
            <div class="welcome-panel-content">
                Sviluppo e ideazione a cura di <a href="http://marcomilesi.ml" target="_blank" title="www.marcomilesi.ml">Marco Milesi</a><br/><small>con il contributo della Comunità di Pratica</small><br><a href="http://www.porteapertesulweb.it" target="_blank" title="Porte Aperte sul Web"><img src="' .plugins_url('inc/pasw.png',__FILE__). '" /></a></center></div>
            </div>
        </div>';
    if ( isset($_POST['SubmitLove']) ) {
        update_option( 'wpgov_show_love', isset($_POST['wpgov_show_love_n']) );
    }
    echo '<form method="post" name="options" target="_self">';
    settings_fields( 'wpgov_options' );
    echo '<input id="wpgov_show_love_n" name="wpgov_show_love_n" type="checkbox" value="1"';
    checked('1', get_option('wpgov_show_love'));
    echo '/><label for="wpgov_show_love_n" style="font-size:0.9em;">Mostra link WPGov</label>  <input type="submit"  class="button button-small" name="SubmitLove" value="Salva" /></form>
    <div class="clear"></div>';
?>
