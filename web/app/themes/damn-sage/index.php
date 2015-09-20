<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_template_part('templates/snippet-search-form'); ?>
<?php endif; ?>

<?php
	/**
	 *	Issue filtering.
	 *
	 *	If issue string parameter is provided,
	 *	show only connected posts and calendars.
	 */
	$main_query = [
		'posts_per_page' => 75,
		'post_type' => array ('post','calendar'),
		'orderby' => 'post_date',
		'order' => 'DESC'
	];

	if ($_GET['issue'])
		$main_query['tax_query'][] = [
			'taxonomy' => 'magazine',
			'field' => 'slug',
			'terms' => [$issue->slug]
		];

	$dynamics = new WP_Query($main_query);

	/*
	if ($_GET['issue']) {
		$dynamics = new WP_Query(
		[
			'posts_per_page' => 75,
			'post_type' => array ('post','calendar'),
			'orderby' => 'post_date',
			'order' => 'DESC',
			// if issue filter, restrict post to only issue posts
			'tax_query' => array(
				array(
					'taxonomy' => 'magazine',
					'terms'    => $issue,
				),
			)
		]);

	} else {
		$dynamics = new WP_Query(
		[
			'posts_per_page' => 75,
			'post_type' => array ('post','calendar'),
			'orderby' => 'post_date',
			'order' => 'DESC',
		]);
	}*/

?>

<?php

/**
 *  Selected Issue
 */
global $issue, $issue_color, $issue_number;

// Some dry data
$issue_acf_id = 'magazine_' . $issue->term_id;
$featurevideo = get_field ('video_embed1', $issue_acf_id);
?>

<?php
$post_count = 0;
while ($dynamics->have_posts()) : $dynamics->the_post();
  if($featurevideo) {
    if($post_count++ == 5) break;
  } else {
    if($post_count++ == 6) break;
  }
