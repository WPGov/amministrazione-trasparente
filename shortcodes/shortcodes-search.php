<?php 
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }
?>

<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
        <input type="text" name="s" placeholder="Cerca..." />

        <?php
        $taxonomies = array('tipologie');
        $args = array('order'=>'ASC','hide_empty'=>true);
        echo at_get_terms_dropdown($taxonomies, $args);

        ?>
        <input type="hidden" name="post_type" value="amm-trasparente" />
        <input type="submit" id="searchsubmit" value="Cerca" />
    </div>
</form>