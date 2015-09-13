<?php
global $issue_color;

$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$url = $thumb['0'];
?>

<div class="news-item">

  <?php /* damn plus badge */ ?>
  <?php get_template_part('templates/damn-plus-badge'); ?>

  <?php /* REUSED snippet to display title, category, subtitle */ ?>
  <?php get_template_part('templates/snippet', 'feed-header'); ?>

  <?php if(get_field('start_date')) { ?>
    <div class="event-date row">
      <div class="col-xs-6">
        <p><strong>Start Date:</strong> <?php the_field('start_date'); ?></p>
      </div>
      <?php if(get_field('end_date')) { ?>
        <div class="col-xs-6">
          <p><strong>End Date:</strong> <?php the_field('end_date'); ?></p>
        </div>
      <?php } ?>
    </div>
  <?php } ?>

  <?php if ( has_post_thumbnail()) { ?>
    <div class="post-image" style="background-image:url(<?=$url?>);">
  <?php } else { ?>
    <div class="post-image" style="background-color: <?=$issue_color?>">
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