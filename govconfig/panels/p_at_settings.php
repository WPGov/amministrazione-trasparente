<?php
    if (!(is_plugin_active( 'amministrazione-trasparente/amministrazionetrasparente.php' ))) { echo 'Plugin non installato!'; return;}

    //Da qui inizia il pannello delle opzioni

    if(isset($_POST['Submit'])) {
        $at_option_get_id = $_POST["at_option_id_n"];
        update_option( 'at_option_id', $at_option_get_id );

        if(isset($_POST['at_option_love_n'])){
            update_option( 'at_option_love', '1' );
        } else {
            update_option( 'at_option_love', '0' );
        }

        if(isset($_POST['at_categorization_enable_n'])){
            update_option( 'at_categorization_enable', '1' );
        } else {
            update_option( 'at_categorization_enable', '0' );
        }

        if(isset($_POST['at_pasw_developer_n'])){
            update_option( 'at_pasw_developer', '1' );
        } else {
            update_option( 'at_pasw_developer', '0' );
        }

        delete_option( 'at_breadcrumb_single');

        if (isset($_POST['at_ruoli_option_enable_n'])){
            update_option('at_ruoli_option_enable', '1');
        } else {
            update_option('at_ruoli_option_enable', '0');
        }

        if (isset($_POST['at_option_showarchivedesc_n'])){
            update_option('at_option_showarchivedesc', '0'); //Invertito
        } else {
            update_option('at_option_showarchivedesc', '1');
        }

        if (isset($_POST['at_option_tag_n'])){
            update_option('at_option_tag', '0'); //Invertito
        } else {
            update_option('at_option_tag', '1');
        }

        if (isset($_POST['at_option_sblocca_tipologie_n'])){
            update_option('at_option_sblocca_tipologie', '1');
        } else {
            update_option('at_option_sblocca_tipologie', '0');
        }
    }
    echo '<form method="post" name="options" target="_self">';
    settings_fields( 'at_option_group' );

    echo '<table class="form-table"><tbody>';

    echo '<tr><th scope="row">ID Pagina Amministrazione Trasparente</th>
        <td><input type="text" name="at_option_id_n" value="';
    echo get_option('at_option_id');
    echo '" />&nbsp;Inserisci qui l\'id della pagina in cui è stato inserito un tag head/list (serve per attivare correttamente il link "Torna al Sommario" e le impostazioni widget</td></tr>';

    echo '<tr><th scope="row">Abilita Categorie<br/></th>
        <td><input type="checkbox" name="at_categorization_enable_n" ';
    $get_at_categorization_enable = get_option('at_categorization_enable');
    if ($get_at_categorization_enable == '1') {
        echo 'checked=\'checked\'';
    }
    echo '/>&nbsp;Spunta questa casella per abilitare la possibilità di associare le categorie degli articoli alle voci di Amministrazione Trasparente (può causare problemi alle query)<br/>Dopo l\'abilitazione, aggiorna la pagina e comparirà un nuovo menù: <b>Trasparenza -> Categorie</td></tr>';

    echo '<tr><th scope="row">Abilita Tag<br/></th>
        <td><input type="checkbox" name="at_option_tag_n" ';
    $get_at_option_tag = get_option('at_option_tag');
    if ($get_at_option_tag == '0') {
        echo 'checked=\'checked\'';
    }
    echo '/>&nbsp;Spunta questa casella per abilitare la possibilità di associare alcuni TAG agli articoli alle voci di Amministrazione Trasparente<br/>Dopo l\'abilitazione, aggiorna la pagina e comparirà un nuovo menù: <b>Trasparenza -> Tag</td></tr>';

    //Opzione per visualizzare subito la descrizione nella vis. Archivio
    echo '<tr><th scope="row">Abilita riferimento normativo espanbile</th>
        <td><input type="checkbox" name="at_option_showarchivedesc_n" ';
    $get_at_option_showarchivedesc = get_option('at_option_showarchivedesc');
    if ($get_at_option_showarchivedesc == '0') { //Invertiamo
        echo 'checked=\'checked\'';
    }
    echo '/>&nbsp;Spunta questa casella per abilitare la possibilità di espandere e ridurre la sezione dei riferimenti normativi nella visualizzazione di archivio. (standard: Attivo)</td></tr>';

    echo '<tr><th scope="row">Mostra "Un po\' di amore"</th>
        <td><input type="checkbox" name="at_option_love_n" ';
    $get_show_love = get_option('at_option_love');
    if ($get_show_love == '1') {
        echo 'checked=\'checked\'';
    }
    echo '/>&nbsp;Spunta questa casella per mostrare un link al plugin in fondo alla pagina [at-list] e [at-table]</td>';

    echo '</tbody></table>';

    echo '<h1>Ruoli & Permessi</h1>
        <table class="form-table"><tbody>';

    echo '<tr><th scope="row">Mappa le meta capacità</th>
            <td><input type="checkbox" name="at_ruoli_option_enable_n" ';
    $get_at_ruoli_option_enable = get_option('at_ruoli_option_enable');
    if ($get_at_ruoli_option_enable == '1') {
        echo 'checked=\'checked\'';
    }
    echo '/>&nbsp;Le voci di A.T. ereditano i permessi di pubblicazione/modifica/eliminazione degli articoli. Se vuoi avere un maggior controllo abilita questa opzione e segui <a href="http://supporto.marcomilesi.ml/?p=571" target="_blank" title="Istruzioni per la configurazione di Ruoli & Permessi">questo tutorial</a></b>
    </td></tr>';

    echo '</tbody></table>';

    echo '<h1>Impostazioni PASW 2013</h1>
        <table class="form-table"><tbody>';

        if (get_template() != 'pasw2013') { echo '<tr><b style="color:red;">Sembra che tu non stia usando Pasw2013 in quanto il tema è caricato nella cartella "' . get_template() . '". Le impostazioni seguenti saranno ignorate</b></tr>'; }

        echo '<tr><th scope="row">Forza template PASW</th><td><input type="checkbox" name="at_pasw_developer_n" ';
    $get_pasw_developer = get_option('at_pasw_developer');
    if ($get_pasw_developer == '1') {
        echo 'checked=\'checked\'';
    }
    echo '/>&nbsp;Spunta casella se vuoi forzare l\'utilizzo dei template archive/single ottimizzati per PASW2013 (attenzione: abilitare <b>solo</b> se il tema attivo è una versione <b>precedente</b> al 2013 o se è stato cambiato il nome del tema!)<br/>L\'impostazione è ereditata anche dal plugin <b>AVCP</b> (se installato).</td></tr>';

    echo '</tbody></table>';


    echo '<p class="submit"><input type="submit"  class="button-primary" name="Submit" value="Aggiorna Impostazioni" /></p>';
    echo '</form>';
?>
