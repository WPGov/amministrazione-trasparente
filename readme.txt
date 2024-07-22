=== Amministrazione Trasparente ===
Contributors: Milmor
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=F2JK36SCXKTE2
Tags: amministrazione, aperta, trasparente, documenti, atti, spese, comuni, pa, amministrazioni, locali, pubblicazione, online, imprese, enti, scuola, università, comunità, montana, valle, modulo, software, gratuito, disposizioni, obbligo, legge, comune, modulo, decreto, 14 marzo, 2013, sovvenzioni, pubblici, pubblico, marco, milesi
Requires at least: 4.2
Tested up to: 6.6
Version: 8.1.3
Stable tag: 8.1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plugin completo per la gestione documentale di Amministrazione Trasparente nelle Pubbliche Amministrazioni (D.lgs. 33/2013)

== Description ==

Plugin completo per la gestione documentale di **Amministrazione Trasparente** (D.lgs. 33 del 14/03/2013 e successive integrazioni), riguardante il riordino della disciplina degli obblighi di pubblicità, trasparenza e diffusione di informazioni da parte delle pubbliche amministrazioni.

> Con questo plugin potrai gestire le sezioni richieste dalla normativa direttamente nel tuo sito WordPress, senza il bisogno di servizi esterni

= Caratteristiche =
* Aggiornamento costante, tecnico e normativo
* Inserimento rapido e intuitivo
* Supporto per la catalogazione avanzata delle voci (tassonomie e tag) e filtri amministrativi per la ricerca dei contenuti
* Soluzione ideale per ogni tipo di contenuto (documenti, testo, link,...)
* Gestione avanzata dei ruoli ("map-cap ready")
* Funzione di reindirizzamento delle voci a link esterni
* Personalizzazioni grafiche e numerosi shortcode
* Widget personalizzabili
* Compatibile con tutti i temi WordPress

