<?php
/**
 * Editons taxonomy archive
 */
get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>


<?php
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$url = $thumb['0'];
?>

<div class="news-item-wrapper col-xs-6 col-sm-6 col-md-4" id="post-<?php the_ID(); ?>">
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

      <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

      <?php if(get_field('sub-title')) { ?>
        <h3 class="subtitle">
          <?php the_field('sub-title'); ?>
        </h3>
      <?php } else { ?>
        <h3 class="subtitle">
          <?php the_excerpt(); ?>
        </h3>
      <?php } ?>
    </header>
  </div>
</div>


<div class="wrapper">
  <div class="primary-content">
    <h1 class="archive-title"><?php echo apply_filters( 'the_title', $term->name ); ?> News</h1>

    <?php if ( !empty( $term->description ) ): ?>
    <div class="archive-description">
      <?php echo esc_html($term->description); ?>
    </div>
    <?php endif; ?>

    <?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class('post clearfix'); ?>>
      <h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
      <div class="content clearfix">
        <div class="post-info">
          <p><?php the_time(get_option('date_format')); ?> by <?php the_author_posts_link(); ?></p>
        </div><!--// end .post-info -->
        <div class="entry">
          <?php the_content( __('Full story…') ); ?>
        </div>
      </div>
    </div><!--// end #post-XX -->

    <?php endwhile; ?>

    <div class="navigation clearfix">
      <div class="alignleft"><?php next_posts_link('« Previous Entries') ?></div>
      <div class="alignright"><?php previous_posts_link('Next Entries »') ?></div>
    </div>

    <?php else: ?>

    <h2 class="post-title">No News in <?php echo apply_filters( 'the_title', $term->name ); ?></h2>
    <div class="content clearfix">
      <div class="entry">
        <p>It seems there isn't anything happening in <strong><?php echo apply_filters( 'the_title', $term->name ); ?></strong> right now. Check back later, something is bound to happen soon.</p>
      </div>
    </div>

    <?php endif; ?>
  </div><!--// end .primary-content -->

  <div class="secondary-content">
    <?php get_sidebar(); ?>
  </div><!--// end .secondary-content -->

<?php get_footer(); ?>