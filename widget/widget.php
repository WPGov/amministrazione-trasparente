<?php

//Il codice seguente genera un Widget utilizzabile nelle proprie sidebar
class atWidget extends WP_Widget {

    function atWidget() {
        parent::__construct( false, 'Amm. Trasparente' );
    }
    function widget( $args, $instance ) {
        extract($args);
	$current_page_URL = 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	$get_is_logic = get_option('at_logic_widget');
		if ($get_is_logic == '1') {
			if ( is_tax( 'tipologie' ) ) {
			} else if ( is_singular( 'amm-trasparente' ) ) {
			} else if (get_permalink(get_option('at_option_id')) == $current_page_URL) {
			} else {
			return false;
			}
		}
        echo $before_widget;
        echo $before_title.$instance['title'].$after_title;
 
        //DA QUI INIZIA IL WIDGET VERO E PROPRIO
		$get_is_collas = get_option('at_option_widget');
		if ($get_is_collas == '1') {
			include(plugin_dir_path(__FILE__) . 'widget-output-collapse.php');
		} else {
			include(plugin_dir_path(__FILE__) . 'widget-output-list.php');
        }
		//FINE WIDGET
 
        echo $after_widget;
    }
    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }
    function form( $instance ) {
		if (isset($_POST['submitted'])) {
			//Salva l'opzione voci espandibili
			if (isset($_POST['at_option_widget_n'])){
				update_option( 'at_option_widget', '1' );
			} else {
				update_option( 'at_option_widget', '0' );
			}
			//Salva l'opzione "Logic"
			if (isset($_POST['at_logic_widget_n'])){
				update_option( 'at_logic_widget', '1' );
			} else {
				update_option( 'at_logic_widget', '0' );
			}
		}
        $title = esc_attr($instance['title']); ?>
        <p><label for="<?php echo $this->get_field_id('title');?>">
        Titolo: <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title; ?>" />
        </label></p>
		<p><input type="checkbox" name="at_option_widget_n"
		<?php $get_show_widget = get_option('at_option_widget');
		if ($get_show_widget == '1') {
			echo ' checked=\'checked\'';
		}
		?>
		/> Voci espandibili</p>
		<p><input type="checkbox" name="at_logic_widget_n"
		<?php $get_logic_widget = get_option('at_logic_widget');
		if ($get_logic_widget == '1') {
			echo ' checked=\'checked\'';
		}
		?>
		/> Visualizza solo nella pagina indicata nelle impostazioni, pagina archivio e singola dei documenti</p>
		<input type="hidden" name="submitted" value="1" />
        <?php
    }
}
function at_register_widgets() {
    register_widget( 'atWidget' );
}
add_action( 'widgets_init', 'at_register_widgets' );
?>