= CONTATTI & SUPPORTO =
Per qualsiasi informazione, segnalare problemi o fornire feedback, seguici su [wpgov.it](https://www.wpgov.it/)

== Installation ==

http://www.youtube.com/watch?v=qWj9hvzNSlg

Puoi trovare la documentazione su [docs.wpgov.it](https://docs.wpgov.it/docs/category/amministrazione-trasparente)

== Screenshots ==
1. Menù Laterale
2. Pagina di inserimento Documento
3. Esempio visualizzazione in modalità tabella
4. Box di selezione della tipologia
5. Comoda opzione di Redirect
6. Visualizzazione Archivio Personalizzata (automatica su PASW2013; da aggiungere nel template negli altri temi con la funzione `<?php at_archive_buttons(); ?>`)
7. Visualizzazione automatica degli allegati in tutto il sito (opzionale)
8. Completo supporto back-end per tag, categorie e tipologie (con filtraggio)


== Changelog ==
> Di seguito la lista completa di aggiornamenti, test e correzioni. Aggiornare il prima possibile per usufruire delle ultime migliorie!

= 8.1.3 20240722 =
* Miglioramenti minori
* **Testato** e certificato su WP 6.6

= 8.1.2 20231027 =
* **Corretto** bug di visualizzazione widget in caso di configurazione personalizzata sezioni
* **Corretto** bug di salvataggio widget su Gutenberg
* **Migliorato** sistema di gestione widget
* **Testato** e certificato su WP 6.4

= 8.1.1 20231020 =
* **Corretto** bug per ancoraggio html tag [at-head] e [at-list]
* **Corretto** bug di caricamento dinamico gruppi tag [at-head]
* **Corretto** bug di visualizzazione in caso di cancellazione sezioni senza riconfigurazione gruppi

= 8.1 20231019 =
* **Migliorato** pannello impostazioni
* **Migliorato** report e checkup sezioni
* Settato su manage_options il ruolo minimo di accesso alle impostazioni (= solo ruolo amministratore)

= 8.0.10 20231003 =
* Corretto bug di mancata inizializzazione su nuove installazioni
* Correzioni e miglioramenti gestione impostazioni

= 8.0.5 20230830 =
* Fixed security bug - CVSS 3.1
* Aggiunta data di ultima modifica nella lista amministrativa per il custom post type amm-trasparente
* Miglioramenti prestazionali
* Rimozione di risorse interne non più utili

= 8.0.1 20230731 [!Major upgrade]=
**Attenzione: si consiglia backup prima dell'aggiornamento**

* **[NEW]** Added ability to customize AT categories
* Add new text is now converted from "Add -> Nuova Voce" to "Add -> Amministrazione Trasparente" in the top bar
* Improved post count in shortcode
* Various under-the-hood major improvements
* Old code and resources cleanup
* Tested up to WP 6.3

= 7.2.3 20221013 =
* Compatibilty check
* Minor improvements and bugfix

= 7.2 20220313 =
* **[NEW]** Added page-attributes support for custom post type
* Compatibilty check
* Minor improvements and bugfix

= 7.1.6 20210623 =
* Fixed redirect_url function
* Minor improvements

= 7.1.5 20210622 =
* Minor improvements and bugfix

= 7.1.1 20210616 =
* Compatibility check
* Minor improvements and bugfix

= 7.1 20200721 =
* **Aggiunto** supporto author al post Type
* Miglioramenti minori

= Versione 7.0 21/06/2020 =
* **Aggiunto** supporto alla modalità REST
* **Aggiunto** supporto **GUTENBERG** (se attivato nel sito)
* **Rimosso** supporto alla categorizzazione delle voci tramite post
* **Aggiunti** filtri di sviluppo e test
* **Corretto** errore PHP per richiamo widget deprecato
* **Miglioramenti** vari con eliminazione di parti di codice obsolete
* **Miglioramenti** generali e ottimizzazione di alcune funzioni
* **Compatibilità** certificata per WP > 5.4

= Versione 6.3.1 01/01/2019 =
* **Testato** con WP 5.x

= Versione 6.3 17/11/2017 =
* Aggiunta modalità DEBUG per velocizzare il supporto tecnico

= Versione 6.2 16/11/2017 =
* HOTFIX **CRITICO** PER WORDPRESS 4.9
* Descrizione errore: la funzione get_term_link di WordPress non accetta più il nome del termine di tassonomia (sezione at) in caso di caratteri speciali
* Grazie a **Alberto, Christian, Fabio, Francesco, Lorenzo e Verdiana** per la pronta segnalazione

= Versione 6.1.2 16/11/2017 =
* Version bump to retrigger update function on some websites

= Versione 6.1.1 07/11/2017 =
* WP 4.9 Tested
* readme.txt changes
* Version bump to retrigger update function on some websites

= Versione 6.1 25/10/2017 =
* Ridenominazione di alcune sezioni
* Aggiunta alcune sezioni
* **Per informazioni dettagliate consultare il menù "Trasparenza > Adeguamenti" in WordPress

= Versione 6.0 27/07/2017 =
* Ridenominazione di alcune sezioni
* Aggiunta macrosezione con sezioni non più richieste dalla normativa
* Aggiunta nuova pagina **Adeguamenti** con la lista delle modifiche alle sezioni di AT
* Miglioramenti importanti lato tecnico
* Riscrittura sistema di impostazioni [verificare corretta migrazione delle opzioni]
* Spostato menù impostazioni in "Trasparenza > Impostazioni"
* Questo aggiornamento è parte di un progetto di razionalizzazione e miglioramenti dei software [wpgov.it](https://www.wpgov.it/)]

= Versione 5.3.2 07/04/2017 (!) =
* BUGFIX

= Versione 5.3.1 07/04/2017 (!) =
* Aggiunta 2 sezioni 97/2016
* Modificato nome 1 sezione 97/2016
* Miglioramenti vari

= Versione 5.3 13/01/2017 (!) =
* **Riscritto** sistema di widget: comparirà un messaggio in amministrazione per richiederne la riconfigurazione nei siti in cui è attivo. Il nuovo widget sfrutta nuove API di WP e gestisce le sezioni in modo dinamico
* **Corretta** mancata visualizzazione della nuova sezione "Dati sui pagamenti" nel widget
* **Migliorate** prestazioni
* **Corretti** alcuni php warning

= Versione 5.2 11/01/2017 (!) =
* **[DLGS 97/2016]** Aggiunta sezione "Dati sui pagamenti" in "Pagamenti dell'amministrazione"
* **Aggiunti** alcuni riferimenti normativi di sezione. Si prega di verificare e proporre migliorie tramite i canali di supporto (per le sezioni mancanti o già attivate). Si veda il file **taxonomydescgenerator.php**
* **Corretto** errore di mancata visualizzazione riferimenti normativi per "Attestazioni OIV o di struttura analoga"
* **Corretto** richiamo a funzione deprecata in **shortcodes-search.php**
* **Corretti** alcuni php warning

= Versione 5.1.4 10/01/2017 =
* **Testato** con WP 4.7

= Versione 5.1.3 24/08/2016 =
* WP Compatibility check

= Versione 5.1.2 10/04/2016 =
* 4.5 compatibility check and minor bugfix

= Versione 5.1 23/11/2015 =
* Nuovo pannello impostazioni WPGov
* Nuova visualizzazione riferimenti normativi per le sezioni (HTML5)
* Aggiunga opzione per opacizzare sezioni vuote
* Aggiunto supporto a voci gerarchiche e ordinamento di visualizzazione
* Miglioramenti minori
* Incremento performance

= Versione 5.0.8 11/09/2015 =
* Miglioramenti performance minori
* Corretto bug che mancato aggiornamento descrizione tipologie (per vecchie installazioni)
* Modifiche minori
* Modifiche readme

= Versione 5.0.7 19/08/2015 =
* ReadMe changes
* 4.3 Compatibility Check

= Versione 5.0.6 31/05/2015 =
* **Correzione** refuso in una descrizione di sezione (grazie a Sara Lenzi - Comune di Prato)
* **Correzione** ancora html con tag at-head e at-list / at-table (deprecati) (grazie a Sara Lenzi)

= Versione 5.0.4 11/05/2015 =
* Corretto problema di accessibilità (grazie Riccardo Boccaccio)

= Versione 5.0.3 23/04/2015 =
* Tested on WordPress 4.2

= Versione 5.0.2 11/03/2015 =
* Miglioramento stabilità e velocità

= Versione 5.0 14/02/2015 =
* Nuovi shortcode (vedasi documentazione)
* Nuovi stili
* Riscritta generazione e gestione sezioni
* Miglioramento pannello WPGov

= Versione 4.2 01/02/2015 =
* Miglioramenti vari
* Miglioramenti pannello **wpgov**

= Versione 4.1.12 27/01/2015 =
* Corretto piccolo errore css

= Versione 4.1.11 16/01/2015 =
* Aggiornato modulo wpgov

= Versione 4.1.10 23/12/2014 =
* Testato per WordPress 4.1

= Versione 4.1.8 02/12/2014 =
* **Corretta** visualizzazione at-table

= Versione 4.1.6 28/11/2014 =
* **Corretta** divisione doppia colonna per lo shortcode at-table
* **Migliorate** performance
* **Rimosse** funzioni obsolete per gli archivi

= Versione 4.1.5 9/11/2014 =
* **Corretto** malfunzionamento shortcode per la ricerca
* Introdotto html5 per lo shortcode di ricerca

= Versione 4.1.4 30/10/2014 =
* Modifiche readme.txt

= Versione 4.1.3 25/10/2014 =
* **Aggiunti** altri controlli per template pasw2013 (nomecartella+nometema+forzatemplate)

= Versione 4.1.1 24/10/2014 =
* **Rimossa** opzione briciole di pane nella visualizzazione singola
* **Migliorate** performance
* **Aggiunte** condizioni per evitare forzature di template pasw2013 in pasw2015

= Versione 4.1 21/10/2014 =
* **Aggiunto** shortcode 'at-search'

= Versione 4.0.6 10/10/2014 =
* **Migliorato** css pagina wpgov

= Versione 4.0.5 28/08/2014 =
* Cambiamenti minori al file readme.txt

= Versione 4.0.4 20/07/2014 =
* **Testato** su WordPress 4.0

= Versione 4.0.3 29/06/2014 =
* **Migliorato** pannello impostazioni condiviso

= Versione 4 #Gasw (Giornata Apera sul Web) - 26.05.2014 =
* Rebranding wpgov.it
* Molte migliorie :)

= Versione 3.9.5 9/04/2014 =
* **Risolti** 2 errori di validazione xhtml per il tag **at-table** // Grazie @Marisa Alario e @Caterina Toccafondi
* **Rimossi** file di aggiornamento dalla versione 1.1.2 (già inattivi dal 10 gennaio 2014) per fine supporto della stessa

= Versione 3.9.4 12/03/2014 =
* Corretto slash erroneamente visualizzato in "Documento dell\'OIV di validazione della Relazione sulla Performance"

= Versione 3.9 =
* **RIMOSSA sezione "Scadenziario obblighi amministrativi" in "Disposizioni Generali"**
* **SOSTITUITA sezione "Altri Contenuti" con "Dati Ulteriori" in "Altri Contenuti"**
* **AGGIUNTA sezione "Sistema di misurazione e valutazione della Performance" in "Performance"**
* **AGGIUNTA sezione "Documento dell'OIV di validazione della Relazione sulla Performance" in "Performance"**
* **AGGIUNTA sezione "Class action" in "Servizi erogati"**
* **AGGIUNTA sezione "Corruzione" in "Altri Contenuti"**
* **AGGIUNTA sezione "Accesso civico" in "Altri Contenuti"**
* **AGGIUNTA sezione "Accessibilità e Catalogo di dati, metadati e banche dati" in "Altri Contenuti"**
* Ottimizzazioni varie :)
* **3.9.1** - Corretto tag mancante
* **3.9.2** - Aridaje
* **3.9.3** - Corretto problema "Catchable Fatal Error" per la sezione "Dati Ulteriori"

= Versione 3.8.1 =
* **Corretto** aspetto at-table con <div class="clear">

= Versione 3.8 11/01/2014 =
* **Aggiunta sezione "Scadenzario obblighi amministrativi" in "Disposizioni Generali"**
* **Aggiunta sezione "Burocrazia zero" in "Disposizioni Generali"**
* **RIMOSSO** WP ATTACHMENTS. E' ora necessario installarlo a parte per continuare ad utilizzarlo! (viene notificato in bacheca se era attivato)
* **RIMOSSO** MAP-CAP.
* **Aggiunto** nuovo sistema per la gestione di ruoli & permessi, con tutorial (consultare Trasparenza > Impostazioni)
* **Ridotto** impatto sulle performance del sito del **75%**: caricamento di A.T. ottimizzato (0.16/0.17s -> 0.04/0.05s)
* Ottimizzazioni varie :)

