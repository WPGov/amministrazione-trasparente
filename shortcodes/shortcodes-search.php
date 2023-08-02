<?php 
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }
?>

<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
        <input type="text" name="s" placeholder="Cerca..." />

        <?php
        function at_get_terms_dropdown($taxonomies, $args){
            $myterms = get_terms($taxonomies, $args);
            $output ="<select style='width: 100px;' name='tipologie'><option value=''>Filtra</option>'";

            foreach($myterms as $term){
                $term_slug=$term->slug;
                $term_name =$term->name;
                $link = $term_slug;
                $output .="<option name='".esc_attr( $link )."' value='".esc_attr($link)."'>".esc_html($term_name)."</option>";
            }
            $output .="</select>";
            return $output;
        }

        $taxonomies = array('tipologie');
        $args = array('order'=>'ASC','hide_empty'=>true);
        echo at_get_terms_dropdown($taxonomies, $args);

        ?>
        <input type="hidden" name="post_type" value="amm-trasparente" />
        <input type="submit" id="searchsubmit" value="Cerca" />
    </div>
</form>