<?php
//FILTRI
add_action( 'restrict_manage_posts', 'trasparenza_restrict_manage_posts' );
function trasparenza_restrict_manage_posts() {
    global $typenow;
    $taxonomy = 'tipologie'; // Change this
	if ($typenow == 'amm-trasparente') {
        $filters = array($taxonomy);
        foreach ($filters as $tax_slug) {
            $tax_obj = get_taxonomy($tax_slug);
            $tax_name = $tax_obj->labels->name;
            $terms = get_terms($tax_slug);
            echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
            echo "<option value=''>Tutte le sezioni</option>";
            foreach ($terms as $term) { 
                $label = (isset($_GET[$tax_slug])) ? $_GET[$tax_slug] : ''; // Fix
                echo '<option value='. $term->slug, $label == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
            }
            echo "</select>";
        }
    }
}
?>