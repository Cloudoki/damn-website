<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<div class="row">
  <?php
  /* if Productivity */
  if (is_post_type_archive(array( 'product' ))) { ?>

    <?php if (have_posts()) : ?>
      <div data-columns="" id="columns">
        <?php while (have_posts()) : the_post(); ?>
          <?php get_template_part('templates/content-productivity', get_post_type() != 'product' ? get_post_type() : get_post_format()); ?>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

  <?php }
  /* If Magazine */
  elseif (is_post_type_archive(array( 'magazine' ))) { ?>

    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/content-magazine', get_post_type() != 'magazine' ? get_post_type() : get_post_format()); ?>
    <?php endwhile; ?>

  <?php }
  /* If Calendar */
  elseif (is_post_type_archive(array( 'calendar' ))) { ?>

    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/content-calendar', get_post_type() != 'calendar' ? get_post_type() : get_post_format()); ?>
    <?php endwhile; ?>

  <?php }
  /* Else if all others */
  else { ?>

    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/content-archive', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
    <?php endwhile; ?>

  <?php } ?>
</div>

<?php get_template_part('templates/page-navi'); ?>