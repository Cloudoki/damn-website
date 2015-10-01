<?php
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$url = $thumb['0'];
?>

<?php /* if events post type, load details button over the default or post thumbnail image.. else all others, no button and alternate sized default/post thumbnail images */ ?>

<?php if (is_post_type_archive('events')) { ?>

  <div class="positioned-border"></div>

  <a class="btn btn-lg btn-default text-uppercase event-button" href="<?php the_permalink() ?>" target="_blank" title="<?php the_title_attribute(); ?>">DETAILS</a>

  <?php if ( has_post_thumbnail()) { ?>
    <div class="post-image" style="background-image:url(<?=$url?>);">
  <?php } else { ?>
    <div class="post-image" style="background-image:url(<?= get_template_directory_uri(); ?>/dist/images/default.gif)">
  <?php } ?>
    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
      <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-news-sm-tall.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
    </a>
  </div>

<?php } else { ?>

  <?php if ( has_post_thumbnail()) { ?>
    <div class="post-image" style="background-image:url(<?=$url?>);">
  <?php } else { ?>
    <div class="post-image" style="background-image:url(<?= get_template_directory_uri(); ?>/dist/images/default-tall.png)">
  <?php } ?>
    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
      <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
    </a>
  </div>

<?php } ?>