<?php 
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }

    echo '<h3>Sommario</h3>';
    echo '<ul>';

    foreach ( at_get_taxonomy_groups() as $groupName ) {
        $tipologieGruppo = at_getGroupConf( sanitize_title( $groupName ) );

        $sez_l = sanitize_title( $groupName );
        echo '<li><a href="#'.$sez_l.'">'.$groupName.'</a></li>';

    }
    echo '</ul>';
?>