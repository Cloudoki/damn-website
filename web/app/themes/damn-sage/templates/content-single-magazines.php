<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(''); ?>>
    <div class="entry-content">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="post-image">
            <?php if ( has_post_thumbnail()) { ?>
              <?php the_post_thumbnail('large'); ?>
            <?php } else { ?>
              <img src="<?= get_template_directory_uri(); ?>/dist/images/default-tall.png" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
            <?php } ?>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-9">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </article>
<?php endwhile; ?>

<?php /* load all articles related to this magazine */ ?>
<div class="related-articles row">
  <div class="col-xs-12">
    <h3 class="all-articles"> All Articles From This Issue</h3>
  </div>
  <?php /* Deliver all posts from this issue by related taxonomy */ ?>
  <?php
    //Get array of terms
    $terms = get_the_terms( $post->ID , 'magazine', 'string');
    //Pluck out the IDs to get an array of IDS
    $term_ids = wp_list_pluck($terms,'term_id');

    //Query posts with tax_query. Choose in 'IN' if want to query posts with any of the terms
    //Chose 'AND' if you want to query for posts with all terms
    $issue_query = new WP_Query( array(
      'post_type' => 'post',
      'tax_query' => array(
        array(
          'taxonomy' => 'magazine',
          'field' => 'id',
          'terms' => $term_ids,
          'operator'=> 'IN' //Or 'AND' or 'NOT IN'
        )),
      'posts_per_page' => -1,
      'ignore_sticky_posts' => 1,
      'orderby' => 'rand',
      'post__not_in'=>array($post->ID)
    ));

    //Loop through posts and display...
    if($issue_query->have_posts()) {
    while ($issue_query->have_posts() ) : $issue_query->the_post(); ?>
      <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
    <?php endwhile; wp_reset_query();
    }
  ?>
</div>

