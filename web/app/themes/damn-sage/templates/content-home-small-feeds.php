<?php
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$url = $thumb['0'];
?>

<div class="news-item-wrapper">
  <div class="news-item">
    <?php if ( has_post_thumbnail()) { ?>
      <div class="post-image" style="background-image:url(<?=$url?>);">
    <?php } else { ?>
      <div class="post-image" style="background-image:url(<?= get_template_directory_uri(); ?>/dist/images/default-tall.png)">
    <?php } ?>
      <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
        <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
      </a>
    </div>

    <header>
      <div class="category-link">
        <?php the_category(' '); ?>
      </div>

      <h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
    </header>
  </div>
</div>