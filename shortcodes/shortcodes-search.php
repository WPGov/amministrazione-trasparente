<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
  <div>
    <input type="text" name="s" placeholder="Cerca..." />

<?php
function get_terms_dropdown($taxonomies, $args){
    $myterms = get_terms($taxonomies, $args);
    $optionname = "tipologie";
    $output ="<select style='width: 100px;' name='".$optionname."'><option value=''>Tipologia</option>'";

    foreach($myterms as $term){
        $term_taxonomy=$term->YOURTAXONOMY; //CHANGE ME
        $term_slug=$term->slug;
        $term_name =$term->name;
        $link = $term_slug;
        $output .="<option name='".$link."' value='".$link."'>".$term_name."</option>";
    }
    $output .="</select>";
return $output;
}

$taxonomies = array('tipologie'); // CHANGE ME
$args = array('order'=>'ASC','hide_empty'=>true);
echo get_terms_dropdown($taxonomies, $args);

?>
    <input type="hidden" name="post_type" value="amm-trasparente" />
    <input type="submit" id="searchsubmit" value="Cerca" />
</div>
</form>
