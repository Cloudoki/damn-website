<?php
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
$url = $thumb['0'];
?>

<div class="single-news-item">
  <?php /* damn plus badge */ ?>
  <?php get_template_part('templates/damn-plus-badge'); ?>

  <?php if ( has_post_thumbnail()) { ?>
    <div class="post-image" style="background-image:url(<?=$url?>);">
  <?php } else { ?>
    <div class="post-image" style="background-image:url(<?= get_template_directory_uri(); ?>/dist/images/default-large.png)">
  <?php } ?>
    <?php /* based on browser size, show one other other image. uses bootstrap visible class to show/hide */ ?>
    <img src="<?= get_template_directory_uri(); ?>/dist/images/default-large-wide.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="visible-md-block visible-lg-block" />
    <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-news-sm.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="visible-xs-block visible-sm-block" />
  </div>

  <header>
    <?php get_template_part('templates/snippet', 'category-link'); ?>
    <div class="entry-meta">
    <h1 class="entry-title"><?php the_title(); ?></h1>
    <?php if(get_field('sub-title')) { ?>
      <h3 class="subtitle">
        <?php the_field('sub-title'); ?>
      </h3>
    <?php } ?>
  </header>
</div>

<?php /* only show share icons and publish date/author here on 768 to 991, since its too wide to fit in the normal place (at this particular view) */ ?>
<?php while (have_posts()) : the_post(); ?>
  <div class="visible-sm-block ipad-sized-meta">
    <div class="container">
      <?php get_template_part('templates/entry-meta'); ?>
      <div class="clearthis"></div>
    </div>
  </div>
<?php endwhile; ?>