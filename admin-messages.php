<?php

add_action('admin_notices', 'at_admin_messages');
function at_admin_messages() {
    global $current_screen ;

    $get_at_option_id = get_option('at_option_id');
    if ($get_at_option_id == '0') { /* Se  non è stato compilato l'url per "Torna al Sommario", informiamo brutalmente l'admin fino a quando non provvede :-) */
        echo '
        <div class="notice notice-error">
            <p><b>AMMINISTRAZIONE TRASPARENTE</b></p>
            <p>Per iniziare crea una nuova pagina per "Amministrazione Trasparente" utilizzando gli <a href="//wpgov.it/docs/amministrazione-trasparente/" target="_blank">shortcode</a> del plugin.<br />
            Ricorda di inserire l\'ID della pagina nelle impostazioni (WPGov.it >> Amministrazione Trasparente)</p>
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
    
    if ( 'amm-trasparente' == $current_screen->post_type  ) {
        echo '
        <div class="notice">
            <p><b>D.lgs. 97/2016</b></p>
            <p>Adeguamento del sistema a seguito dell\'entrata in vigore del Decreto legislativo 25 maggio 2016, n. 97</p>
            <details>
                <summary>Modifiche al sistema (11 gennaio 2017)</summary>
                <p><b>[NUOVA SEZIONE]</b> Pagamenti dell\'amministrazione -> <b>Dati sui pagamenti</b></p>
            </details>
            <br>
        </div>';
    }
}
?>
