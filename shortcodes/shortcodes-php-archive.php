<?php 
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }
?>

<div class="riassunto" style="padding:20px;font-size:0.8em;">

<span style="float:right;">
<a href="<?php echo get_permalink( at_option('page_id') ); ?>" title="Torna al sommario">Torna all'indice</a>
</span>
<details>
    <summary>Riferimenti Normativi</summary>
    <p><br><?php echo @term_description( $term->id, 'tipologie' ); ?></p>
</details>


</div>
