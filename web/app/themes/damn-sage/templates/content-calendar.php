<?php
global $issue_color;

$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$url = $thumb['0'];
?>

<div class="news-item">

  <?php /* REUSED snippet to display title, category, subtitle */ ?>
  <?php get_template_part('templates/snippet', 'feed-header'); ?>

  <?php if(get_field('start_date') || get_field('end_date')) { ?>
    <div class="event-date row border-bottom-white">
  <?php } else { ?>
    <div class="event-date row">
  <?php } ?>

    <?php if(get_field('start_date')) { ?>
      <div class="col-xs-6 start-date">
        <p><strong>Start Date:</strong> <?php the_field('start_date'); ?></p>
      </div>
    <?php } ?>
    <?php if(get_field('end_date')) { ?>
      <div class="col-xs-6 end-date">
        <p><strong>End Date:</strong> <?php the_field('end_date'); ?></p>
      </div>
    <?php } ?>
  </div>

  <?php if ( has_post_thumbnail()) { ?>
    <div class="post-image" style="background-image:url(<?=$url?>);">
      <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
        <img src="<?= get_template_directory_uri(); ?>/dist/images/default-tall-blank.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
      </a>
    </div>
  <?php } ?>
</div>