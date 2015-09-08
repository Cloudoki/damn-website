<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(''); ?>>
    <header>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>

    <?php /* REUSED snippet to display standard post footer */ ?>
    <?php get_template_part('templates/snippet', 'post-footer'); ?>
  </article>
<?php endwhile; ?>

