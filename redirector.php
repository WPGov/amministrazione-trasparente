<?php
//Crea Metabox
add_action( 'add_meta_boxes', 'add_aturls_metaboxes' );

function add_aturls_metaboxes() {
    add_meta_box('at_redirect_url', 'Reindirizza URL', 'at_redirect_url', 'amm-trasparente', 'side', 'high');
}

function at_redirect_url() {
    global $post;
    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="aturlmeta_noncename" id="aturlmeta_noncename" value="' .
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    // Get the aturl data if its already been entered
    $aturl = get_post_meta($post->ID, '_aturl', true);
    // Echo out the field
	echo '<p>Se vuoi che questo articolo reindirizzi automaticamente su un\'altra pagina, inserisci qui di seguito l\'url completo con http://';
    echo '<input type="text" name="_aturl" value="' . $aturl  . '" class="widefat" />';
}

// Save the Metabox Data

function at_save_aturl_meta($post_id, $post) {

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( isset($_POST['aturlmeta_noncename']) && !wp_verify_nonce( $_POST['aturlmeta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}
	
	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	if ( isset( $_POST['_aturl']) ) {
		$aturls_meta['_aturl'] = $_POST['_aturl'];

		foreach ($aturls_meta as $key => $value) { // Cycle through the $aturls_meta array!
			if( $post->post_type == 'revision' ) return; // Don't store custom data twice
			$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
			if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
				update_post_meta($post->ID, $key, $value);
			} else { // If the custom field doesn't have a value
				add_post_meta($post->ID, $key, $value);
			}
			if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
		}
	}

}

add_action('save_post', 'at_save_aturl_meta', 1, 2); // save the custom fields

// Redirect basato sul plugin "Redirect by Custom Field" di Michael 芳貴 Erlewine ============================================

if ( !defined('REDIRECT_BY_CUSTOM_FIELD_HTTP_STATUS') )
	define( 'REDIRECT_BY_CUSTOM_FIELD_HTTP_STATUS', 301 );

// This section will redirect URL's when the real permalink is hit directly.
// Note: I didn't use rewrite because I didn't want to have to keep track of all redirect mappings.
add_action('template_redirect', 'redirect_header', 1);
function redirect_header() {
	global $wp_query;
	if ( is_singular('amm-trasparente') &&
		 ($id = get_queried_object_id()) &&
		 ($link = get_redirect_url($id)) ) {
		wp_redirect($link, REDIRECT_BY_CUSTOM_FIELD_HTTP_STATUS);
		exit;
	}
}

// This section will replace every instance of the permalink with the redirect URL.
add_filter('page_link', 'redirect_by_custom_field', 10, 2);
add_filter('post_link', 'redirect_by_custom_field', 10, 2);
function redirect_by_custom_field($link, $postarg = null) {
	global $post;
	if ( is_admin() )
		return $link;
	if (is_object($postarg))
		$id = $postarg->ID;
	else if (is_int($postarg))
		$id = $postarg;
	else if (is_object($post))
		$id = $post->ID;
	else
		return $link;
	
	if ( $redirect = get_redirect_url($id) )
		return $redirect;
	
	return $link;
}

// id must be int
function get_redirect_url($id) {
	static $placeholders;

	if ( $redirect = get_post_meta( absint($id), '_aturl', true ) ) {

		if ( !isset($placeholders) ) {
			$placeholders = apply_filters( 'redirect_by_custom_field_placeholders', 
				array(
					'%home%' => get_home_url(),
					'%site%' => get_site_url(),
				)
			);
		}

		return str_replace( array_keys($placeholders),
			array_values($placeholders),
			is_array($redirect) ? $redirect[0] : $redirect );
	}
	return false;
}

add_filter('get_sample_permalink_html', 'at_redirect_display_modifier', 10, 4);
function at_redirect_display_modifier($return, $id, $new_title, $new_slug) {
	if ( $redirect = get_redirect_url($id) )
		$return = "<strong>" . __("Redirect:", 'redirect-by-custom-field') . "</strong> " . esc_html($redirect) . "<style>#titlediv {margin-bottom: 30px;}</style><br/>" . $return;
	return $return;
}