= Versione 3.7.3 07/01/2014 =
* **Corretta** mancata visualizzazione titolo archivio pasw (tipologie a.t. // ditte avcp // annirif avcp)

= Versione 3.7.2 07/01/2013 =
* **Aggiunti** controlli aggiuntivi per usare il template archivio pasw2013 anche nel plugin AVCP
* Perfezionato codice paswarchive.php (per chi usa il tema della comunità di pratica Porte Aperte sul Web)

= Versione 3.7.1 02/01/2013 =
* **Aggiunto** tag </ul> mancante nel widget lista completa
* **Corretta** visualizzazione versione in Trasparenza -> Impostazioni
* **Rimossa** funzione per salvare la versione del plugin all'attivazione (non funzionava per gli aggiornamenti)

= Versione 3.7 31/12/2013 "BUON ANNO" =
* **Corretti** decine di errori di validazione // Grazie Riccardo Boccaccio - iclucca2.gov.it
* **Aggiunta** opzione per associare i tag alle voci (opt-out) [prima era sempre attiva]
* **Migliorato** css visualizzazione lista/tabella (nascosta sottolineatura titoli h3)
* **Migliorato** Css Backend (più pulito e veloce)
* **Migliorata** pagina Impostazioni
* **Migliorata** chiarezza dei messaggi di errore, e rimozione di alcuni di essi
* **Rimossa** pagina "Info & Aiuto" [integrata in Impostazioni]
* Aggiunto link donazione PayPal

= Versione 3.6.5 30/12/2013 =
* **Corretto** possibile conflitto della funzione di ricerca nel metabox tipologie (Nuova Voce) // AGGIORNATO IN PARALLELO AD AVCP

= Versione 3.6.4.1 15/12/2013 =
* Piccola svista :)

