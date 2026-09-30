<?php
/*
Plugin Name: Amministrazione Trasparente
Plugin URI: https://wordpress.org/plugins/amministrazione-trasparente/
Description: Soluzione completa per la pubblicazione online dei documenti ai sensi del D.lgs. n. 33 del 14/03/2013
Version: 9.2.4
Author: Marco Milesi
Author Email: milesimarco@outlook.com
Author URI: https://www.marcomilesi.com
License: GPL Attribution-ShareAlike
Text Domain: amministrazione-trasparente
Domain Path: /languages
Requires at least: 5.0
Requires PHP: 7.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

define( 'AT_VERSION', '9.2.3' );
define( 'AT_PLUGIN_FILE', __FILE__ );
define( 'AT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'AT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Register the 'areesettori' taxonomy (offices / cost centres).
 */
function at_register_taxonomy_areesettori() {
  // Only register if the option is enabled
  if ( !at_option('enable_ucc') ) {
    return;
  }
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
    register_taxonomy( 'areesettori', array('incarico', 'spesa', 'avcp', 'amm-trasparente' ), $args );
  }
}
add_action( 'init', 'at_register_taxonomy_areesettori' );

/**
 * Register the 'amm-trasparente' post type and the 'tipologie' taxonomy.
 */
function at_register_post_type() {
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
}
add_action( 'init', 'at_register_post_type' );


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
    include(AT_PLUGIN_DIR . 'shortcodes/shortcodes-head.php');
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
  require(AT_PLUGIN_DIR . 'shortcodes/shortcodes-sezioni.php');
  $atshortcode = ob_get_clean();
  return $atshortcode;
} );

function at_search_shtc($atts)  {
    ob_start();
    include(AT_PLUGIN_DIR . 'shortcodes/shortcodes-search.php');
    $atshortcode = ob_get_clean();
    return $atshortcode;
} add_shortcode('at-search', 'at_search_shtc');

function at_archive_buttons() { //Questa funzione va chiamata con at_archive_buttons()
include(AT_PLUGIN_DIR . 'shortcodes/shortcodes-php-archive.php');
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
            $template = AT_PLUGIN_DIR . 'includes/pasw2013/paswarchive-tipologie.php';
        }

    } else if ( is_singular( 'amm-trasparente' ) ) {
        $theme_name = strtolower(wp_get_theme());
        if (get_template() == 'pasw2013' || $theme_name == 'pasw2013' || at_option('pasw_2013') == '1') { //Se è attivata la modalità "Forza template PASW"
            $template = AT_PLUGIN_DIR . 'includes/pasw2013/paswsingle-tipologie.php';
        }
    }
    return $template;
}
add_filter( 'template_include', 'at_force_template' );

