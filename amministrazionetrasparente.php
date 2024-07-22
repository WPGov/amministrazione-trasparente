<?php
/*
Plugin Name: Amministrazione Trasparente
Plugin URI: https://wordpress.org/plugins/amministrazione-trasparente/
Description: Soluzione completa per la pubblicazione online dei documenti ai sensi del D.lgs. n. 33 del 14/03/2013
Version: 8.1.3
Author: Marco Milesi
Author Email: milesimarco@outlook.com
Author URI: https://www.marcomilesi.com
License: GPL Attribution-ShareAlike
*/

add_action( 'init', function() {
	
  if ( !( function_exists('wpgov_register_taxonomy_areesettori') ) ){
    $labels = array(
      'name' => 'Uffici - Centri di costo',
      'singular_name' => 'Ufficio - Centro di costo',
      'search_items' => 'Cerca Ufficio - Centro di Costo',
      'popular_items' => 'Uffici - Centri di costo Più usati',
      'all_items' => 'Tutti i Centri di costo',
      'parent_item' => 'Parent Settore - Centro di costo',
      'parent_item_colon' => 'Parent Settore - Centro di costo:',
      'edit_item' => 'Modifica Settore - Centro di costo',
      'update_item' => 'Aggiorna Settore - Centro di costo',
      'add_new_item' => 'Aggiungi Nuovo Settore - Centro di costo',
      'new_item_name' => 'Nuovo Settore - Centro di costo',
      'separate_items_with_commas' => 'Separate settori - centri di costo with commas',
      'add_or_remove_items' => 'Add or remove settori - centri di costo',
      'choose_from_most_used' => 'Choose from the most used settori - centri di costo',
      'menu_name' => 'Uffici & Settori',
    );

    $args = array(
      'labels' => $labels,
      'public' => true,
      'show_in_nav_menus' => false,
      'show_ui' => true,
      'show_tagcloud' => false,
      'show_in_rest' => true,
      'show_admin_column' => true,
      'hierarchical' => true,
      'rewrite' => true,
      'query_var' => true
    );
    register_taxonomy( 'areesettori', array('incarico', 'spesa', 'avcp' ), $args );
  }
});

add_action('init', function(){
  if ( at_option( 'enable_ucc' ) ) {
    register_taxonomy_for_object_type( 'areesettori', 'amm-trasparente' );
  }
}, 200);

add_action( 'init', function() {
    $labels = array(
        'name' => 'Amministrazione Trasparente',
        'singular_name' => 'Amministrazione Trasparente',
        'add_new' => 'Nuova voce',
        'add_new_item' => 'Nuova Voce',
        'edit_item' => 'Modifica Documento',
        'new_item' => 'Nuovo Documento',
        'view_item' => 'Vedi Documento',
        'search_items' => 'Cerca Documenti',
        'not_found' => 'Nessun Documento trovato',
        'not_found_in_trash' => 'Nessun risultato',
        'parent_item_colon' => 'Parent Documento AT:',
        'menu_name' => 'Trasparenza',
    );

    $taxonomysupport = array();
    if ( at_option('enable_tag') ) { $taxonomysupport[] = 'post_tag'; }

    $get_at_ruoli_option_enable = at_option('map_cap');
    if ($get_at_ruoli_option_enable == '1') {
      $at_capability_type = 'documenti_trasparenza';
      $map_meta_cap_var = 'true';
      $at_capabilities_array = array(
        'publish_posts' => 'pubblicare_documento_trasparenza',
        'edit_posts' => 'modificare_propri_documento_trasparenza',
        'edit_others_posts' => 'modificare_altri_documento_trasparenza',
        'delete_posts' => 'eliminare_propri_documento_trasparenza',
        'delete_others_posts' => 'modificare_altri_documento_trasparenza',
        'read_private_posts' => 'read_private_professionisti',
        'edit_post' => 'modificare_documento_trasparenza',
        'delete_post' => 'eliminare_documento_trasparenza',
        'read_post' => 'leggere_documento_trasparenza',
      );
    } else {
      $at_capability_type = 'post';
      $map_meta_cap_var = 'false';
    }

    register_post_type(
      'amm-trasparente',
      array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'trasparenza',
        'taxonomies' => $taxonomysupport,
        'supports' => array( 'title', 'editor', 'excerpt', 'revisions', 'fe-attributes', 'author', 'page-attributes' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'menu_position' => 36,
        'menu_icon' => 'dashicons-networking',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('pages'=> true, 'with_front' => false),
        'capability_type' => $at_capability_type,
        'map_meta_cap' => $map_meta_cap_var
    )
  );

    $labels = array(
        'name' => 'Sezioni',
        'singular_name' => 'Sezione',
        'search_items' => 'Cerca sezione',
        'popular_items' => 'Tipologie più usate',
        'all_items' => 'Tutte le Tipologie',
        'parent_item' => 'Parent Tipologia',
        'parent_item_colon' => 'Parent Tipologia:',
        'edit_item' => 'Modifica Tipologia',
        'update_item' => 'Aggiorna Tipologia',
        'add_new_item' => 'Nuova Tipologia',
        'new_item_name' => 'Nuova Tipologia',
        'separate_items_with_commas' => 'Separate tipologie with commas',
        'add_or_remove_items' => 'Aggiungi o elimina una tipologia',
        'choose_from_most_used' => 'Scegli tra le tipologie più usate',
        'menu_name' => 'Tipologie',
    );

    register_taxonomy(
      'tipologie',
      array('amm-trasparente'),
      array(
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,
        'show_ui' => true,
        'show_tagcloud' => false,
        'show_admin_column' => true,
        'hierarchical' => true,
        'rewrite' => array('hierarchical' => true, 'slug' => 'trasparenza', 'with_front' => false),
        'capabilities' =>  array(
          'manage_terms' => 'manage_options',
          'edit_terms' => 'manage_options',
          'delete_terms' => 'manage_options',
          'assign_terms' => 'edit_posts'
        ),
        'query_var' => true
      )
    );
} );


