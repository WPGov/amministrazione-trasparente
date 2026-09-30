# Amministrazione Trasparente

Plugin WordPress per la gestione della sezione Amministrazione Trasparente ai sensi del D.lgs. n. 33 del 14/03/2013 e successive integrazioni.

[![WordPress plugin](https://img.shields.io/wordpress/plugin/v/amministrazione-trasparente.svg)](https://it.wordpress.org/plugins/amministrazione-trasparente/)
[![Active Installs](https://img.shields.io/wordpress/plugin/installs/amministrazione-trasparente.svg)](https://it.wordpress.org/plugins/amministrazione-trasparente/)
[![Downloads](https://img.shields.io/wordpress/plugin/dt/amministrazione-trasparente.svg)](https://it.wordpress.org/plugins/amministrazione-trasparente/)

Pubblica, organizza e mantieni aggiornati i documenti obbligatori direttamente dal sito WordPress dell'ente, senza servizi esterni.

## Funzionalità

- Tipo di contenuto dedicato ai documenti, catalogati per sezione
- Sezioni predefinite secondo la normativa, personalizzabili e riordinabili per gruppo
- Blocco Gutenberg e shortcode per la pagina pubblica delle sezioni
- Schermata **Revisione** con documenti pubblicati, bozze e documenti da rivedere per ogni sezione
- Checkup della configurazione: sezioni senza gruppo, duplicate, documenti senza sezione
- Widget con l'elenco delle sezioni
- Reindirizzamento di un documento a un link esterno
- Gestione avanzata dei ruoli con capability dedicate
- Compatibile con ogni tema, con supporto specifico per PASW2013 e Design Comuni

## Requisiti

- WordPress 5.0+
- PHP 7.0+

## Installazione

Dal pannello di WordPress: **Plugin → Aggiungi nuovo → cerca "Amministrazione Trasparente"**.

Dopo l'attivazione, configura sezioni e opzioni da **Trasparenza → Impostazioni**, poi inserisci nella pagina pubblica il blocco Gutenberg oppure lo shortcode `[amministrazione-trasparente]`.

## Shortcode

| Shortcode | Descrizione |
| --- | --- |
| `[amministrazione-trasparente]` | Elenco delle sezioni, con le stesse opzioni del blocco Gutenberg |
| `[at-sezioni]` | Elenco delle sezioni in colonne (`col`), con barra di ricerca (`bar`) e contatori (`con`) |
| `[at-search]` | Modulo di ricerca tra i documenti |
| `[at-head]` | Indice dei gruppi con link alle ancore |
| `[at-desc]` | Testo descrittivo introduttivo |

Nei template dei temi, `<?php at_archive_buttons(); ?>` mostra la navigazione tra le sezioni nelle pagine di archivio.

## Contribuire

Segnalazioni e pull request sono benvenute.

## Link

- [Pagina del plugin su WordPress.org](https://it.wordpress.org/plugins/amministrazione-trasparente/)
- [Documentazione](https://docs.wpgov.it/docs/category/amministrazione-trasparente)
- [Changelog](readme.txt)
- Parte di [WPGov.it](https://www.wpgov.it), open source per i siti della Pubblica Amministrazione italiana

## Credits

Copyright © 2012-2027 **Marco Milesi**
[www.marcomilesi.com](https://www.marcomilesi.com) - [www.wpgov.it](https://www.wpgov.it)
