<?php
  $orig_post = $post;
  global $post;
  $tags = wp_get_post_tags($post->ID);

  if ($tags) {
  $tag_ids = array();
  foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
  $args=array(
  'tag__in' => $tag_ids,
  'post_type' => array( 'post' ),
  'post__not_in' => array($post->ID),
  'showposts'=>3
  );

  $my_query = new wp_query( $args );
  echo '<div class="related-posts clearfix">';
  echo '<h3>RELATED POSTS</h3>';
  echo '<div class="row no-gutters related-post-list marginTop">';
  while( $my_query->have_posts() ) { $my_query->the_post(); ?>
    <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
  <?php }
  }
  echo '</div>';
  echo '</div>';
  $post = $orig_post;
  wp_reset_query();
  ?>
<div class="clearthis"></div>


