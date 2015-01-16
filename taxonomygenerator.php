<?php

////BUGFIX 18 GENNAIO 2014
$termcheck = term_exists('Dati ulteriori', 'tipologie');
if ($termcheck == 0 || $termcheck == null) {
    $termcheck2 = term_exists('Altri contenuti', 'tipologie');
    if ($termcheck2 !== 0 && $termcheck2 !== null) {
        $altricontenuti_datiulteriori = get_term_by('name', 'Altri contenuti', 'tipologie');
        wp_update_term($altricontenuti_datiulteriori->term_id, 'tipologie', array(
            'name' => 'Dati ulteriori',
            'slug' => 'dati-ulteriori'
        ));
    } else {
    wp_insert_term('Dati ulteriori', 'tipologie');
    }
}

////SEZIONI IMPLEMENTATE DA: 16 GENNAIO 2014
$termcheck = term_exists('Sistema di misurazione e valutazione della Performance', 'tipologie');
if ($termcheck !== 0 && $termcheck !== null) {
  return;
}
wp_delete_term('Scadenzario obblighi amministrativi', 'tipologie'); ////RIMOSSA IL 16 GENNAIO 2014
wp_insert_term('Sistema di misurazione e valutazione della Performance', 'tipologie');
wp_insert_term('Documento dell\'OIV di validazione della Relazione sulla Performance', 'tipologie');
wp_insert_term('Class action', 'tipologie');
wp_insert_term('Corruzione', 'tipologie');
wp_insert_term('Accesso civico', 'tipologie');
wp_insert_term('Accessibilità e Catalogo di dati, metadati e banche dati', 'tipologie');

////SEZIONI IMPLEMENTATE DA: 10 GENNAIO 2014
$termcheck = term_exists('Scadenzario obblighi amministrativi', 'tipologie');
if ($termcheck !== 0 && $termcheck !== null) {
  return;
}
wp_insert_term('Burocrazia zero', 'tipologie');

////SEZIONI IMPLEMENTATE DA: LUGLIO 2013
$termcheck = term_exists('Programma per la Trasparenza e l\'Integrità', 'tipologie');
if ($termcheck !== 0 && $termcheck !== null) {
  return;
}

//Disposizioni Generali
wp_insert_term('Programma per la Trasparenza e l\'Integrità', 'tipologie');
wp_insert_term('Atti generali', 'tipologie');
wp_insert_term('Oneri informativi per cittadini e imprese', 'tipologie');
wp_insert_term('Attestazioni OIV o di struttura analoga', 'tipologie');

//Organizzazione
wp_insert_term('Organi di indirizzo politico-amministrativo', 'tipologie');
wp_insert_term('Sanzioni per mancata comunicazione dei dati', 'tipologie');
wp_insert_term('Rendiconti gruppi consiliari regionali/provinciali', 'tipologie');
wp_insert_term('Articolazione degli uffici', 'tipologie');
wp_insert_term('Telefono e posta elettronica', 'tipologie');

//Consulenti e Collaboratori
wp_insert_term('Consulenti e collaboratori', 'tipologie');

//Personale
wp_insert_term('Incarichi amministrativi di vertice', 'tipologie');
wp_insert_term('Dirigenti', 'tipologie');
wp_insert_term('Posizioni organizzative', 'tipologie');
wp_insert_term('Dotazione organica', 'tipologie');
wp_insert_term('Personale non a tempo indeterminato', 'tipologie');
wp_insert_term('Tassi di assenza', 'tipologie');
wp_insert_term('Incarichi conferiti e autorizzati ai dipendenti', 'tipologie');
wp_insert_term('Contrattazione collettiva', 'tipologie');
wp_insert_term('Contrattazione integrativa', 'tipologie');
wp_insert_term('OIV', 'tipologie');

//Bandi di Concorso
wp_insert_term('Bandi di Concorso', 'tipologie');

//Performance
wp_insert_term('Piano della Performance', 'tipologie');
wp_insert_term('Relazione sulla Performance', 'tipologie');
wp_insert_term('Ammontare complessivo dei premi', 'tipologie');
wp_insert_term('Dati relativi ai premi', 'tipologie');
wp_insert_term('Benessere organizzativo', 'tipologie');

//Enti controllati
wp_insert_term('Enti pubblici vigilati', 'tipologie');
wp_insert_term('Società partecipate', 'tipologie');
wp_insert_term('Enti di diritto privato controllati', 'tipologie');
wp_insert_term('Rappresentazione grafica', 'tipologie');

//Attività e procedimenti
wp_insert_term('Dati aggregati attività amministrativa', 'tipologie');
wp_insert_term('Tipologie di procedimento', 'tipologie');
wp_insert_term('Monitoraggio tempi procedimentali', 'tipologie');
wp_insert_term('Dichiarazioni sostitutive e acquisizione d\'ufficio dei dati', 'tipologie');

//Provvedimenti
wp_insert_term('Provvedimenti organi indirizzo-politico', 'tipologie');
wp_insert_term('Provvedimenti dirigenti', 'tipologie');

//Controlli sulle imprese
wp_insert_term('Controlli sulle imprese', 'tipologie');

//Bandi di gara e contratti
wp_insert_term('Bandi di gara e contratti', 'tipologie');

//Sovvenzioni, contributi, sussidi, vantaggi economici
wp_insert_term('Criteri e modalità', 'tipologie');
wp_insert_term('Atti di concessione', 'tipologie');

//Bilanci
wp_insert_term('Bilancio preventivo e consuntivo', 'tipologie');
wp_insert_term('Piano degli indicatori e risultati attesi di bilancio', 'tipologie');

//Beni immobili e gestione patrimonio
wp_insert_term('Patrimonio immobiliare', 'tipologie');
wp_insert_term('Canoni di locazione o affitto', 'tipologie');

//Controlli e rilievi sull'amministrazione
wp_insert_term('Controlli e rilievi sull\'amministrazione', 'tipologie');

//Servizi erogati
wp_insert_term('Carta dei servizi e standard di qualità', 'tipologie');
wp_insert_term('Costi contabilizzati', 'tipologie');
wp_insert_term('Tempi medi di erogazione dei servizi', 'tipologie');
wp_insert_term('Liste di attesa', 'tipologie');

//Pagamenti dell' amministrazione
wp_insert_term('Indicatore di tempestività dei pagamenti', 'tipologie');
wp_insert_term('IBAN e pagamenti informatici', 'tipologie');

//Opere pubbliche
wp_insert_term('Opere pubbliche', 'tipologie');

//Pianificazione e governo del territorio
wp_insert_term('Pianificazione e governo del territorio', 'tipologie');

//Informazioni ambientali
wp_insert_term('Informazioni ambientali', 'tipologie');

//Strutture sanitarie private accreditate
wp_insert_term('Strutture sanitarie private accreditate', 'tipologie');

//Interventi straordinari e di emergenza
wp_insert_term('Interventi straordinari e di emergenza', 'tipologie');

//Altri contenuti
//wp_insert_term('Altri contenuti', 'tipologie');

require_once(plugin_dir_path(__FILE__) . 'taxonomydescgenerator.php');

?>
