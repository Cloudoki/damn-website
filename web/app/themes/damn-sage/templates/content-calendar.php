<?php
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$url = $thumb['0'];
?>

<div class="news-item">
  <?php /* REUSED snippet to display title, category, subtitle */ ?>
  <?php get_template_part('templates/snippet', 'feed-header'); ?>

  <?php if ( has_post_thumbnail()) { ?>
    <div class="post-image" style="background-image:url(<?=$url?>);">
  <?php } else { ?>
    <div class="post-image" style="background-color: #<?php the_field('issue_number_color', 'option'); ?>">
  <?php } ?>
    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
      <?php if ( has_post_thumbnail()) { ?>
        <img src="<?= get_template_directory_uri(); ?>/dist/images/default-tall-blank.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
      <?php } else { ?>
        <img src="<?= get_template_directory_uri(); ?>/dist/images/default.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
      <?php } ?>
    </a>
  </div>
</div>