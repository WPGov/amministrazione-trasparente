<style>h3 a {text-decoration:none!important;}</style>
<?php
$get_version_number = get_option('at_version_number');
echo '<!-- Generato con il Plugin Wordpress Amministrazione Trasparente v.' . $get_version_number . '-->';

//Disposizioni Generali
echo '<h3><a id="disposizionigenerali">' . 'Disposizioni Generali' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Programma per la Trasparenza e l'Integrità"; //L'output del nome qui sotto è impostato per togliere lo spazio tra l'#integrità
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Atti generali";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Oneri informativi per cittadini e imprese";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Attestazioni OIV o di struttura analoga";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Burocrazia zero";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Organizzazione
echo '<h3><a id="organizzazione">' . 'Organizzazione' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Organi di indirizzo politico-amministrativo";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Sanzioni per mancata comunicazione dei dati";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Rendiconti gruppi consiliari regionali/provinciali";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Articolazione degli uffici";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Telefono e posta elettronica";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Consulenti e collaboratori
echo '<h3><a id="consulentiecollaboratori">' . 'Consulenti e collaboratori' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Consulenti e collaboratori";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Personale
echo '<h3><a id="personale">' . 'Personale' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Incarichi amministrativi di vertice";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Dirigenti";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Posizioni organizzative";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Dotazione organica";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Personale non a tempo indeterminato";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Tassi di assenza";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Incarichi conferiti e autorizzati ai dipendenti";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Contrattazione collettiva";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Contrattazione integrativa";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "OIV";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Bandi di Concorso
echo '<h3><a id="bandidiconcorso">' . 'Bandi di Concorso' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Bandi di Concorso";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Performance
echo '<h3><a id="performance">' . 'Performance' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Sistema di misurazione e valutazione della Performance";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Piano della Performance";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Relazione sulla Performance";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Documento dell'OIV di validazione della Relazione sulla Performance";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Ammontare complessivo dei premi";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Dati relativi ai premi";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Benessere organizzativo";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Enti controllati
echo '<h3><a id="enticontrollati">' . 'Enti controllati' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Enti pubblici vigilati";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Società partecipate";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Enti di diritto privato controllati";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Rappresentazione grafica";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Attività e procedimenti
echo '<h3><a id="attivitaeprocedimenti">' . 'Attività e procedimenti' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Dati aggregati attività amministrativa";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Tipologie di procedimento";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Monitoraggio tempi procedimentali";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Dichiarazioni sostitutive e acquisizione d'ufficio dei dati";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Provvedimenti
echo '<h3><a id="provvedimenti">' . 'Provvedimenti' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Provvedimenti organi indirizzo-politico";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Provvedimenti dirigenti";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Controlli sulle imprese
echo '<h3><a id="controllisulleimprese">' . 'Controlli sulle imprese' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Controlli sulle imprese";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Bandi di gara e contratti
echo '<h3><a id="bandidigaraecontratti">' . 'Bandi di gara e contratti' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Bandi di gara e contratti";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Sovvenzioni, contributi, sussidi, vantaggi economici
echo '<h3><a id="sovvenzionicontributisussidivantaggieconomici">' . 'Sovvenzioni, contributi, sussidi, vantaggi economici' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Criteri e modalità";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Atti di concessione";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Bilanci
echo '<h3><a id="bilanci">' . 'Bilanci' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Bilancio preventivo e consuntivo";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Piano degli indicatori e risultati attesi di bilancio";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Beni immobili e gestione patrimonio
echo '<h3><a id="beniimmobiliegestionepatrimonio">' . 'Beni immobili e gestione patrimonio' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Patrimonio immobiliare";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Canoni di locazione o affitto";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Controlli e rilievi sull'amminiztrazione
echo '<h3><a id="controllierilievisullamministrazione">' . 'Controlli e rilievi sull\'amministrazione' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Controlli e rilievi sull'amministrazione";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Servizi erogati
echo '<h3><a id="servizierogati">' . 'Servizi erogati' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Carta dei servizi e standard di qualità";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Class action";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Costi contabilizzati";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Tempi medi di erogazione dei servizi";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Liste di attesa";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Pagamenti dell' amministrazione
echo '<h3><a id="pagamentidellamministrazione">' . 'Pagamenti dell\'amministrazione' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Indicatore di tempestività dei pagamenti";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "IBAN e pagamenti informatici";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Opere pubbliche
echo '<h3><a id="operepubbliche">' . 'Opere pubbliche' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Opere pubbliche";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Pianificazione e governo del territorio
echo '<h3><a id="pianificazioneegovernodelterritorio">' . 'Pianificazione e governo del territorio' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Pianificazione e governo del territorio";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Informazioni ambientali
echo '<h3><a id="informazioniambientali">' . 'Informazioni ambientali' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Informazioni ambientali";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Strutture sanitarie private accreditate
echo '<h3><a id="strutturesanitarieprivateaccreditate">' . 'Strutture sanitarie private accreditate' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Strutture sanitarie private accreditate";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Interventi straordinari e di emergenza
echo '<h3><a id="interventistraordinariediemergenza">' . 'Interventi straordinari e di emergenza' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Interventi straordinari e di emergenza";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';

//Altri contenuti
echo '<h3><a id="altricontenuti">' . 'Altri contenuti' . '</a></h3>';
echo '<ul>';
$nome_tipologia = "Corruzione";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Accesso civico";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Accessibilità e Catalogo di dati, metadati e banche dati";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Dati ulteriori";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul><div class="clear"></div><br/>';

$get_show_love = get_option('at_option_love');
if ($get_show_love == '1') {
	echo '<hr><div style="font-size:0.8em;">Questo sito utilizza il modulo Wordpress <a href="http://wordpress.org/plugins/amministrazione-trasparente/" rel="nofollow" title="Plugin Amministrazione Trasparente per Wordpress">Amministrazione Trasparente</a></div>';
}

?>