<!--CSS Code-->
<style type="text/css">
.row {vertical-align: top; height:auto !important; font-size: 0.9em;}
.list {display:none;}
.show {display:none;}
.hide:target + .show {display:inline;}
.hide:target {display:none;}
.hide:target ~ .list {display:inline;}
@media print {.hide, .show {display:none;}}
</style>
 
 
<!-- Disposizioni Generali -->
<div class="row">
<a href="#hide1" class="hide" id="hide1">[+]&nbsp;<b>Disposizioni Generali</b></a>
<a href="#show1" class="show" id="show1">[-]&nbsp;<b>Disposizioni Generali</b></a> 

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Programma per la Trasparenza e l'Integrità";
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
?>
</div>
</div>

<!-- Organizzazione -->
<div class="row">
<a href="#hide2" class="hide" id="hide2">[+]&nbsp;<b>Organizzazione</b></a> 
<a href="#show2" class="show" id="show2">[-]&nbsp;<b>Organizzazione</b></a> 

<div class="list">
<?php
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
?>
</div>
</div>

<!--Consulenti e collaboratori-->
<div class="row">
<a href="#hide3" class="hide" id="hide3">[+]&nbsp;<b>Consulenti e collaboratori</b></a>
<a href="#show3" class="show" id="show3">[-]&nbsp;<b>Consulenti e collaboratori</b></a>

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Consulenti e collaboratori";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';
?>
</div>
</div>

<!-- Personale -->
<div class="row">
<a href="#hide4" class="hide" id="hide4">[+]&nbsp;<b>Personale</b></a> 
<a href="#show4" class="show" id="show4">[-]&nbsp;<b>Personale</b></a> 

<div class="list">
<?php
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
?>
</div>
</div>

<!-- Bandi di Concorso -->
<div class="row">
<a href="#hide5" class="hide" id="hide5">[+]&nbsp;<b>Bandi di Concorso</b></a> 
<a href="#show5" class="show" id="show5">[-]&nbsp;<b>Bandi di Concorso</b></a> 

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Bandi di Concorso";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';
?>
</div>
</div>

<!-- Performance -->
<div class="row">
<a href="#hide6" class="hide" id="hide6">[+]&nbsp;<b>Performance</b></a> 
<a href="#show6" class="show" id="show6">[-]&nbsp;<b>Performance</b></a>

<div class="list">
<?php
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
?>
</div>
</div>

<!-- Enti controllati -->
<div class="row">
<a href="#hide7" class="hide" id="hide7">[+]&nbsp;<b>Enti controllati</b></a> 
<a href="#show7" class="show" id="show7">[-]&nbsp;<b>Enti controllati</b></a> 

<div class="list">
<?php
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
?>
</div>
</div>

<!-- Attività e procedimenti -->
<div class="row">
<a href="#hide8" class="hide" id="hide8">[+]&nbsp;<b>Attività e procedimenti</b></a> 
<a href="#show8" class="show" id="show8">[-]&nbsp;<b>Attività e procedimenti</b></a> 

<div class="list">
<?php
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
?>
</div>
</div>

<!-- Provvedimenti -->
<div class="row">
<a href="#hide9" class="hide" id="hide9">[+]&nbsp;<b>Provvedimenti</b></a> 
<a href="#show9" class="show" id="show9">[-]&nbsp;<b>Provvedimenti</b></a> 

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Provvedimenti organi indirizzo-politico";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Provvedimenti dirigenti";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';
?>
</div>
</div>

<!-- Controlli sulle imprese -->
<div class="row">
<a href="#hide10" class="hide" id="hide10">[+]&nbsp;<b>Controlli sulle imprese</b></a> 
<a href="#show10" class="show" id="show10">[-]&nbsp;<b>Controlli sulle imprese</b></a> 

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Controlli sulle imprese";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';
?>
</div>
</div>

<!-- Bandi di gara e contratti -->
<div class="row">
<a href="#hide11" class="hide" id="hide11">[+]&nbsp;<b>Bandi di gara e contratti</b></a> 
<a href="#show11" class="show" id="show11">[-]&nbsp;<b>Bandi di gara e contratti</b></a> 

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Bandi di gara e contratti";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';
?>
</div>
</div>

<!-- Sovvenzioni, contributi, sussidi, vantaggi economici -->
<div class="row">
<a href="#hide12" class="hide" id="hide12">[+]&nbsp;<b>Sovvenzioni, contributi, sussidi, vantaggi economici</b></a> 
<a href="#show12" class="show" id="show12">[-]&nbsp;<b>Sovvenzioni, contributi, sussidi, vantaggi economici</b></a> 

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Criteri e modalità";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Atti di concessione";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';
?>
</div>
</div>

