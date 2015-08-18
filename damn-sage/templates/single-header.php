<div class="single-news-item">
  <div class="post-image">
    <?php if ( has_post_thumbnail()) { ?>
      <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
        <?php the_post_thumbnail( 'full' ); ?>
      </a>
    <?php } else { ?>
     <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="list-thumb">
      <img src="<?= get_template_directory_uri(); ?>/dist/images/default-large.png" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>"/>
     </a>
    <?php } ?>
  </div>

  <header>
    <div class="category-link">
      <?php the_category(' '); ?>
    </div>
    <h1 class="entry-title"><?php the_title(); ?></h1>
  </header>
</div>