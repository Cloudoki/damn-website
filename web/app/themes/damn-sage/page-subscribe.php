<?php
/*
Template Name: Mailing List Page
*/
?>

<?php while (have_posts()) : the_post(); ?>
  <div class="mailing-list-form row">
    <div class="col-xs-12">
      <?php the_content(); ?>

      <?php if ( is_page('search') ) { ?>
        <div class="search-large">
         <?php get_search_form(); ?>
        </div>
      <?php } ?>
    </div>
  </div>

  <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>

<?php endwhile; ?>

