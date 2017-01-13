<?php

foreach (amministrazionetrasparente_getarray() as $inner) {
    foreach ($inner[1] as $value) {
        if (!term_exists( $value , 'tipologie')) {
            wp_insert_term( $value , 'tipologie');
        }
    }
}
require_once(plugin_dir_path(__FILE__) . 'taxonomydescgenerator.php');

?>