// searchTaxonomyGT by Gabriel Tavares http://www.gtplugins.com
add_action( 'admin_enqueue_scripts', function() {
  wp_register_script('at_searchTaxonomyGT', AT_PLUGIN_URL . 'includes/js/searchTaxonomyGT.js', array('jquery'), AT_VERSION, true);
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

/**
 * Sanitize the main settings array.
 *
 * Every option is a flag except page_id, so anything unknown is dropped.
 */
function at_sanitize_options( $input ) {
    $output = array();

    if ( ! is_array( $input ) ) {
        return $output;
    }

    $output['page_id'] = isset( $input['page_id'] ) ? absint( $input['page_id'] ) : 0;

    $flags = array( 'opacity', 'enable_tag', 'show_love', 'enable_ucc', 'map_cap', 'pasw_2013', 'custom_terms' );
    foreach ( $flags as $flag ) {
        $output[ $flag ] = ( isset( $input[ $flag ] ) && $input[ $flag ] ) ? '1' : '';
    }

    return $output;
}

/**
 * Sanitize the group configuration.
 *
 * Shape is array<group-slug, term-id[]>: keys are slugs of the known groups and
 * values are ids of terms that still exist.
 */
function at_sanitize_group_conf( $input ) {
    $output = array();

    if ( ! is_array( $input ) ) {
        return $output;
    }

    $known_groups = array_map( 'sanitize_title', at_get_taxonomy_groups() );

    foreach ( $input as $group_slug => $term_ids ) {
        $group_slug = sanitize_title( $group_slug );
        if ( ! in_array( $group_slug, $known_groups, true ) || ! is_array( $term_ids ) ) {
            continue;
        }

        $clean = array();
        foreach ( $term_ids as $term_id ) {
            $term_id = absint( $term_id );
            if ( $term_id && ! in_array( $term_id, $clean, true ) && term_exists( $term_id, 'tipologie' ) ) {
                $clean[] = $term_id;
            }
        }
        $output[ $group_slug ] = $clean;
    }

    return $output;
}

add_action('admin_init', function() {
  register_setting( 'wpgov_at_options', 'wpgov_at', array( 'sanitize_callback' => 'at_sanitize_options' ) );
  register_setting( 'wpgov_at_option_groups', 'atGroupConf', array( 'sanitize_callback' => 'at_sanitize_group_conf' ) );
});

/**
 * Seed the sections and record the version, when installing or upgrading.
 *
 * Requires the 'tipologie' taxonomy to be registered already.
 */
function at_maybe_install_upgrade() {

  if ( ! version_compare( get_option( 'at_version_number' ), AT_VERSION, '<' ) ) {
    return false;
  }

  // Claim the version before doing the work, so two concurrent requests hitting
  // a fresh install do not both try to seed the terms.
  update_option( 'at_version_number', AT_VERSION );

  if ( ! at_option( 'custom_terms' ) ) {
    require_once( AT_PLUGIN_DIR . 'updater.php' );
    at_install_upgrade();
  }

  return true;
}

/**
 * On activation: register the types, seed the sections, rebuild the rules.
 *
 * 'init' has already run by the time this fires, so the post type and taxonomy
 * are registered here explicitly - both to let at_install_upgrade() insert its
 * terms and to put the rewrite rules into $wp_rewrite before flushing them.
 * Without the flush the section archives under /trasparenza/ return 404 until
 * someone re-saves the permalinks by hand.
 */
register_activation_hook( __FILE__, function() {
  at_register_taxonomy_areesettori();
  at_register_post_type();
  at_maybe_install_upgrade();
  flush_rewrite_rules();
} );

/**
 * Upgrades installed over an existing copy never run the activation hook, so
 * catch them on 'init' once the registrations at the default priority are done.
 */
add_action( 'init', function() {
  if ( at_maybe_install_upgrade() ) {
    // Soft flush: the plugin only adds database rules, never .htaccess ones, and
    // this may run on an anonymous front-end request that cannot write the file.
    flush_rewrite_rules( false );
  }
}, 99 );

/**
 * On deactivation, drop the cached rules so WordPress regenerates them without
 * ours on the next request.
 *
 * flush_rewrite_rules() would be wrong here: the plugin is still loaded for the
 * current request, so it would just save our own rules back again.
 */
register_deactivation_hook( __FILE__, function() {
  delete_option( 'rewrite_rules' );
} );

require_once(AT_PLUGIN_DIR . 'sezioni.php');
require_once(AT_PLUGIN_DIR . 'widget/widget.php');
require_once(AT_PLUGIN_DIR . 'redirector.php');

require_once(AT_PLUGIN_DIR . 'backend.php');
$AmministrazioneTrasparente_Backend = new AmministrazioneTrasparente_Backend();

add_action( 'admin_enqueue_scripts', function( $hook ) {
    // Only load on your plugin settings page
    if ( isset($_GET['page']) && $_GET['page'] === 'wpgov_at' ) {
        wp_enqueue_script( 'jquery-ui-sortable' );
    }
});

add_action( 'admin_menu', function() {

    // Dashboard submenu (edit_amm-trasparente)
    $post_type_object = get_post_type_object('amm-trasparente');
    $capability = $post_type_object && isset($post_type_object->cap->edit_posts)
        ? $post_type_object->cap->edit_posts
        : 'edit_posts';

    add_submenu_page(
        'edit.php?post_type=amm-trasparente',
        'Dashboard Amministrazione Trasparente',
        'Revisione',
        $capability,
        'at_tipologie_dashboard',
        function() {
            include(AT_PLUGIN_DIR . 'dashboard.php');
        }
    );

    // Impostazioni submenu (manage_options)
    add_submenu_page(
        'edit.php?post_type=amm-trasparente',
        'Impostazioni',
        'Impostazioni',
        'manage_options',
        'wpgov_at',
        function() {
            include(AT_PLUGIN_DIR . 'settings.php');
        }
    );    
} );

add_action( 'admin_enqueue_scripts', function( $hook ) {

  $at_screens = array(
    'amm-trasparente_page_wpgov_at',                // Impostazioni (la scheda Gestione sezioni mostra il checkup)
    'amm-trasparente_page_at_tipologie_dashboard',  // Revisione
  );

  if ( ! in_array( $hook, $at_screens, true ) ) {
      return;
  }

  wp_enqueue_style( 'at_revisione_css', AT_PLUGIN_URL . 'includes/css/admin-revisione.css', array( 'dashicons' ), AT_VERSION );
  wp_enqueue_script( 'at_revisione_js', AT_PLUGIN_URL . 'includes/js/admin-revisione.js', array(), AT_VERSION, true );

  if ( 'amm-trasparente_page_wpgov_at' !== $hook ) {
      return;
  }

  wp_enqueue_script( 'at_edit_js', AT_PLUGIN_URL . 'includes/js/jquery.multi-select.js', array(), AT_VERSION );
  wp_enqueue_style( 'at_edit_css', AT_PLUGIN_URL . 'includes/css/multi-select.css', array(), AT_VERSION, 'all');
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

add_action('pre_get_posts', function($query) {
    if (
        is_admin() &&
        $query->is_main_query() &&
        isset($_GET['post_type']) &&
        $_GET['post_type'] === 'amm-trasparente' &&
        isset($_GET['at_older_than']) &&
        is_numeric($_GET['at_older_than'])
    ) {
        $years = intval($_GET['at_older_than']);
        $date = date('Y-m-d', strtotime('-' . $years . ' years'));
        $query->set('date_query', [
            [
                'column' => 'post_date',
                'before' => $date,
            ]
        ]);
    }
});

// Breadcrumb filter for Design Comuni WordPress theme
add_filter( 'dci_get_breadcrumb_items', function( $items ) { 
    
    if ( is_tax( array( 'tipologie' ) ) ) {
        // Add home link as first item
        $items[] = "<a href='" . home_url() . "'>" . __('Home', 'design-comuni-italia') . "</a>";

        $term = get_queried_object();
        if ( $term && isset( $term->term_id ) ) {
            $group = function_exists('at_getGroupNameByTerm') ? at_getGroupNameByTerm( $term->term_id ) : '';

            if ( at_option( 'page_id' ) ) {
                $items[] = "<a href='" . esc_url( get_permalink( at_option( 'page_id' ) ) ) . "'>" . esc_html( get_the_title( at_option( 'page_id' ) ) ) . "</a>";
                if ( $group ) {
                    $items[] = '<a href="' . esc_url( get_permalink( at_option( 'page_id' ) ) . '#' . sanitize_title( $group ) ) . '">' . esc_html( $group ) . '</a>';
                }
            }
            $taxonomy = get_queried_object();
            $items[] = $taxonomy->name;
            return $items;
        }
    } else if ( get_post_type() == 'amm-trasparente' ) {
        // Add home link as first item
        $items[] = "<a href='" . home_url() . "'>" . __('Home', 'design-comuni-italia') . "</a>";
        
        $terms = get_the_terms( get_the_ID(), 'tipologie' );
        if ( $terms && !is_wp_error( $terms ) ) {
            $group = function_exists('at_getGroupNameByTerm') ? at_getGroupNameByTerm( $terms[0]->term_id ) : '';

            if ( at_option( 'page_id' ) ) {
                $items[] = "<a href='" . esc_url( get_permalink( at_option( 'page_id' ) ) ) . "'>" . esc_html( get_the_title( at_option( 'page_id' ) ) ) . "</a>";
                if ( $group ) {
                    $items[] = '<a href="' . esc_url( get_permalink( at_option( 'page_id' ) ) . '#' . sanitize_title( $group ) ) . '">' . esc_html( $group ) . '</a>';
                }
            }

            $items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_term_link( $terms[0] ) ), $terms[0]->name );
        }
        $items[] = get_the_title();
        return $items;
    }
    return $items;
}, 10, 2 );

// Filter to change the archive title for 'tipologie' taxonomy
add_filter( 'get_the_archive_title', function( $title ) {
    if ( is_tax( 'tipologie' ) ) {
        $term = get_queried_object();
        if ( $term && isset( $term->name ) ) {
            return $term->name;
        }
    }
    return $title;
});

// Show admin notice when filtering by date
add_action('admin_notices', function() {
    if (
        isset($_GET['post_type']) && $_GET['post_type'] === 'amm-trasparente' &&
        isset($_GET['at_older_than']) && is_numeric($_GET['at_older_than'])
    ) {
        $years = intval($_GET['at_older_than']);
        ?>
        <div class="notice notice-warning is-dismissible">
            <p>
                <strong>Filtro attivo:</strong>
                Stai visualizzando solo i documenti più vecchi di <?php echo esc_html($years); ?> anni.
                <a href="<?php echo esc_url( admin_url('edit.php?post_type=amm-trasparente') ); ?>" class="button" style="margin-left:8px;">Rimuovi filtro</a>
            </p>
        </div>
        <?php
    }
});

require_once(AT_PLUGIN_DIR . 'gutenberg.php');