= Versione 3.6.4 15/12/2013 =
* **Ripristinato** mancato attivamento di WP-Attachments per via di un inverso caricamento cronologico dei file // Segnalazione di Giovanna Orrù
* Aggiunta sezione ringraziamenti nella descrizione del plugin

= Versione 3.6.3 15/12/2013 =
* **Corretto** (per davvero) il bug che impediva di nascondere le notifiche del plugin

= Versione 3.6.2 13/12/2013 "Regalo di Santa Lucia" =
* **Corretto** conflitto con il plugin avcp xml

= Versione 3.6.1 13/12/2013 "Regalo di Santa Lucia" =
* **Corretto** bug mancata rimozione dell'avviso avcp su click

= Versione 3.6 13/12/2013 "Regalo di Santa Lucia" =
* **Modificato** css per [at-table]: Css **fluido**
* **Aggiunti** i riferimenti normativi mancanti delle sezioni
* **Rimosso** codice per visualizzazione report e statistiche nella bacheca (non supportato da Wordpress 3.8)
* **Aggiunta** casella di ricerca nel metabox "Tipologie"
* Migliorate performance: alcune funzioni vengono ora caricate con admin_init invece che _init
* Rimosso codice che nascondeva il menù "Trasparenza" in caso di utenti senza permesso (conflitto con map-cap)
* Compatibile con Wordpress **3.8**
* **Aggiunto** invito all'installazione del plugin Wordpress AVCP

