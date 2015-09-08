<?php
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
$url = $thumb['0'];
?>

<div class="single-news-item">
  <?php if ( has_post_thumbnail()) { ?>
    <div class="post-image" style="background-image:url(<?=$url?>);">
  <?php } else { ?>
    <div class="post-image" style="background-image:url(<?= get_template_directory_uri(); ?>/dist/images/default-large.png)">
  <?php } ?>
      <img src="<?= get_template_directory_uri(); ?>/dist/images/default-large-wide.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>"/>
  </div>

  <header>
    <div class="category-link">
      <?php the_category(' '); ?>
    </div>
    <div class="entry-meta">
    <h1 class="entry-title"><?php the_title(); ?></h1>
    <?php if(get_field('sub-title')) { ?>
      <h3 class="subtitle">
        <?php the_field('sub-title'); ?>
      </h3>
    <?php } ?>
  </header>
</div>