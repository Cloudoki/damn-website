<?php
  // This file assumes that you have included the nav walker from https://github.com/twittem/wp-bootstrap-navwalker
  // somewhere in your theme.
?>

<div class="home-feature">

  <?php /* If top wide home featured content is active */ ?>
  <?php if (is_home()) { ?>

    <?php
    $the_query = new WP_Query(array(
      'meta_query' => array(
        'post_type' => array ('post','calendar'),
        array(
          'key' => 'magazine_feature_home',
          'value' => '1',
          'compare' => '=='
        )
      )
    ));
    ?>

    <?php if( $the_query->have_posts() ): ?>
      <?php while( $the_query->have_posts() ) : $the_query->the_post();
        $thumbhome = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
        $url = $thumbhome['0'];
      ?>
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
                <?php the_category(' '); ?>
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
        </div>
      <?php endwhile; ?>
    <?php endif; ?>

    <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
  <?php } // end top wide home featured content ?>

  <?php /* Begin actual header/navigation */ ?>
  <header class="banner navbar navbar-default navbar-static-top" role="banner">
    <div class="header-wrapper">
      <div class="container">
        <a class="main-logo" href="/">DAMn MAGAZINE - <?php bloginfo('name'); ?></a>
        <span class="issue-number" style="color: #<?php the_field('issue_number_color', 'option'); ?>"><?php the_field('issue_number', 'option'); ?></span>
      </div>
    </div>

    <div class="white-wrapper">
      <div class="container">
        <div class="navbar-header page-scroll">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <nav class="collapse navbar-collapse main-navigation" role="navigation">
          <?php
          if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav']);
          endif;
          ?>
          <?php
          if (has_nav_menu('header_socials')) :
            wp_nav_menu(['theme_location' => 'header_socials', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'social-nav navbar-nav']);
          endif;
          ?>
        </nav>
      </div>
    </div>

    <?php /* leave this here, it activates the sticky nav */ ?>
    <div class="fixed-nav-activator clearthis"></div>
  </header>
  <?php /* end actual header/navigation */ ?>

  <?php if(is_single() || (is_front_page())) { ?>
    <?php /* dont display title wrapper if is single */ ?>
  <?php } else { ?>
    <?php /* or else display title wrapper and show archive title based on if its a post type, category, taxonomy, or page */ ?>
    <div class="title-wrapper">
      <?php if(is_archive()) { ?>
        <h1 class="archive-title">
          <?php the_archive_title(); ?>
        </h1>
        <?php
          the_archive_description( '<div class="taxonomy-description">', '</div>' );
        ?>
      <?php } elseif(is_page()) { ?>
        <h1 class="page-title" itemprop="headline">
          <?php the_title(); ?>
        </h1>
      <?php } elseif(is_search()) { ?>
        <?php get_template_part('templates/page', 'header'); ?>
      <?php } ?>
    </div>
  <?php } ?>
</div>


