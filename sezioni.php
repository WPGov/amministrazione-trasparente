<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


function at_get_taxonomy_groups() {
      $return = array();
      foreach ( amministrazionetrasparente_getarray_default() as $arr ) {
            $return[] = $arr[0];
      }
      return $return;
}
function amministrazionetrasparente_getarray() {
      if ( function_exists('amministrazionetrasparente_getarray_default_custom') ) {
            return amministrazionetrasparente_getarray_default_custom();
      }
      
      $atReturn = array();

      foreach ( at_get_taxonomy_groups() as $groupName ) {
            
            $tipologieGruppo = at_getGroupConf( sanitize_title( $groupName ) );

            $innerArray = array();
            foreach ( $tipologieGruppo as $idTipologia ) {
                  
                  $term = get_term_by('id', $idTipologia, 'tipologie');
                  if ( !$term ) {
                        continue;
                  }
                  $innerArray[] = $term->name;
            }
            $atReturn[] = array(
                  $groupName,
                  $innerArray
            );
      }

      return $atReturn;
}

function amministrazionetrasparente_getarray_default() {

      if ( function_exists('amministrazionetrasparente_getarray_default_custom') ) {
            return amministrazionetrasparente_getarray_default_custom();
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

/**
 * Get the group name by term slug or term ID.
 * If given a term ID, it fetches the term and uses its slug.
 * Returns the group name (first element of each array in amministrazionetrasparente_getarray_default)
 * if the term slug matches any of the group's terms' slugs.
 */
function at_getGroupNameByTerm( $term ) {
    if ( is_numeric( $term ) ) {
        $term_obj = get_term( $term, 'tipologie' );
        if ( ! $term_obj || is_wp_error( $term_obj ) ) {
            return '';
        }
        $slug = $term_obj->slug;
    } else {
        $slug = $term;
    }

    // Build a map of term slugs to group names
    foreach ( amministrazionetrasparente_getarray_default() as $group ) {
        $group_name = $group[0];
        $terms = $group[1];
        foreach ( $terms as $term_name ) {
            $term_obj = get_term_by( 'name', $term_name, 'tipologie' );
            if ( $term_obj && ! is_wp_error( $term_obj ) && $term_obj->slug === $slug ) {
                return $group_name;
            }
        }
    }
    return '';
}

/**
 * Render the taxonomy filter dropdown used by the [at-search] shortcode.
 *
 * Lives here rather than in the shortcode template so that including that
 * template more than once per page cannot redeclare it.
 */
function at_get_terms_dropdown( $taxonomies, $args ) {
    $myterms = get_terms( $taxonomies, $args );
    $output  = "<select style='width: 100px;' name='tipologie'><option value=''>Filtra</option>";

    if ( is_wp_error( $myterms ) || ! is_array( $myterms ) ) {
        return $output . '</select>';
    }

    foreach ( $myterms as $term ) {
        $output .= "<option value='" . esc_attr( $term->slug ) . "'>" . esc_html( $term->name ) . "</option>";
    }
    $output .= "</select>";

    return $output;
}

/**
 * Build the section tree used by the "Revisione" screen and by the checkup panel.
 *
 * Walks the configured groups once instead of asking at_getGroupNameByTerm() for
 * every term, so the grouping follows the order the site actually publishes and
 * costs a single get_terms() call.
 *
 * @return array {
 *     @type array $groups     List of array{name, slug, term_ids} in configured order.
 *     @type array $terms      Map of term_id => WP_Term for every tipologia.
 *     @type array $children   Map of parent term_id => child term ids.
 *     @type array $orphans    Term ids not reachable from any group.
 *     @type array $duplicates Map of term_id => group slugs, for terms in several groups.
 *     @type array $stale      Configured ids whose term no longer exists.
 * }
 */
function at_get_revision_tree() {
    static $tree = null;

    if ( null !== $tree ) {
        return $tree;
    }

    $all_terms = get_terms( array( 'taxonomy' => 'tipologie', 'hide_empty' => false ) );
    $terms     = array();
    $children  = array();

    if ( ! is_wp_error( $all_terms ) ) {
        foreach ( $all_terms as $term ) {
            $terms[ $term->term_id ]     = $term;
            $children[ $term->parent ][] = $term->term_id;
        }
    }

    $groups     = array();
    $placed_in  = array();
    $stale      = array();

    foreach ( at_get_taxonomy_groups() as $group_name ) {
        $slug     = sanitize_title( $group_name );
        $term_ids = array();

        foreach ( (array) at_getGroupConf( $slug ) as $term_id ) {
            $term_id = (int) $term_id;

            if ( ! isset( $terms[ $term_id ] ) ) {
                $stale[] = $term_id;
                continue;
            }

            $term_ids[]            = $term_id;
            $placed_in[ $term_id ] = isset( $placed_in[ $term_id ] ) ? $placed_in[ $term_id ] : array();
            $placed_in[ $term_id ][] = $group_name;
        }

        $groups[] = array(
            'name'     => $group_name,
            'slug'     => $slug,
            'term_ids' => $term_ids,
        );
    }

    // A term is covered when it is configured in a group, or descends from one that is.
    $covered = array();
    $queue   = array_keys( $placed_in );

    while ( $queue ) {
        $term_id = array_shift( $queue );

        if ( isset( $covered[ $term_id ] ) ) {
            continue;
        }
        $covered[ $term_id ] = true;

        if ( isset( $children[ $term_id ] ) ) {
            foreach ( $children[ $term_id ] as $child_id ) {
                $queue[] = $child_id;
            }
        }
    }

    $duplicates = array();
    foreach ( $placed_in as $term_id => $group_names ) {
        if ( count( $group_names ) > 1 ) {
            $duplicates[ $term_id ] = $group_names;
        }
    }

    $tree = array(
        'groups'     => $groups,
        'terms'      => $terms,
        'children'   => $children,
        'orphans'    => array_values( array_diff( array_keys( $terms ), array_keys( $covered ) ) ),
        'duplicates' => $duplicates,
        'stale'      => array_values( array_unique( $stale ) ),
    );

    return $tree;
}
