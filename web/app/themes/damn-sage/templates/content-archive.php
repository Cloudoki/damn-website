<?php use Roots\Sage\Extras; ?>

<div class="news-item-wrapper col-xs-12 col-sm-6 col-md-4 col-lg-4 <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>" id="post-<?php the_ID(); ?>">
  <div class="news-item">

    <?php if ( has_post_format( 'quote' )) { ?>

      <div class="post-image">
        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
        </a>
      </div>

      <header class="quote-format">
        <div class="quote-wrapper-outer">
          <div class="quote-wrapper-inner">
            <blockquote>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
              <p>
                <?= Extras\get_excerpt(140); ?>
              </p>
            </a>
            </blockquote>
          </div>
        </div>
      </header>

    <?php } else { ?>

      <?php /* REUSED snippet to display post image */ ?>
      <?php get_template_part('templates/snippet', 'post-image'); ?>

      <?php /* REUSED snippet to display title, category, subtitle */ ?>
      <?php get_template_part('templates/snippet', 'feed-header'); ?>

    <?php } ?>
  </div>
</div>