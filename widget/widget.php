<?php

class atWidget extends WP_Widget {

    public function __construct() {
        parent::__construct( 'atwidget', 'Amministrazione Trasparente', array( 'description' => 'Lista delle sezioni relative alla trasparenza' ) );
    }

    function widget( $args, $instance ) {
        extract($args);

		if ( $instance['logic'] && !( is_tax( 'tipologie' ) || is_singular( 'amm-trasparente' ) || is_page( at_option('page_id') )) ) {
			return;
		}

        echo wp_kses_post( $before_widget );

        echo wp_kses_post( $before_title.$instance['title'].$after_title );

		if ( isset($instance['expandable']) && $instance['expandable'] != 0 ) {
			echo '<style type="text/css">
.row {vertical-align: top; height:auto !important; font-size: 0.9em;}
.list {display:none;}
.show {display:none;}
.hide:target + .show {display:inline;}
.hide:target {display:none;}
.hide:target ~ .list {display:inline;}
@media print {.hide, .show {display:none;}}
</style>';
            $atcontatore = 0;
            foreach ( at_get_taxonomy_groups() as $groupName ) {
                $tipologieGruppo = at_getGroupConf( sanitize_title( $groupName ) );

                echo '<div class="row">
                <a href="#hide'.++$atcontatore.'" class="hide" id="hide'.$atcontatore.'">[+]&nbsp;<b>'.esc_attr( $groupName ).'</b></a>
                <a href="#show'.$atcontatore.'" class="show" id="show'.$atcontatore.'">[-]&nbsp;<b>'.esc_attr( $groupName ).'</b></a>
                <div class="list">';
                $atreturn = '';
                foreach ( $tipologieGruppo as $idTipologia ) {
                    $term = get_term_by('id', $idTipologia, 'tipologie');
                    $atreturn .= '<li><a href="' . get_term_link( $term ) . '" title="' . esc_attr( $term->name ). '">' . esc_html( $term->name ). '</a></li>';
                }
                echo '<ul>'.$atreturn.'</ul>';

                echo '</div></div>';
            }
		} else {
            foreach ( at_get_taxonomy_groups() as $groupName ) {
                $tipologieGruppo = at_getGroupConf( sanitize_title( $groupName ) );

                echo '<ul><li><b>'.esc_attr( $groupName ).'</b>';
                $atreturn = '';
                foreach ( $tipologieGruppo as $idTipologia ) {
                    $term = get_term_by('id', $idTipologia, 'tipologie');
                    $atreturn .= '<li><a href="' . get_term_link( $term ) . '" title="' . esc_attr( $term->name ). '">' . esc_html( $term->name ). '</a></li>';
                }
                echo '<ul>'.$atreturn.'</ul>';
            
                echo '</li></ul>';
            }
        }
        echo wp_kses_post( $after_widget );
    }

    function update( $new_instance, $old_instance ) {
		delete_option( 'at_option_widget' );
		delete_option( 'at_logic_widget' );

		$instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['expandable'] = isset($new_instance['expandable']) && $new_instance['expandable'] ? 1 : 0;
        $instance['logic'] = isset($new_instance['logic']) && $new_instance['logic'] ? 1 : 0;

        return wp_parse_args( (array) $instance, self::get_defaults() );
    }

	 private static function get_defaults() {
        return array(
            'title' => 'Amministrazione Trasparente',
            'expandable' => 0,
            'logic' => 0
        );
    }

    function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, self::get_defaults() );

        $title = esc_attr($instance['title']); ?>
        <p><label for="<?php echo esc_attr( $this->get_field_id('title') );?>">
        Titolo: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') );?>" name="<?php echo esc_attr( $this->get_field_name('title') );?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </label></p>
		<p><input type="checkbox" id="<?php echo esc_attr( $this->get_field_id('expandable') );?>" name="<?php echo esc_attr( $this->get_field_name('expandable') );?>"
		<?php checked( $instance[ 'expandable' ] ); ?>/> Voci espandibili</p>
		<p><input type="checkbox" id="<?php echo $this->get_field_id('logic');?>" name="<?php echo esc_attr( $this->get_field_name('logic') );?>"
		<?php checked( $instance[ 'logic' ] ); ?>/> Visualizza solo nella pagina indicata nelle impostazioni, pagina archivio e singola dei documenti</p>
		<input type="hidden" name="submitted" value="1" />
        <?php
    }
}


function at_register_widgets() {
    register_widget( 'atWidget' );
}
add_action( 'widgets_init', 'at_register_widgets' );

?>
