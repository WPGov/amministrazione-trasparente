<?php 
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }

    echo '<h3>Sommario</h3>';
    echo '<ul>';

    foreach ( at_get_taxonomy_groups() as $groupName ) {
        $sez_l = sanitize_title( $groupName );
        echo '<li><a href="#'.esc_attr( $sez_l ).'">'.esc_html( $groupName ).'</a></li>';
    }
    echo '</ul>';
?>