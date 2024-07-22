<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php
function at_setting_tabs( $id ) {

  $id0 = $id1 = $id2 = '';
  switch ( $id ) {
    case 0:
      $id0 = ' nav-tab-active';
      break;
    case 1:
      $id1 = ' nav-tab-active';
      break;
    case 2:
      $id2 = ' nav-tab-active';
      break;
    }
  $r = '<h2 class="nav-tab-wrapper wp-clearfix">
    <a href="edit.php?post_type=amm-trasparente&page=wpgov_at" class="nav-tab'.$id0.'">Generale</a>
    <a href="edit.php?post_type=amm-trasparente&page=wpgov_at&at_action=config" class="nav-tab'.$id1.'">Gestione sezioni</a>
    <a href="edit.php?post_type=amm-trasparente&page=wpgov_at&at_action=debug" class="nav-tab'.$id2.'">Debug</a>
  </h2>';
  echo $r;
}
?>

<div class="wrap">
  <h1>Amministrazione Trasparente</h1>
  <div id="welcome-panel" class="welcome-panel">
    <div class="welcome-panel-column-container">
      <ul>
        <li><a href="https://github.com/WPGov/amministrazione-trasparente/wiki" class="welcome-icon welcome-write-blog">Documentazione del plugin</a></li>
        <li><a href="https://github.com/WPGov/amministrazione-trasparente" class="welcome-icon dashicons-editor-code">Migliora il codice su GitHub</a></li>
        <li><div class="welcome-icon dashicons-admin-users">Creato da <a href="https://www.marcomilesi.com/">Marco Milesi</a></div></li>
        <li><div class="welcome-icon dashicons-groups">Con il contributo di <a href="http://www.porteapertesulweb.it/">Porte Aperte sul Web</a></div></li>
      </ul>
    </div>
  </div>

  <?php

  if ( isset($_GET['at_action']) && $_GET['at_action'] == 'debug'  ) {

    at_setting_tabs( 2 );

    echo '<pre>';
    $a = get_option('wpgov_at');
    if ( is_array( $a ) ) {
      $e = filter_var_array( get_option('wpgov_at'), FILTER_SANITIZE_SPECIAL_CHARS);
      print_r( $e );
    } else {
      echo 'Nessuna impostazione presente';
    }
    echo '</pre>';

    echo '<pre>';
    $a = get_option('atGroupConf');
    if ( is_array( $a ) ) {
      $e = filter_var_array( $a, FILTER_SANITIZE_SPECIAL_CHARS);
      print_r( $e );
    } else {
      echo 'Nessuna configurazione presente';
    }
    echo '</pre>';  

  } else if ( isset($_GET['at_action']) ) {

    at_setting_tabs( 1 );

    $selected_sections = array();
    $selected_sections_unique = array();

    $atTerms = get_terms(
      array( 
        'taxonomy' => 'tipologie',
        'parent'   => 0,
        'hide_empty' => false,
      )
    );

    if( is_array( at_getGroupConf() ) ) {
      foreach ( at_getGroupConf() as $key => $arrayTipologie ) {
        $selected_sections = array_merge( $selected_sections, $arrayTipologie );
        $selected_sections_unique = array_unique( array_merge( $selected_sections, $arrayTipologie ) );
      }
    }

    $diff = array_diff_assoc($selected_sections, array_unique($selected_sections) );
    $alert_duplicates = 'Elenco duplicati:\n';
    if ( is_array( $diff ) && !empty( $diff ) ) {
      foreach ( $diff as $x ) {
        $duplicate_term = get_term_by('id', $x, 'tipologie');
        if ( $duplicate_term && $duplicate_term->name ) {
          $alert_duplicates .= '- '.esc_js($duplicate_term->name). '\n';
        }
      }
    }

    $green_svg = '<span style="color:green"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg></span>';
    $red_svg = '<span style="color:red;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16"><path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg></span>';

    $warning_count = '';
    $alert_count = 'Elenco tipologie non associate:\n';
    if ( wp_count_terms( 'tipologie' ) != count( array_count_values( $selected_sections ) ) ) {
      foreach( $atTerms as $term ) {
        if ( !in_array( $term->term_id, $selected_sections_unique ) ) {
          $alert_count .= '- '.esc_js($term->name) . '\n';
          if ( !empty( $selected_sections_unique) ) {
            $max = max( array_keys( $selected_sections_unique ) );
            $selected_sections_unique[ ++$max ] = $term->term_id;
          }
          
        }
      }
      $warning_count = ' '.(wp_count_terms( 'tipologie' ) - count( array_count_values( $selected_sections ) ) ).' tipologie non sono associate a un gruppo - <a href="#" onclick="alert(\''.$alert_count.'\');">Clicca qui per i dettagli</a></b>';
    } else {
      $warning_count = $green_svg;
    }

    $warning_duplicates = '';
    if ( ( count( $selected_sections ) - count( array_count_values( $selected_sections ) ) ) != 0 ) {
      $warning_duplicates = $red_svg.' Verificare se intenzionale - <a href="#" onclick="alert(\''.$alert_duplicates.'\');">Clicca qui per i dettagli</a>';
    } else {
      $warning_duplicates = $green_svg;
    }
    echo '<h3>Tipologie</h3>';
    
    echo '<table class="widefat fixed" cellspacing="0">
    <thead>
    <tr>
            <th id="columnname" class="manage-column column-columnname" scope="col">Controllo</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">Esito</th>
    </tr>
    </thead>
    <tbody>
        <tr class="alternate">
            <td class="column-columnname">'.wp_count_terms( 'tipologie' ).'</b> tipologie gestite</td>
            <td class="column-columnname">'.(wp_count_terms( 'tipologie' ) > 0 ? $green_svg : $red_svg ).'</td>
        </tr>
        <tr>
            <td class="column-columnname">'. count( array_count_values( $selected_sections ) ) . '</b> tipologie correttamente associate nei gruppi</td>
            <td class="column-columnname">'.$warning_count.'</td>
        </tr>
        <tr class="alternate">
            <td class="column-columnname">'.( count( $selected_sections ) - count( array_count_values( $selected_sections ) ) ) . '</b> tipologie sono associate a più gruppi</td>
            <td class="column-columnname">'.$warning_duplicates.'</td>
        </tr>
    </tbody>
  </table>
  <br><br>
  <p>Puoi aggiungere o modificare le singole sezioni di Amministrazione trasparente:</p>
  <a href="edit-tags.php?taxonomy=tipologie&post_type=amm-trasparente" class="button-secondary">Aggiungi o modifica tipologie</a>
  <hr><h3>Gruppi</h3>';
    echo '<form method="post" action="options.php">';
    settings_fields( 'wpgov_at_option_groups' );

    $options = get_option( 'atGroupConf' );
    
  
    foreach ( at_get_taxonomy_groups() as $group ) {
      echo '<details style="margin:10px;"><summary style="margin: 10px;"><b>'.$group.'</b>';
      $sezione = at_getGroupConf( sanitize_title( $group ) );
      echo ' ('.count($sezione).')';
      echo '</summary>';
      echo '<div>';
      $dropdownOptions = array();
      foreach( $atTerms as $term ) {
        $atSelected = ( in_array( $term->term_id, $sezione) ? 'selected' : '' );

        $arrayIndex = array_search( $term->term_id, $selected_sections_unique );
        $dropdownOptions[ $arrayIndex ] = '<option value="'.$term->term_id.'" '.$atSelected.'>'.$term->name.'</option>';
      }
      ksort( $dropdownOptions ); // Order by key to keep default AT order
      $dropdownOptionsEcho = '';
      foreach( $dropdownOptions as $x ) {
        $dropdownOptionsEcho .= $x;
      }
      echo '<select id="'.sanitize_title( $group ).'" name="atGroupConf['.sanitize_title( $group ).'][]" multiple="multiple">';
      echo $dropdownOptionsEcho;
      echo '</select>';

      echo '<script>jQuery("#'.sanitize_title( $group ).'").multiSelect( { keepOrder: true, selectableHeader: "Disponibili:", selectionHeader: "Selezionate:" } );</script>';
      echo '</div>';
      echo '</details>';
    }

    submit_button( 'Salva configurazione' );
    echo '</form>';

  } else {
    at_setting_tabs( 0 );

    echo '<form method="post" action="options.php">';

    settings_fields( 'wpgov_at_options');
    $options = get_option( 'wpgov_at');
  ?>
  <table class="form-table">
    <tr valign="top">
            <th scope="row">
              <label for="at_option_id">ID Pagina</label>
            </th>
            <td>
              <input id="at_option_id" type="number" min="0" name="wpgov_at[page_id]" value="<?php echo esc_html( isset( $options['page_id'] ) ? $options['page_id'] : '' ); ?>" size="55" />
              <br>
              <small>ID della pagina di WordPress in cui è stato inserito lo shortcode del plugin).<br>
              Lista shortcode: <a href="https://github.com/WPGov/amministrazione-trasparente/wiki/Shortcode">link</a></small>
            </td>
          </tr>

          <tr valign="top">
    <th scope="row">
      <label for="at_option_opacity">Sfuma sezioni vuote</label>
    </th>
    <td>
      <input id="at_option_opacity" name="wpgov_at[opacity]" type="checkbox" value="1"
        <?php checked( '1', isset($options['opacity']) && $options['opacity'] ); ?> />
      <br>
      <small>Aumenta la trasparenza visiva delle sezioni senza alcun contenuto<br>Consigliato: <b>ON</b></small>
    </td>
  </tr>
  <tr valign="top">
    <th scope="row">
      <label for="at_enable_tag">Abilita tag</label>
    </th>
    <td>
      <input id="at_enable_tag" name="wpgov_at[enable_tag]" type="checkbox" value="1"
        <?php checked( '1', isset( $options['enable_tag'] ) && $options['enable_tag'] ); ?> />
      <br><small>Consenti di associare dei tag ai post di Amministrazione Trasparente<br>Consigliato: <b>OFF</b></small>
    </td>
  </tr>
  <tr valign="top">
    <th scope="row">
    <label for="at_show_love">Mostra credits</label>
    </th>
    <td>
      <input id="at_show_love" name="wpgov_at[show_love]" type="checkbox" value="1"
        <?php checked( '1', isset( $options['show_love'] ) && $options['show_love'] ); ?> />
      <br><small>Aiutaci a far conoscere il progetto e ottieni una via preferenziale per il supporto<br>Consigliato: <b>ON</b></small>
    </td>
  </tr>
  <tr valign="top">
  <th scope="row" colspan="2">
    <h2>Avanzate</h2>
    <?php if ( isset( $options['enable_ucc'] ) ) { ?>
      <tr valign="top">
        <th scope="row">
          <label for="at_enable_ucc">Abilita uffici e Centri di costo</label>
        </th>
        <td>
          <input id="at_enable_ucc" name="wpgov_at[enable_ucc]" type="checkbox" value="1"
            <?php checked( '1', isset( $options['enable_ucc'] ) && $options['enable_ucc'] ); ?> />
          <br><small>Consenti di associare i contenuti a una nuova tassonomia basata su divsione aggiuntiva per uffici e centri di costo</small>
        </td>
      </tr>
    <?php } ?>
    <tr valign="top">
    <th scope="row">
    <label for="at_map_cap">Mappa capacità</label>
    </th>
    <td>
    <input id="at_map_cap" name="wpgov_at[map_cap]" type="checkbox" value="1"
      <?php checked( '1', isset( $options['map_cap'] ) && $options['map_cap'] ); ?> />
    <br>
    <small>Mappa le meta capacità per personalizzare ruoli e permessi<br>[per utenti esperti] + [richiede componenti aggiuntivi]<br>Consigliato: <b>OFF</b></small>
    </td>
    </tr>
  </th>
  </tr>
  <tr valign="top">
  <th scope="row">
  <label for="at_pasw_2013">Forza PASW2013</label>
  </th>
  <td>
  <input id="at_pasw_2013" name="wpgov_at[pasw_2013]" type="checkbox" value="1"
    <?php checked( '1', isset( $options['pasw_2013'] ) && $options['pasw_2013'] ); ?> />
  <br>
  <small>Spunta casella se vuoi attivare ottimizzazioni per il template PASW2013<br>[abilitare solo se il tema attivo è una versione precedente al 2013 o se è stato cambiato il nome della cartella di "pasw2013"]</small>
  </td>
  </tr>
  </th>
  </tr>
    <tr valign="top" <?php if ( !isset( $options['custom_terms'] ) || !$options['custom_terms'] ) { echo 'style="display:none;"'; } ?>>
      <th scope="row">
        <label for="custom_terms">Custom Terms</label>
      </th>
      <td>
        <input id="custom_terms" name="wpgov_at[custom_terms]" type="checkbox" value="1"
          <?php checked( '1', isset( $options['custom_terms'] ) && $options['custom_terms'] ); ?> />
        <br>
        <small>Utile in caso di test da parte del servizio di supporto. <b>Mantienila disattivata!</b></small>
      </td>
    </tr>
  </tr>
    </table>

