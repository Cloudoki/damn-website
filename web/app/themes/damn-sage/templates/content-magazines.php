<?php
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$url = $thumb['0'];
?>

<div class="news-item-wrapper col-xs-4 col-sm-3">
  <div class="news-item">
    <? /* the actual post images are backgrounds. transparent placeholders GIFs fill the actual space, so all blocks are the same size.
      If no post image is present, a default image loads instead */
    ?>
    <?php if ( has_post_thumbnail()) { ?>
      <div class="post-image" style="background-image:url(<?=$url?>);">
    <?php } else { ?>
      <div class="post-image" style="background-image:url(<?= get_template_directory_uri(); ?>/dist/images/default-tall.png)">
    <?php } ?>
      <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
        <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-magazine.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
      </a>
    </div>

    <header>
      <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
    </header>
  </div>
</div>