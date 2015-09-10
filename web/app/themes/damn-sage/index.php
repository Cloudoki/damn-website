<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php

	// Get home fillament stream
	$dynamics = new WP_Query(
	[
		'posts_per_page' => 30,
		'post_type' => array ('post','calendar'),
	]);

?>

<?php /* first six posts */ ?>
<div class="row">
	<?php
	$post_count = 0;
	while ($dynamics->have_posts()) : $dynamics->the_post();
  if($post_count++ == 6) break;
  ?>
    <?php
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
    $url = $thumb['0'];
    ?>

    <?php if( $dynamics->current_post%4 == 0 && (int)( $dynamics->current_post / 3 ) < 3 && !is_paged() ) { ?>
      <div class="news-item-wrapper col-xs-12 col-sm-8">
    <?php } else { ?>
      <div class="news-item-wrapper col-xs-12 col-sm-6 col-md-4">
    <?php } ?>

      <div class="news-item">
        <?php if ( has_post_thumbnail()) { ?>
          <div class="post-image" style="background-image:url(<?=$url?>);">
        <?php } else { ?>
          <div class="post-image" style="background-image:url(<?= get_template_directory_uri(); ?>/dist/images/default-tall.png)">
        <?php } ?>
          <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
            <?php if (is_single()) { ?>
              <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
            <?php } else { ?>
              <?php if( $dynamics->current_post%4 == 0 && (int)( $dynamics->current_post / 3 ) < 3 && !is_paged() ) : ?>
                <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-wide.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
              <?php else : ?>
                <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
              <?php endif; ?>
            <?php } ?>
          </a>
        </div>

        <?php /* REUSED snippet to display title, category, subtitle */ ?>
        <?php get_template_part('templates/snippet', 'feed-header'); ?>
      </div>
    </div>

		<?php /* insert advert if after the 1st post */ ?>
		<?php if($post_count == 1) { ?>
			<?php get_template_part('templates/advert-block-premium'); ?>
			<div class="clearfix visible-sm visible-md visible-lg"></div>
		<?php } ?>

	<?php endwhile; ?>
</div>

<?php /* sponsored content */ ?>
<div class="row sponsored-content-wrapper">
  <div class="col-xs-12">
    <div class="advert middle advert">
      <?php if (function_exists('adrotate_group')) echo adrotate_group(6); ?>
    </div>
  </div>
</div>


<?php /* 4 up category feeds */ ?>
<div class="row home-category-feeds">
<?php

	$post_cats = [];
	$cats_count = 0;

	while ($dynamics->have_posts()) : $dynamics->the_post();

		// Build Cat info
		$categories = get_the_category();

		if(!isset ($post_cats[$categories[0]->term_id]))

			$post_cats[$categories[0]->term_id] = [];

		// Dirty fetch post
		ob_start();
		get_template_part('templates/content-home-small-feeds', get_post_type() != 'post' ? get_post_type() : get_post_format());

		$post_cats[$categories[0]->term_id][] = ob_get_clean();


		// Output if possible
		if (count ($post_cats[$categories[0]->term_id]) == 2)
		{

		?>
		 <div class="col-xs-12 col-md-3">
			<h3 class="archive-title">
			<?php echo $categories[0]->name; ?>
			</h3>
		<?php

			echo implode ("<br>", $post_cats[$categories[0]->term_id]);

		?> </div> <?php

			if (++$cats_count == 4) break;
		}

	endwhile;
	?>

</div>


<?php /* 3 bottom widgets */ ?>
<div class="row bottom-widgets">
  <div class="col-xs-12 col-sm-4">
    <?php if ( is_active_sidebar( 'sidebar-homepage-agenda' ) ) : dynamic_sidebar( 'sidebar-homepage-agenda' ); endif; ?>
  </div>

  <div class="col-xs-12 col-sm-4">
    <?php if ( is_active_sidebar( 'sidebar-homepage-socials' ) ) : dynamic_sidebar( 'sidebar-homepage-socials' ); endif; ?>
  </div>

  <div class="col-xs-12 col-sm-4">
    <h3>Join DAMn +</h3>
  </div>
</div>

