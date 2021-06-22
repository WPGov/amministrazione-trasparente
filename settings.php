<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

  include(plugin_dir_path(__FILE__) . 'settings-banner.php');
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
            <input id="at_option_id" type="number" min="0" name="wpgov_at[page_id]" value="<?php echo esc_html($options['page_id']); ?>" size="55" />
            <br>
            <small>ID della pagina di WordPress in cui è stato inserito lo shortcode del plugin).<br>
            Lista shortcode: <a href="https://wpgov.it/docs/amministrazione-trasparente/">link</a></small>
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
<br>
<small>Consenti di associare dei tag ai post di Amministrazione Trasparente<br>Consigliato: <b>OFF</b></small>
</td>
</tr>
<tr valign="top">
<th scope="row">
<label for="at_show_love">Mostra credits</label>
</th>
<td>
<input id="at_show_love" name="wpgov_at[show_love]" type="checkbox" value="1"
  <?php checked( '1', isset( $options['show_love'] ) && $options['show_love'] ); ?> />
<br>
<small>Aiutaci a far conoscere il progetto e ottieni una via preferenziale per il supporto<br>Consigliato: <b>ON</b></small>
</td>
</tr>
<tr valign="top">
<th scope="row" colspan="2">
  <h2>Avanzate</h2>
  <tr valign="top">
  <th scope="row">
  <label for="at_enable_ucc">Abilita uffici e Centri di costo</label>
  </th>
  <td>
  <input id="at_enable_ucc" name="wpgov_at[enable_ucc]" type="checkbox" value="1"
     <?php checked( '1', isset( $options['enable_ucc'] ) && $options['enable_ucc'] ); ?> />
  <br>
  <small>Consenti di associare i contenuti a una nuova tassonomia basata su divsione aggiuntiva per uffici e centri di costo</small>
  </td>
  </tr>
  <tr valign="top">
  <th scope="row">
  <label for="at_map_cap">Mappa capacità</label>
  </th>
  <td>
  <input id="at_map_cap" name="wpgov_at[map_cap]" type="checkbox" value="1"
     <?php checked( '1', isset( $options['map_cap'] ) && $options['map_cap'] ); ?> />
  <br>
  <small>Mappa le meta capacità alle capacità primitive per personalizzare ruoli e permessi<br>[per utenti esperti] + [richiede componenti aggiuntivi]<br>Consigliato: <b>OFF</b></small>
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
  <tr valign="top" <?php if ( !isset( $options['debug'] ) || $options['debug'] ) { echo 'style="display:none;"'; } ?>>
    <th scope="row">
      <label for="debug">Modalità DEBUG</label>
    </th>
    <td>
      <input id="debug" name="wpgov_at[debug]" type="checkbox" value="1"
        <?php checked( '1', isset( $options['debug'] ) && $options['debug'] ); ?> />
      <br>
      <small>Utile in caso di test da parte del servizio di supporto. <b>Mantienila disattivata!</b></small>
    </td>
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
  echo '<p class="submit"><input type="submit" class="button-primary" value="'.__('Save Changes').'" /></p>';
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
    echo 'Numero sezioni supportate dal plugin: '.esc_html( $count );
    echo '<hr>';
    echo '<div style="width:45%;float:left;"><h4>Installate:</h4>';
    echo '<ul>';
    foreach ( $terms as $term ) {
      echo '<li>'.esc_html($term->name).'</li>';
    }
    echo '</ul>';
    echo '</div>';
    echo '<div style="width:45%;float:left;"><h4>Supportate:</h4>';
    echo '<ul>';
    foreach ( $merge as $merge_item ) {
      echo '<li>'.esc_html($merge_item).'</li>';
    }
    echo '</ul>';
    echo '</div>';
    echo '<hr>';
  }
?>
