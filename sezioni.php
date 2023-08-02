<?php

function at_get_taxonomy_groups() {
      $return = array();
      foreach ( amministrazionetrasparente_getarray() as $arr ) {
            $return[] = $arr[0];
      }
      return $return;
}

function amministrazionetrasparente_getarray() {

      if ( function_exists('amministrazionetrasparente_getarray_custom') ) {
            return amministrazionetrasparente_getarray_custom();
      }

      return array(
            array("Disposizioni Generali",
                  array(
                        "Piano triennale per la prevenzione della corruzione e della trasparenza",
                        "Atti generali",
                        "Oneri informativi per cittadini e imprese"
                  )
            ),

            array("Organizzazione",
                  array(
                  "Titolari di incarichi politici, di amministrazione, di direzione o di governo",
                  "Sanzioni per mancata comunicazione dei dati",
                  "Rendiconti gruppi consiliari regionali/provinciali",
                  "Articolazione degli uffici",
                  "Telefono e posta elettronica"
                  )
            ),

            array("Consulenti e collaboratori",
                  array(
                  "Titolari di incarichi di collaborazione o consulenza"
                  )
            ),

            array("Personale",
                  array(
                  "Titolari di incarichi dirigenziali amministrativi di vertice",
                  "Titolari di incarichi dirigenziali (dirigenti non generali)",
                  "Dirigenti cessati",
                  "Posizioni organizzative",
                  "Dotazione organica",
                  "Personale non a tempo indeterminato",
                  "Tassi di assenza",
                  "Incarichi conferiti e autorizzati ai dipendenti (dirigenti e non dirigenti)",
                  "Contrattazione collettiva",
                  "Contrattazione integrativa",
                  "OIV"

                  )
            ),

            array("Bandi di Concorso",
                  array(
                  "Bandi di Concorso"
                  )
            ),

            array("Performance",
                  array(
                  "Sistema di misurazione e valutazione della Performance",
                  "Piano della Performance",
                  "Relazione sulla Performance",
                  "Documento dell'OIV di validazione della Relazione sulla Performance",
                  "Ammontare complessivo dei premi",
                  "Dati relativi ai premi"
                  )
            ),

            array("Enti controllati",
                  array(
                  "Enti pubblici vigilati",
                  "Società partecipate",
                  "Enti di diritto privato controllati",
                  "Rappresentazione grafica"
                  )
            ),

            array("Attività e procedimenti",
                  array(
                  "Tipologie di procedimento",
                  "Dichiarazioni sostitutive e acquisizione d'ufficio dei dati"
                  )
            ),

            array("Provvedimenti",
                  array(
                  "Provvedimenti organi indirizzo-politico",
                  "Provvedimenti dirigenti"
                  )
            ),

            array("Bandi di gara e contratti",
                  array(
                  "Atti delle amministrazioni aggiudicatrici e degli enti aggiudicatori distintamente per ogni procedura",
                  "Informazioni sulle singole procedure in formato tabellare"
                  )
            ),

            array("Sovvenzioni, contributi, sussidi, vantaggi economici",
                  array(
                  "Criteri e modalità",
                  "Atti di concessione"
                  )
            ),

            array("Bilanci",
                  array(
                  "Bilancio preventivo e consuntivo",
                  "Piano degli indicatori e risultati attesi di bilancio"
                  )
            ),

            array("Beni immobili e gestione patrimonio",
                  array(
                  "Patrimonio immobiliare",
                  "Canoni di locazione o affitto"
                  )
            ),

            array("Controlli e rilievi sull'amministrazione",
                  array(
                  "Organismi indipendenti di valutazione, nuclei di valutazione o altri organismi con funzioni analoghe",
                  "Organi di revisione amministrativa e contabile",
                  "Corte dei Conti"
                  )
            ),

            array("Servizi erogati",
                  array(
                  "Carta dei servizi e standard di qualità",
                  "Class action",
                  "Costi contabilizzati",
                  "Servizi in rete",
                  "Tempi medi di erogazione dei servizi",
                  "Liste di attesa"

                  )
            ),

            array("Pagamenti dell' amministrazione",
                  array(
                  "Dati sui pagamenti",
                  "Indicatore di tempestività dei pagamenti",
                  "IBAN e pagamenti informatici"
                  )
            ),

            array("Opere pubbliche",
                  array(
                  "Nuclei di valutazione e verifica degli investimenti pubblici",
                  "Atti di programmazione delle opere pubbliche",
                  "Tempi costi e indicatori di realizzazione delle opere pubbliche"
                  )
            ),

            array("Pianificazione e governo del territorio",
                  array(
                  "Pianificazione e governo del territorio"
                  )
            ),

            array("Informazioni ambientali",
                  array(
                  "Informazioni ambientali"
                  )
            ),

            array("Strutture sanitarie private accreditate",
                  array(
                  "Strutture sanitarie private accreditate"
                  )
            ),

            array("Interventi straordinari e di emergenza",
                  array(
                  "Interventi straordinari e di emergenza"
                  )
            ),

            array("Altri contenuti",
                  array(
                  "Prevenzione della Corruzione",
                  "Accesso civico",
                  "Accessibilità e Catalogo di dati, metadati e banche dati",
                  "Dati ulteriori"
                  )
            ),

            array("Dati non più soggetti a pubblicazione obbligatoria",
                  array(
                  "Attestazioni OIV o di struttura analoga",
                  "Burocrazia zero",
                  "Benessere organizzativo",
                  "Dati aggregati attività amministrativa",
                  "Monitoraggio tempi procedimentali",
                  "Controlli sulle imprese"
                  )
            )

      );
}
