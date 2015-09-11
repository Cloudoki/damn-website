<?php
  // This file assumes that you have included the nav walker from https://github.com/twittem/wp-bootstrap-navwalker
  // somewhere in your theme.
?>

<?php
$the_query = new WP_Query(array(
  'meta_query' => array(
    'post_type' => array ('post','calendar'),
    'posts_per_page' => 1,
    array(
      'key' => 'magazine_feature_home',
      'value' => '1',
      'compare' => '=='
    )
  )
));
?>

<?php /* If top wide home featured content is active */ ?>
<?php if (is_home()) { ?>

  <?php if( $the_query->have_posts() ): ?>
  <?php while( $the_query->have_posts() ) : $the_query->the_post();
    $thumbhome = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
    $url = $thumbhome['0'];
  ?>

    <?php /* if header text needs to be black */ if( get_field('magazine_feature_custom_color')) { ?>
    <div class="home-feature black-text">
    <?php } else { ?>
    <div class="home-feature">
    <?php } ?>
      <div class="single-news-item">
        <?php
          $imagefeature = wp_get_attachment_image_src(get_field('magazine_feature_feature_image'), 'full');
          if( $imagefeature ) { ?>
            <div class="post-image">
              <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                <img src="<?php echo $imagefeature[0]; ?>" alt="<?php echo get_the_title(get_field('magazine_feature_feature_image')) ?>" />
              </a>
          <?php } elseif ( has_post_thumbnail()) { ?>
            <div class="post-image" style="background-image:url(<?=$url?>);">
              <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                <img src="<?= get_template_directory_uri(); ?>/dist/images/home-feature-wide.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>"/>
              </a>
          <?php } else { ?>
            <div class="post-image">
              <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                <img src="<?= get_template_directory_uri(); ?>/dist/images/home-feature-wide.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>"/>
              </a>
          <?php } ?>
        </div>

        <header>
          <div class="container">
            <div class="category-link">
              <?php
                $sep = '';
                foreach ((get_the_category()) as $cat) {
                    echo $sep . '<a href="' . get_category_link($cat->term_id) . '"  class="' . $cat->slug . '" title="View all posts in '. esc_attr($cat->name) . '">' . $cat->cat_name . '</a>';
                    $sep = '';
                }
              ?>
            </div>
            <h1 class="entry-title">
              <?php if(get_field('custom_link')) { ?>
                <a href="<?php the_field('custom_link'); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
              <?php } else { ?>
                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
              <?php } ?>
            </h1>
            <?php if(get_field('sub-title')) { ?>
              <h3 class="subtitle">
                <?php the_field('sub-title'); ?>
              </h3>
            <?php } else { ?>
              <h3 class="subtitle">
                <?php the_excerpt(); ?>
              </h3>
            <?php } ?>
          </div>
        </header>
      </div><!-- end single-news-item -->
      <?php get_template_part('templates/snippet', 'header-nav'); ?>
    </div><!-- end home-feature-->
  <?php endwhile; ?>
  <?php endif; ?>

  <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
<?php } else { // end if is home ?>
  <div class="home-feature">
    <?php get_template_part('templates/snippet', 'header-nav'); ?>
  </div>
<?php } // end else ?>