= Versione 3.5.1 19/10/2013 =
* **Corretto** bug della mancata visualizzazione di alcuni menù del template pasw2013 in alcune pagine di archivio

= Versione 3.5 16/10/2013 =
* **Aggiunta** sotto-sezione "Attestazioni OIV o struttura analoga"
* **Aggiunta** opzione per scegliere di mostrare i riferimenti normativi senza dovere cliccare [+] e [-] nelle visualizzazioni di archivio
* **Integrato** plugin map-cap, attivabile dalle impostazioni del plugin - Permette la gestione avanzata di ruoli/permessi di A.T. [SPERIMENTALE]

* **Migliorato** aspetto widget espandibile: tutta la riga della sezione è ora cliccabile (e non solo [+] e [-])

* **Migliorate** performance in admin-messages.php (visualizzazzione messaggi nell'amministrazione di Wordpress)
* **Corretti** alcuni errori di validazione in at-list / at-table
* **Corretto** errore di battitura in widget-output-collapse.php (file che genera il widget espanbilie) | Segnalazione di Igor Vita
* **Corretto** bug a causa di possibili conflitti in admin-messages.php | Segnalazione di Prof. L.Pernici
* **Aggiunto** un disclaimer promemoria di esclusione di responsabilità nel file readme.txt (in accordo con la licenza GPL v.2 con cui questo software viene fornito)
* **Correzioni** grammaticali minori (readme e stringhe plugin)
* Testato su Wordpress 3.7

= Versione 3.4.1 22/09/2013 =
* **Corretto** bug che causava il mancato caricamento di alcuni moduli integrati (es. widget)

= Versione 3.4 22/09/2013 =
* **Aggiunta** la possibilità di associare le voci alle categorie degli articoli per visualizzarle, per esempio, in homepage (notizie, avvisi,...) - Funzione sperimentale attivabile dalle impostazioni
* **Migliorata** funzione di visualizzazione congiunta articoli/documenti-trasparenza negli archivi di Wordpress
* **Modificato** tag [at-desc] per la visualizzazione di un link con riferimenti normativi
* **Corretto** piccolo problema html del widget lista completa (per alcuni browser)
* **Eliminato** flush_rewrite all'attivazione/disattivazione
* **Migliorata** funzione di aggiornamento database richiamata solo con utenti amministratori
* **Aggiunto** messaggio di notifica WP Attachments
* **Migliorata** performance e possibili errori durante l'inizializzazione di alcune funzioni (sl. alcune configurazioni server)

* **Cambiato** metodo di integrazione di WP Attachments! Controllare le impostazioni!
* **Aggiornato** il plugin integrato [WP Attachments](http://wordpress.org/plugins/wp-attachments/) ( v3.0.3 -> v3.1)
* WP-Attachments | **Aggiunta** la possibilità di escludere i file immagine dalla lista degli allegati

= Versione 3.3 23/08/2013 =
* **Aggiornato** il plugin integrato [WP Attachments](http://wordpress.org/plugins/wp-attachments/) ( v2.0 -> v3.0.3)
* **Aggiunte** nuove opzioni per la visualizzazione degli allegati grazie al plugin integrato WP Attachments
* **Migliorato** il pannello delle impostazioni
* **Sistemata** posizione del link 'Mostra un po' di amore' nella visualizzazione at-table
* **Corretti** alcuni problemi di visualizzazione negli archivi delle categorie di Wordpress (es. widget o menù invisibili) | Segnalato da [@ClaudiaCantaluppi](http://profiles.wordpress.org/ClaudiaCantaluppi)
* **Eliminata** la visualizzazione di messaggi di benvenuto e informazioni del plugin per ruoli diversi da 'Amministratore'

= Versione 3.2.2 21/08/2013 =
* **Cambiati** tag 'name' deprecati in 'id' (visualizzazione list + table) (compatibile con WP Accessibility) | Grazie [@ClaudiaCantaluppi](http://profiles.wordpress.org/ClaudiaCantaluppi)
* **Aumentata** distanza tra list/table e il link alla pagina *nofollow* del plugin (se attivata l'opzione 'Mostra un po' di amore')

= Versione 3.2.1 21/08/2013  =
* Correzione file repository wordpress

= Versione 3.2 21/08/2013  =
* **Abilitate** briciole di pane native PASW2013 sulla visualizzazione archivio
* **Aggiunta** opzione per mostrare le briciole di pane sulla visualizzazione singola
* **Migliorato** il pannello delle impostazioni con opzioni suddivise e logo pasw!
* **Aggiunto** pulsante 'Aggiorna Permalink' nel pannello delle impostazioni del plugin
* **Disponibile** una mini-guida per la configurazione ottimale di Breadcrumb NavXT disponibile [QUI](http://amministrazionetrasparente.marcomilesi.ml/bricioledipane_ammtrasparente_navxt.jpg)
* **Aggiornata** funzione deprecata per ottenere file nelle sotto-directory del plugin in styledbackend.php
* **Migliorata** suddivione logica dei file nelle cartelle del plugin (aggiunta directory /includes)
* **BugFix** - mancato nascondimento del messaggio di benvenuto in alcuni casi

= Versione 3.1 20/08/2013  =
* Abilitata visualizzazione 'Cross-Type' degli archivi per i tag

= Versione 3.0.2 19/08/2013  =
* BugFix - Risolto problema che non mostrava il widget espandibile

= Versione 3.0.1 19/08/2013  =
* BugFix - Sistemato mancato caricamento della pagina con la visualizzazione "logic" del plugin impostata
* BugFix - Sistemato problema di alcuni link 'Torna alla Lista' che non convertivano l'id pagina inserito nelle impostazioni del plugin

= Versione 3 19/08/2013   =
* Aggiunta opzione **WIDGET** "Visualizza solo sulle pagine archivio e singole dei documenti"
* Aggiunto file **single.php** con visualizzazione tipologia [SOLO PASW2013]
* Aggiunta funzione utilizzabile in tutti i temi per mostrare la descrizione della tipologia e il pulsante "Torna al Sommario"(vedi [Installazione](http://wordpress.org/plugins/amministrazione-trasparente/installation/))
* Abilitato **supporto per i TAG**
* Aggiunta opzione per forzare l'utilizzo dei template PASW2013 (abilitare se è installata una versione precedente o se è stato cambiato il nome del tema (vedi impostazioni plugin)
* Aggiunto avviso di mancato inserimento ID per l'impostazione "Torna alla lista" - rimozione del campo 'URL'
* Nuova **Guida PDF** per gli uffici [scaricabile gratuitamente](http://wordpress.org/plugins/amministrazione-trasparente/)

* **Migliorato filtraggio** documenti nella gestione web (codice + snello & visualizzazione più pulita)
* Migliorata suddivisione logica dei file del plugin
* Modificata stringa "Torna alla lista" in "Torna al sommario"
* Migliorato CSS widget: testo e 'pulsanti [+]' sono più piccoli
* Riscritto pannello informazioni del plugin
* Riscritto file ReadMe

* BugFix - Forzato aggiornamento automatico dei Permalink all'attivazione/disattivazione del plugin
* BugFix - Migliorata la funzione di switch template per pasw2013
* BugFix - Sostituzione funzione deprecata get_current_theme() con wp_get_theme()
* BugFix - Sistemata posizione link "Questo sito utilizza il modulo Wordpress Amministrazione Trasparente" in [at-table]

= Versione 2.2.1 27/07/2013 =
* BugFix - Eliminata visualizzazione template personaizzato in tutti gli archivi

= Versione 2.2 26/07/2013 =
* Visualizzazione automatica di tutti i formati di allegati

= Versione 2.1.3 24/07/2013 =
* Aggiunto aggiornamento automatico dei Permalink all'attivazione
* BugFix - Correzione stringa Copyright (se attiva in at-list)

= Versione 2.1.2 23/07/2013 =
* Correzione stringa Metabox Redirect
* BugFix - Risolto problema che causava l'apparizione dello shortcode sempre in alto

= Versione 2.1.1 23/07/2013 =
* Risolto Problema changelog
* Aggiunti screenshot per wordpress.org

= Versione 2.1 23/07/2013 =
* I titoli dei documenti nell'archivio PASW2013 sono ora in h3
* Aggiunta possibilità di usare i riassunti
* Aggiunto possibilità di usare le revisioni
* Aggiunta slug /trasparenza/ al post di /tipologie/
* Aggiunta paginazione archivio /page/2
* Metabox per il reindirizzamento più visibile (sopra il riquadro "Pubblica")
* BugFix - Risolta mancata attivazione archivio PASW2013 in configurazioni "Case-Sensitive"

= Versione 2.0 22/07/2013 =
* Nuovo tag [at-head] per mostrare un sommario delle voci
* Nuovo tag [at-desc] per mostare la descrizione dell'iniziativa Amministrazione Trasparente
* Nuova funzione per reindirizzare gli articoli a pagine già esistenti o esterne
* Nuovo Widget con tutte le categorie (possibilità di categorie espandibili)
* Aggiunta visualizzazione numero post e tipologie in "Stato Attuale" (bacheca wp-admin)
* Template archivio speciale per PASW2013 (+riferimenti normativi +pulsante "Torna alla lista" - da specificare nelle impostazioni!)
* BugFix - Sistemato spazio # stringa "Programma per la Trasparenza e l'#Integrità"

= Versione 1.2.1 08/07/2013 =
* Miglioramento strutturale del codice (Accessibilità L.Stanca 2004 e successive)

= Versione 1.2 05/07/2013 =
* Possibilità di filtrare i documenti (back-end)
* Modifica pagina "Informazioni" in "Info & Aiuto", con più dettagli

= Versione 1.1.1.2 04/07/2013 =
* Modifica file ReadMe

= Versione 1.1.1.1 =
* Modifica file ReadMe

= Versione 1.1.1 =
* Correzione Stable Tag repository wordpress
* Correzione CSS background (back-end)
* Correzione stringhe front-end (list/table)

= Versione 1.1 =
* Aggiunta testo introduttivo - front-end
* Integrazione PressTrends - I/O
* Visualizzazione automatica file allegati

= Versione 1.0 03/07/2013 =
* Prima release

= Versione 0.1-0.2 =
* Lancio del Progetto
* Programmazione funzionalità

(!) = Aggiornamento Importante (Sicurezza/Stabilità)
