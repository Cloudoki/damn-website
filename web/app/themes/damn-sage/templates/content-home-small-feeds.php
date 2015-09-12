<?php
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$url = $thumb['0'];
?>

<div class="news-item-wrapper <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">
  <div class="news-item">

    <?php /* damn plus badge */ ?>
    <?php get_template_part('templates/damn-plus-badge'); ?>

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
      <?php get_template_part('templates/snippet', 'category-link'); ?>

      <h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
    </header>
  </div>
</div>