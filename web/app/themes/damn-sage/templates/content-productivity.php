<div class="news-item">

  <div class="post-image">
    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
      <?php if ( has_post_thumbnail()) { ?>
        <?php the_post_thumbnail('large'); ?>
      <?php } else { ?>
        <img src="<?= get_template_directory_uri(); ?>/dist/images/default-tall.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>"/>
      <?php } ?>
    </a>
  </div>

  <header>
    <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
    <?php if(get_field('custom_description')) { ?>
      <div class="product-description">
        <p><?php the_field('custom_description'); ?></p>
      </div>
    <?php } else { ?>
      <div class="product-excerpt">
        <?php the_excerpt(); ?>
      </div>
    <?php } ?>
    <?php if(get_field('creators')) { ?>
      <p class="product-creators">
        <span>
          <strong>From:</strong> <?php the_field('creators'); ?>
        </span>
      </p>
    <?php } ?>
  </header>
</div>