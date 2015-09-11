<?php the_content(); ?>

<div class="bordered padding1em marginBottom">
  <a href="/category/damn-plus/" class="btn btn-primary btn-lg marginRight">VIEW ALL DAMn + ARTICLES</a> <a href="/join-damn-plus/damn-plus/profile/" class="btn btn-primary btn-lg">EDIT PROFILE</a>
</div>

<section class="widget damn-plus-login-form visible-xs-block bordered">
  <?php if ( is_active_sidebar( 'sidebar-damn-plus-widget' ) ) : dynamic_sidebar( 'sidebar-damn-plus-widget' ); endif; ?>
  <div class="clearthis"></div>
</section>

<div class="related-posts clearfix">
  <div class="text-center">
    <h3 class="marginAuto bottomBorderInline">DAMn + Articles </h3>
  </div>
  <div class="row">
    <?php
    $damn_query1 = new WP_Query( array( 'post_type' => array( 'post' ), 'showposts' => 15, 'offset' => 0, 'category_name' => "damn-plus"));
    while($damn_query1->have_posts()) : $damn_query1->the_post();
    ?>

      <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>

    <?php endwhile; ?>
    <?php wp_reset_postdata(); // reset the query ?>
  </div>
</div>

<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
