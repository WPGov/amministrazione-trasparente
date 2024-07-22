<?php get_header(); ?>

<?php get_sidebar(); ?>
<div id="centrecontent" class="column">

<div class="nascosto">
<strong> Navigazione veloce </strong>
<ul>
<li><a href="#wrapper">torna in cima</a></li>
<li><a href="#leftsidebar">vai alla navigazione principale</a></li>
<li><a href="#rightsidebar">vai alla navigazione contestuale</a></li>
</ul>
</div>


    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="post" id="post-<?php the_ID(); ?>">

            <h2 class="posttitle"><?php the_title(); ?></h2>

            <?php if ( function_exists('previous_cat_post') ) { ?>
            <div id="postnavigation">
            <ul>
            <li class="navheader">Next Entries</li>
            <?php next_cat_post($beforeGroup='', $afterGroup='', $beforeEach='<li>', $afterEach='</li>', $showtitle=true, $textForEach='(%) '); ?>
            <li class="navheader">Previous Entries</li>
            <?php previous_cat_post($beforeGroup='', $afterGroup='', $beforeEach='<li>', $afterEach='</li>', $showtitle=true, $textForEach='(%) '); ?>
            </ul>
            </div>
            <?php } ?>
            <p class="postmeta">
            <?php if (!is_page()) { ?>
            <span class="postauthor"><?php _e('Pubblicato il '); ?><?php the_time('j M y') ?> <?php _e('alle'); ?> <?php the_time() ?></span>
            &bull; <a href="<?php echo get_permalink( at_option('page_id')); ?>" title="Torna all'Indice">Torna all'Indice</a><?php edit_post_link(__('Edit'), ' &bull; ', ''); ?>            <br/>            <?php the_taxonomies(', '); ?>
            <?php } ?>
            </p>

<div class="postentry">
<?php if(!empty($post->post_excerpt)) {
//This post have an excerpt, let's display it
echo '<div class="riassunto">';
the_excerpt();
echo '</div>';
} else {
// This post have no excerpt
} ?>
<?php the_content(__('Leggi il resto &raquo;')); ?>
<?php wp_link_pages(); ?>

</div>

        </div>

    <?php endwhile; else : ?>

        <h2><?php _e('Non trovato'); ?></h2>

        <p><?php _e('Spiacenti, ma la pagina richiesta non � stata trovata.'); ?></p>

    <?php endif; ?>

</div>


<?php include(TEMPLATEPATH . '/rightsidebar.php'); ?>

<?php get_footer(); ?>