<?php
    
  submit_button( 'Salva configurazione' );
  echo '</form>';
  if ( at_option('debug') ) {
    echo '<hr><h3>DEBUG</h3>';
    $terms = get_terms( array( 'taxonomy' => 'tipologie', 'hide_empty' => false ) );
    echo 'Numero sezioni installate: '.count($terms).'<br>';
    $count = 0;
    $merge = array();
    foreach ( amministrazionetrasparente_getarray() as $inner ) {
      $count+= count($inner[1]);
      $merge = array_merge( $merge, $inner[1] );
    }
    sort($merge);
    echo 'Numero sezioni supportate dal plugin: '.sanitize_text_field( $count );
    echo '<hr>';
    echo '<div style="width:45%;float:left;"><h4>Installate:</h4>';
    echo '<ul>';
    foreach ( $terms as $term ) {
      echo '<li>'.sanitize_text_field($term->name).'</li>';
    }
    echo '</ul>';
    echo '</div>';
    echo '<div style="width:45%;float:left;"><h4>Supportate:</h4>';
    echo '<ul>';
    foreach ( $merge as $merge_item ) {
      echo '<li>'.sanitize_text_field($merge_item).'</li>';
    }
    echo '</ul>';
    echo '</div>';
    echo '<hr>';
  }
}
?>
</div>