<!-- Bilanci -->
<div class="row">
<a href="#hide13" class="hide" id="hide13">[+]&nbsp;<b>Bilanci</b></a> 
<a href="#show13" class="show" id="show13">[-]&nbsp;<b>Bilanci</b></a> 

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Bilancio preventivo e consuntivo";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Piano degli indicatori e risultati attesi di bilancio";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';
?>
</div>
</div>

<!-- Beni immobili e gestione patrimonio -->
<div class="row">
<a href="#hide14" class="hide" id="hide14">[+]&nbsp;<b>Beni immobili e gestione patrimonio</b></a> 
<a href="#show14" class="show" id="show14">[-]&nbsp;<b>Beni immobili e gestione patrimonio</b></a> 

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Patrimonio immobiliare";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Canoni di locazione o affitto";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';
?>
</div>
</div>

<!-- Controlli e rilievi sull'amministrazione -->
<div class="row">
<a href="#hide15" class="hide" id="hide15">[+]&nbsp;<b>Controlli e rilievi sull'amministrazione</b></a> 
<a href="#show15" class="show" id="show15">[-]&nbsp;<b>Controlli e rilievi sull'amministrazione</b></a> 

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Controlli e rilievi sull'amministrazione";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';
?>
</div>
</div>

<!-- Servizi erogati -->
<div class="row">
<a href="#hide16" class="hide" id="hide16">[+]&nbsp;<b>Servizi erogati</b></a> 
<a href="#show16" class="show" id="show16">[-]&nbsp;<b>Servizi erogati</b></a> 

<div class="list">
<?php
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
?>
</div>
</div>

<!-- Pagamenti dell'amministrazione -->
<div class="row">
<a href="#hide17" class="hide" id="hide17">[+]&nbsp;<b>Pagamenti dell'amministrazione</b></a> 
<a href="#show17" class="show" id="show17">[-]&nbsp;<b>Pagamenti dell'amministrazione</b></a> 

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Indicatore di tempestività dei pagamenti";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "IBAN e pagamenti informatici";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';
?>
</div>
</div>

<!-- Opere pubbliche -->
<div class="row">
<a href="#hide18" class="hide" id="hide18">[+]&nbsp;<b>Opere pubbliche</b></a> 
<a href="#show18" class="show" id="show18">[-]&nbsp;<b>Opere pubbliche</b></a> 

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Opere pubbliche";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';
?>
</div>
</div>

<!-- Pianificazione e governo del territorio -->
<div class="row">
<a href="#hide19" class="hide" id="hide19">[+]&nbsp;<b>Pianificazione e governo del territorio</b></a> 
<a href="#show19" class="show" id="show19">[-]&nbsp;<b>Pianificazione e governo del territorio</b></a> 

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Pianificazione e governo del territorio";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';
?>
</div>
</div>

<!-- Informazioni ambientali -->
<div class="row">
<a href="#hide20" class="hide" id="hide20">[+]&nbsp;<b>Informazioni ambientali</b></a> 
<a href="#show20" class="show" id="show20">[-]&nbsp;<b>Informazioni ambientali</b></a> 

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Informazioni ambientali";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';
?>
</div>
</div>

<!-- Strutture sanitarie private accreditate -->
<div class="row">
<a href="#hide21" class="hide" id="hide21">[+]&nbsp;<b>Strutture sanitarie private accreditate</b></a> 
<a href="#show21" class="show" id="show21">[-]&nbsp;<b>Strutture sanitarie private accreditate</b></a> 

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Strutture sanitarie private accreditate";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';
?>
</div>
</div>

<!-- Interventi straordinari e di emergenza -->
<div class="row">
<a href="#hide22" class="hide" id="hide22">[+]&nbsp;<b>Interventi straordinari e di emergenza</b></a> 
<a href="#show22" class="show" id="show22">[-]&nbsp;<b>Interventi straordinari e di emergenza</b></a> 

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Interventi straordinari e di emergenza";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';
?>
</div>
</div>

<!-- Altri contenuti -->
<div class="row">
<a href="#hide23" class="hide" id="hide23">[+]&nbsp;<b>Altri contenuti</b></a> 
<a href="#show23" class="show" id="show23">[-]&nbsp;<b>Altri contenuti</b></a> 

<div class="list">
<?php
echo '<ul>';
$nome_tipologia = "Corruzione";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Accesso civico";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Accessibilità e Catalogo di dati, metadati e banche dati";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
$nome_tipologia = "Dati ulteriori";
echo '<li><a href="' . get_term_link( $nome_tipologia, 'tipologie' ) . '" title="' . $nome_tipologia . '">' . $nome_tipologia . '</a></li>';
echo '</ul>';
?>
</div>
</div>