<?php
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$url = $thumb['0'];
?>

<?php if (is_single()) { ?>
  <div class="col-12 col-xs-6 col-sm-3">
<?php } else { ?>
  <div class="col-12 col-xs-6 col-sm-4">
<?php } ?>

  <div class="news-item">
    <?php if ( has_post_thumbnail()) { ?>
      <div class="post-image" style="background-image:url(<?=$url?>);">
    <?php } else { ?>
      <div class="post-image" style="background-image:url(<?= get_template_directory_uri(); ?>/dist/images/default-tall.png)">
    <?php } ?>
      <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?= get_bloginfo("name"); ?>" class="placeholder" />
    </div>

    <header>
      <div class="category-link">
        <?php the_category(' '); ?>
      </div>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    </header>
  </div>
</div>
