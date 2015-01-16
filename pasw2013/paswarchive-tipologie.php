<?php get_header(); ?>

    <?php get_sidebar(); ?> 

<div id="centrecontent" class="column">

<!-- breadcrumbs -->
<div id="path"><?php if(function_exists('bcn_display')) { bcn_display(); } ?></div>
<!-- fine breadcrumbs -->

	<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
	<h2 class="page-title"><?php echo $term->name; ?></h2>
	
	<?php
	if (is_tax( 'tipologie' )) {
		if (function_exists('at_archive_buttons')) {
			at_archive_buttons();
		}
	}
	?>

	<?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

          <div class="post type-post hentry">
            <h3 class="entry-title">
              <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
                <?php the_title(); ?>
              </a>
            </h3>

            <div class="entry-summary">
              <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->
          </div>

        <?php endwhile; ?>
      <?php endif; ?>

<div class="nav">
<div class="alignleft"><?php next_posts_link('&laquo; Comunicazioni precedenti') ?></div>
<div class="alignright"><?php previous_posts_link('Comunicazioni successive &raquo;') ?></div>
</div>

<div style="clear:both"></div>

</div>
<?php include(TEMPLATEPATH . '/rightsidebar.php'); ?>
<?php get_footer(); ?>