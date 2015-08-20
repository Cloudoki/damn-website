<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<div class="row">
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
  <?php endwhile; ?>
</div>

<div class="row">
  <div class="col-12 col-xs-6 col-sm-4">
    <h3>Agenda</h3>
  </div>

  <div class="col-12 col-xs-6 col-sm-4">
    <h3>Social Media</h3>
    <?php if ( is_active_sidebar( 'sidebar-homepage-socials' ) ) : dynamic_sidebar( 'sidebar-homepage-socials' ); endif; ?>
  </div>

  <div class="col-12 col-xs-6 col-sm-4">
    <h3>Join DAMn +</h3>
  </div>
</div>
