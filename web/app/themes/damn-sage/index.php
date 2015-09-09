<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<div class="row">
	<?php 
	$post_count = 0;
	
	while (have_posts()) : the_post();
		
		if(++$post_count == 6) break;
		
		/* normal post display */
		get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
		
		<?php /* insert advert if after the 1st post */ ?>
		<?php if ($wp_query->current_post == 0) { ?>
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
<?php /*
		
	$post_cats = [];
	
	while (have_posts()) : the_post();
	
		$post_cats[the_category(' ')]
		
		
	
	endwhile;
*/ ?>	
		
  <div class="col-xs-12 col-md-3">
    <?php   $do_not_duplicate = array(); ?>
    <?php   $artcats = new WP_Query('category_name=art&posts_per_page=2'); ?>
    <?php if (have_posts()) : ?>
      <h3 class="archive-title">
        Art
      </h3>
    <?php   while ($artcats->have_posts()) : $artcats->the_post(); ?>
    <?php   $do_not_duplicate[] = $post->ID; ?>
      <?php get_template_part('templates/content-home-small-feeds', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
    <?php   endwhile; endif; wp_reset_postdata(); ?>
  </div>

  <div class="col-xs-12 col-md-3">
    <?php   $artcats = new WP_Query( array( 'category_name' => 'architecture', 'posts_per_page' => 2, 'post__not_in' => $do_not_duplicate ) ); ?>
    <?php if (have_posts()) : ?>
      <h3 class="archive-title">
        Architecture
      </h3>
    <?php   while ($artcats->have_posts()) : $artcats->the_post(); ?>
    <?php   $do_not_duplicate[] = $post->ID; ?>
      <?php get_template_part('templates/content-home-small-feeds', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
    <?php   endwhile; endif; wp_reset_postdata(); ?>
  </div>

  <div class="clearfix visible-xs-block"></div>

  <div class="col-xs-12 col-md-3">
    <?php   $artcats = new WP_Query( array( 'category_name' => 'design', 'posts_per_page' => 2, 'post__not_in' => $do_not_duplicate ) ); ?>
    <?php if (have_posts()) : ?>
      <h3 class="archive-title">
        Design
      </h3>
    <?php   while ($artcats->have_posts()) : $artcats->the_post(); ?>
    <?php   $do_not_duplicate[] = $post->ID; ?>
      <?php get_template_part('templates/content-home-small-feeds', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
    <?php   endwhile; endif; wp_reset_postdata(); ?>
  </div>

  <div class="col-xs-12 col-md-3">
    <?php   $artcats = new WP_Query( array( 'category_name' => 'fashion', 'posts_per_page' => 2, 'post__not_in' => $do_not_duplicate ) ); ?>
    <?php if (have_posts()) : ?>
      <h3 class="archive-title">
        Fashion
      </h3>
    <?php   while ($artcats->have_posts()) : $artcats->the_post(); ?>
    <?php   $do_not_duplicate[] = $post->ID; ?>
      <?php get_template_part('templates/content-home-small-feeds', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
    <?php   endwhile; endif; wp_reset_postdata(); ?>
  </div>
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