function at_remove_tax_parent_dropdown() {
  $screen = get_current_screen();

  if ( 'tipologie' == $screen->taxonomy ) {
      if ( 'edit-tags' == $screen->base ) {
          $parent = "$('label[for=parent]').parent()";
      } elseif ( 'term' == $screen->base ) {
          $parent = "$('label[for=parent]').parent().parent()";
      }
  } else {
      return;
  }
  ?>

  <script type="text/javascript">
      jQuery(document).ready(function($) {     
          <?php echo $parent; ?>.remove();       
      });
  </script>

  <?php 
}
add_action( 'admin_head-edit-tags.php', 'at_remove_tax_parent_dropdown' );
add_action( 'admin_head-term.php', 'at_remove_tax_parent_dropdown' );
add_action( 'admin_head-post.php', 'at_remove_tax_parent_dropdown' );
add_action( 'admin_head-post-new.php', 'at_remove_tax_parent_dropdown' ); 


/* =========== SHORTCODES [at-head] & [at-desc] & [at-table] & [at-list] ============ */

add_shortcode('at-head', function($atts) {
    ob_start();
    include(plugin_dir_path(__FILE__) . 'shortcodes/shortcodes-head.php');
    $atshortcode = ob_get_clean();
    return $atshortcode;
});

add_shortcode('at-desc', function($atts) {
    ob_start();
    echo '<p>In questa pagina sono raccolte le informazioni che le Amministrazioni pubbliche sono tenute a pubblicare nel proprio sito internet nell\'ottica della trasparenza, buona amministrazione e di prevenzione dei fenomeni della corruzione (L.69/2009, L.213/2012, Dlgs33/2013, L.190/2012).</p>';
    $atshortcode = ob_get_clean();
    return $atshortcode;
});

add_shortcode('at-table', function($atts) {
    ob_start();
        echo do_shortcode( '[at-sezioni col="2"]' );
        $atshortcode = ob_get_clean();
    return $atshortcode;
});

add_shortcode('at-list', function($atts) {
    ob_start();
    echo do_shortcode( '[at-sezioni col="1"]' );
    $atshortcode = ob_get_clean();
    return $atshortcode;
});

add_shortcode('at-sezioni', function($atts) {
  ob_start();
  require_once(plugin_dir_path(__FILE__) . 'shortcodes/shortcodes-sezioni.php');
  $atshortcode = ob_get_clean();
  return $atshortcode;
} );

function at_search_shtc($atts)  {
    ob_start();
    include(plugin_dir_path(__FILE__) . 'shortcodes/shortcodes-search.php');
    $atshortcode = ob_get_clean();
    return $atshortcode;
} add_shortcode('at-search', 'at_search_shtc');

function at_archive_buttons() { //Questa funzione va chiamata con at_archive_buttons()
include(plugin_dir_path(__FILE__) . 'shortcodes/shortcodes-php-archive.php');
}
function at_archive_buttons_pasw2015() {
at_archive_buttons();
}

/* =========== VISUALIZZAZIONE ARCHIVIO SPECIALE ============ */

