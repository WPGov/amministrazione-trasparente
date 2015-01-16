<?php
function sfondo_at_trasparenza()
{
    global $current_screen;
    if ($current_screen->post_type == 'amm-trasparente' || $current_screen->post_type == 'avcp' || $current_screen->post_type == 'spesa' || $current_screen->post_type == 'incarico') {
		$css = '<style type="text/css">' . '#wpwrap { background: url(' . plugin_dir_url(__FILE__) . 'includes/bandieraItaliana.png) no-repeat; }' .'</style>';
		echo $css;
    }
}
add_action('admin_footer', 'sfondo_at_trasparenza');
?>