?>
  <?php
  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
  $url = $thumb['0'];
  ?>

  <?php if( $dynamics->current_post%6 == 0 ) { ?>

    <?php /* first post and ad */ ?>
      <div class="row">
        <div class="first-post-advert-wrapper">
          <div class="table-row">

            <?php /* first news item wrapper */ ?>
            <?php if ( has_post_format( 'quote' )) { ?>
              <div class="news-item-wrapper col-xs-12 col-sm-8 large-post quote-format <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">
            <?php } elseif ( has_post_thumbnail()) { ?>
            <div class="news-item-wrapper col-xs-12 col-sm-8 large-post <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>" style="background-image:url(<?=$url?>);">
            <?php } else { ?>
            <div class="news-item-wrapper col-xs-12 col-sm-8 large-post <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>" style="background-image:url(<?= get_template_directory_uri(); ?>/dist/images/default-tall.png)">
            <?php } ?>

              <?php if ( has_post_format( 'quote' )) { ?>
                <div class="news-item noMargin">

                  <div class="post-image">
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                      <?php /* show non wide blank-image only on 768-992 so boxes adjust properly, using class "visible-xs-block" */ ?>
                      <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-wide-quote.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="hidden-xs" />
                      <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="visible-xs-block" />
                    </a>
                  </div>

                  <header class="quote-format">
                    <div class="quote-wrapper-outer">
                      <div class="quote-wrapper-inner">
                        <blockquote>
                          <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            <?php the_excerpt(); ?>
                          </a>
                        </blockquote>
                      </div>
                    </div>
                  </header>

                </div>

              <?php } else { ?>

                <?php /* REUSED snippet to display title, category, subtitle */ ?>
                <?php get_template_part('templates/snippet', 'feed-header'); ?>
                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="link-image">
                  <?php /* show non wide blank-image only on 768-992 so boxes adjust properly, using class "visible-xs-block" */ ?>
                  <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder visible-sm-block visible-xs-block" />
                </a>

              <?php } ?>

            </div>
            <?php /* end news item wrapper */ ?>


            <?php /* advert */ ?>
            <?php get_template_part('templates/advert-block-premium'); ?>

          </div>
        </div>
      </div><?php /* end first row */ ?>
      <div class="empty-wrapper row"><?php /* open a new, basic container div so bootstrap column clears dont count advert wrapper in nth-child and break the layout. DIV CLOSED after ENDWHILE */ ?>
    <?php /* end dynamics current post first post */ ?>

  <?php } elseif ( $dynamics->current_post%6 == 5 ) { ?>

    <div class="news-item-wrapper col-xs-12 col-sm-12 col-md-8 medium-post <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">
      <div class="news-item">

        <?php if ( has_post_format( 'quote' )) { ?>

          <div class="post-image">
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
              <?php /* show non wide blank-image only on 768-992 so boxes adjust properly, using class "visible-xs-block" */ ?>
              <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-wide.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder hidden-xs" />
              <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder visible-xs-block" />
            </a>
          </div>

          <header class="quote-format">
            <div class="quote-wrapper-outer">
              <div class="quote-wrapper-inner">
                <blockquote>
                  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_excerpt(); ?>
                  </a>
                </blockquote>
              </div>
            </div>
          </header>

        <?php } else { ?>

          <?php if ( has_post_thumbnail()) { ?>
            <div class="post-image" style="background-image:url(<?=$url?>);">
          <?php } else { ?>
            <div class="post-image" style="background-image:url(<?= get_template_directory_uri(); ?>/dist/images/default-tall.png)">
          <?php } ?>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
              <?php /* show non wide blank-image only on 768-992 so boxes adjust properly, using class "visible-xs-block" */ ?>
              <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-wide.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder hidden-sm" />
              <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder visible-sm-block" />
            </a>
          </div>
          <?php /* REUSED snippet to display title, category, subtitle */ ?>
          <?php get_template_part('templates/snippet', 'feed-header'); ?>

        <?php } ?>

      </div>
    </div>

  <?php } else { ?>

    <div class="news-item-wrapper col-xs-12 col-sm-6 col-md-4 <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">
      <div class="news-item">

        <?php if ( has_post_format( 'quote' )) { ?>

          <div class="post-image">
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
              <?php /* if featured video, need a slightly taller image so the video and the post next to it align in height */ ?>
              <?php if($featurevideo) { ?>
                <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-video.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
              <?php } else { ?>
                <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
              <?php } ?>
            </a>
          </div>

          <header class="quote-format">
            <div class="quote-wrapper-outer">
              <div class="quote-wrapper-inner">
                <blockquote>
                  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_excerpt(); ?>
                  </a>
                </blockquote>
              </div>
            </div>
          </header>

        <?php } else { ?>

          <?php if ( has_post_thumbnail()) { ?>
          <div class="post-image" style="background-image:url(<?=$url?>);">
          <?php } else { ?>
          <div class="post-image" style="background-image:url(<?= get_template_directory_uri(); ?>/dist/images/default-tall.png)">
          <?php } ?>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">

              <?php /* if featured video, need a slightly taller image so the video and the post next to it align in height */ ?>
              <?php if($featurevideo) { ?>
                <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-video.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
              <?php } else { ?>
                <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
              <?php } ?>
            </a>
          </div>

          <?php /* REUSED snippet to display title, category, subtitle */ ?>
          <?php get_template_part('templates/snippet', 'feed-header'); ?>
        <?php } ?>

      </div>
    </div>
  <?php } ?>

<?php endwhile; ?>

<?php if($featurevideo) { ?>
  <div class="news-item-wrapper col-xs-12 col-sm-12 col-md-8 medium-post video-post">
    <div class="news-item">
      <div class="post-image">
        <?=$featurevideo?>
        <?php /* show non wide blank-image only on 768-992 so boxes adjust properly, using class "visible-xs-block" */ ?>
        <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-wide-video.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder hidden-xs" />
        <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-video.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder visible-xs-block" />
      </div>
    </div>
  </div>
<?php } ?>

</div><?php /* close empty-wrapper */ ?>

<style>
  .sponsored-content-wrapper .advert.middle   {
    background-color: black !important;
    position: relative;
    padding: 12px;
  }

  .sponsored-content-wrapper .advert.middle img {
    width: auto;
    height: auto;
  }
