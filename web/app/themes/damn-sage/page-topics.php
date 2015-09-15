<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'page'); ?>

  <?php if ( is_active_sidebar( 'widget-tag-cloud-topics' ) ) : dynamic_sidebar( 'widget-tag-cloud-topics' ); endif; ?>

  <hr />

  <?php
    $args = array(
      'taxonomy' => array( 'post_tag', 'category', 'magazine' ),
      'number' => '120',
      'format' => 'list',
      'smallest' => '15',
      'largest' => '28'
    );

    wp_tag_cloud( $args );
  ?>
<?php endwhile; ?>