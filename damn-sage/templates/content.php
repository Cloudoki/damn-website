<?php if (is_single()) { ?>
  <div class="col-12 col-xs-6 col-sm-3">
<?php } else { ?>
  <div class="col-12 col-xs-6 col-sm-4">
<?php } ?>

  <div class="news-item">
    <div class="post-image">
      <?php if ( has_post_thumbnail()) { ?>
        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          <?php the_post_thumbnail( 'news-image' ); ?>
        </a>
      <?php } else { ?>
        <img src="<?= get_template_directory_uri(); ?>/dist/images/default.gif" alt="<?= get_bloginfo("name"); ?>"/>
      <?php } ?>
    </div>
    <header>
      <div class="category-link">
        <?php the_category(' '); ?>
      </div>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    </header>
  </div>
</div>