</style>

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

    if (count ($categories) > 1) shuffle ($categories);

	// Prevent cat overkill
	$cat_term = isset ($post_cats[$categories[0]->term_id], $categories[1]) && count ($post_cats[$categories[0]->term_id]) > 2?

		$categories[1]->term_id:
		$categories[0]->term_id;


    if(!isset ($post_cats[$cat_term]))

      $post_cats[$cat_term] = [];

    // Dirty fetch post
    ob_start();
    get_template_part('templates/content-home-small-feeds', get_post_type() != 'post' ? get_post_type() : get_post_format());

    $post_cats[$cat_term][] = ob_get_clean();


    // Output if possible
    if (count ($post_cats[$cat_term]) == 2)
    {

    ?>
     <div class="col-xs-12 col-sm-6 col-md-3">
      <h3 class="archive-title">
      <?php echo $categories[0]->name; ?>
      </h3>
    <?php

      echo implode ("<br>", $post_cats[$cat_term]);

    ?> </div> <?php

      if (++$cats_count == 4) break;
    }

  endwhile;
  ?>

</div>

<?php /* 4 up products feed */ ?>
<div class="product-feed-home row">
  <?php
    $product_query = [
      'posts_per_page' => 4,
      'post_type' => 'product',
      'orderby' => 'post_date',
      'order' => 'DESC'
    ];

    if ($_GET['issue'])
      $product_query['tax_query'][] = [
        'taxonomy' => 'magazine',
        'field' => 'slug',
        'terms' => [$issue->slug]
      ];

    $products = new WP_Query($product_query);
  ?>

  <?php if ($products->have_posts()) : ?>
    <div class="col-xs-12">
      <h3 class="archive-title">Productivity</h3>
    </div>
    <?php /* display as table above 768, so heights all line up / 768 - 991, table cell is 50% height, since there are 2 per row, 100% height at 992 +, as all 4 fit across one row / css home.scss */ ?>
    <div class="table-display">
      <?php
        while ($products->have_posts()) : $products->the_post();
        $customdescription = get_field('custom_description');
        $creators = get_field('creators');
      ?>
        <div class="col-xs-12 col-sm-6 col-md-3 table-cell">

          <?php get_template_part('templates/content-productivity', get_post_type() != 'product' ? get_post_type() : get_post_format()); ?>
          <div class="clearthis"></div>

        </div>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
</div>


<?php /* 3 bottom widgets */ ?>
<div class="row bottom-widgets">
  <div class="col-xs-12 col-sm-6 col-md-4 table-cell">
    <?php if ( is_active_sidebar( 'sidebar-homepage-agenda' ) ) : dynamic_sidebar( 'sidebar-homepage-agenda' ); endif; ?>
  </div>

  <div class="col-xs-12 col-sm-6 col-md-4">
    <?php if ( is_active_sidebar( 'sidebar-homepage-socials' ) ) : dynamic_sidebar( 'sidebar-homepage-socials' ); endif; ?>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-4">
    <div class="widget">
      <h3 class="widget-title">Join DAM<sub>N°</sub> +</h3>
        <div class="join-damn-plus-home-image">
          <?php $joinimage = wp_get_attachment_image_src(get_field('join_damn_plus_image', 'option'), 'full'); ?>
          <?php $joinimagewide = wp_get_attachment_image_src(get_field('join_damn_plus_image_wide', 'option'), 'full'); ?>
          <a href="/join-damn-plus" title="Join DAMN +">
            <?php if(get_field('join_damn_plus_image', 'option')) { ?>
              <img src="<?php echo $joinimage[0]; ?>" alt="Join DAMN +" class="visible-md-block visible-lg-block">
            <?php } ?>
            <?php if(get_field('join_damn_plus_image_wide', 'option')) { ?>
              <img src="<?php echo $joinimagewide[0]; ?>" alt="Join DAMN +" class="visible-xs-block visible-sm-block">
            <?php } ?>
          </a>
        </div>
    </div>
  </div>
</div>