// force use of templates from plugin folder
function at_force_template( $template ) {

    if (get_template() == 'pasw2015') { return $template; }

    if( is_tax( 'tipologie' ) || is_tax( 'annirif' ) || is_tax( 'ditte' ) ) {
        $theme_name = strtolower(wp_get_theme());
        if (get_template() == 'pasw2013' || $theme_name == 'pasw2013' || at_option('pasw_2013') == '1') { //Se è attivata la modalità "Forza template PASW"
            $template = WP_PLUGIN_DIR .'/'. plugin_basename( dirname(__FILE__) ) .'/includes/pasw2013/paswarchive-tipologie.php';
        }

    } else if ( is_singular( 'amm-trasparente' ) ) {
        $theme_name = strtolower(wp_get_theme());
        if (get_template() == 'pasw2013' || $theme_name == 'pasw2013' || at_option('pasw_2013') == '1') { //Se è attivata la modalità "Forza template PASW"
            $template = WP_PLUGIN_DIR .'/'. plugin_basename( dirname(__FILE__) ) .'/includes/pasw2013/paswsingle-tipologie.php';
        }
    }
    return $template;
}
add_filter( 'template_include', 'at_force_template' );

// searchTaxonomyGT by Gabriel Tavares http://www.gtplugins.com
add_action( 'admin_enqueue_scripts', function() {
  wp_register_script('at_searchTaxonomyGT', plugins_url('/includes/js/searchTaxonomyGT.js', __FILE__));
	wp_enqueue_script('at_searchTaxonomyGT');
} );

add_action( 'restrict_manage_posts', function() {
  global $typenow;
  $taxonomy = 'tipologie';
	if ($typenow == 'amm-trasparente') {
        $filters = array($taxonomy);
        foreach ($filters as $tax_slug) {
            $tax_obj = get_taxonomy($tax_slug);
            $tax_name = $tax_obj->labels->name;
            $terms = get_terms($tax_slug);
            echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
            echo "<option value=''>Tutte le sezioni</option>";
            foreach ($terms as $term) { 
                $label = (isset( $_GET[$tax_slug] )) ? sanitize_text_field( $_GET[$tax_slug] ) : '';
                echo '<option value='. $term->slug, $label == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
            }
            echo "</select>";
        }
    }
} );

add_action('admin_init', function() {
  register_setting( 'wpgov_at_options', 'wpgov_at' );
  register_setting( 'wpgov_at_option_groups', 'atGroupConf' );
  
  $arrayatpv = get_plugin_data ( __FILE__ );
  $nuova_versione = $arrayatpv['Version'];

  if ( version_compare( get_option('at_version_number'), $nuova_versione, '<')) {
    if ( !at_option( 'custom_terms' ) ) {
      require(plugin_dir_path(__FILE__) . 'updater.php');
      at_install_upgrade();
    }
    update_option( 'at_version_number', $nuova_versione );
  }
});

require_once(plugin_dir_path(__FILE__) . 'sezioni.php');
require_once(plugin_dir_path(__FILE__) . 'widget/widget.php');
require_once(plugin_dir_path(__FILE__) . 'redirector.php');

require_once(plugin_dir_path(__FILE__) . 'backend.php');
$AmministrazioneTrasparente_Backend = new AmministrazioneTrasparente_Backend();

add_action( 'admin_menu', function() {
  add_submenu_page( 'edit.php?post_type=amm-trasparente', 'Impostazioni', 'Impostazioni', 'manage_options', 'wpgov_at', function() {
    include(plugin_dir_path(__FILE__) . 'settings.php');
  } );
} );

add_action( 'admin_enqueue_scripts', function( $hook ) {
  
  if ( 'amm-trasparente_page_wpgov_at' != $hook ) {
      return;
  }

  wp_enqueue_script( 'at_edit_js', plugin_dir_url( __FILE__ ) . '/includes/js/jquery.multi-select.js', array(), '1.0' );
  wp_enqueue_style( 'at_edit_css', plugin_dir_url( __FILE__ ) . '/includes/css/multi-select.css', array(), '1.0', false);
} );

function at_option($name) {
	$options = get_option('wpgov_at');
	if (isset($options[$name])) {
		return $options[$name];
	}
	return false;
}

function at_getGroupConf ( $name = null ) {
  if ( !$name ) {
    return get_option('atGroupConf');
  } else {
    $options = get_option('atGroupConf');
    if ( isset( $options[ $name ] )) {
      return $options[ $name ];
    }
  }
	return array();
}

?>
