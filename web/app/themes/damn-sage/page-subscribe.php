<?php
/*
Template Name: Subscribe
*/
?>

<?php while (have_posts()) : the_post(); ?>

  <?php if ( has_post_thumbnail()) { ?>
    <div class="page-featured-image color-box">
      <?php the_post_thumbnail('large'); ?>
    </div>
  <?php } ?>

  <div class="row subscribe-page">
    <div class="col-xs-12 col-sm-3 col-md-4 magazine-cover">
      <?php get_template_part('templates/snippet-latest-cover'); ?>
    </div>

    <div class="col-xs-12 col-sm-9 col-md-8 mailing-list-form">
      <?php the_content(); ?>
    </div>
  </div>

<?php endwhile; ?>

