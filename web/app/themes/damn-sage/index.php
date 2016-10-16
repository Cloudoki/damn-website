<?php use Roots\Sage\Extras; ?>

<?php 
global $issue, $issue_color, $issue_number, $main_query;
	
if (!have_posts())
	get_template_part('templates/snippet-no-results');

	/**
	 *  Featured post.
	 *
	 *  There can only be one featured post.
	 *  It shall be an article. It shall be the most recent one.
	 */
	$feat_query = [
		'cat' => '-4315',
		'posts_per_page' => 4,
		'post_type' => 'post',
		'orderby' => 'post_date',
		'order' => 'DESC',
		'relation' => 'OR',
			array(
				'key' => '_thumbnail_id',
			),
			array(
				'key' => '_scheduled_thumbnail_id',
			)
	];

	/**
	 *  Latest posts.
	 *
	 * 3 posts under slider.
	 * 
	 */

	$latest_query = [
		'posts_per_page' => 3,
		'offset' => 4,
		'post_type' => 'post',
		'orderby' => 'post_date',
		'order' => 'DESC',
		'cat' => '-4315'
	];

	/**
	 *  Calendar stream.
	 *
	 *  The home calendar stream can contain 6 calendar nodes.
	 */
	$cal_query = [
		'posts_per_page' => 6,
		'post_type' => 'calendar',
		'orderby' => 'post_date',
		'order' => 'DESC'
	];
	
	/**
	 *  Manifesto stream.
	 *
	 *  The manifesto stream contains 1 article only.
	 */
	$manf_query = [
		'posts_per_page' => 1,
		'post_type' => 'post',
		'orderby' => 'post_date',
		'order' => 'DESC',
		'tax_query' => [
			[
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => 'manifesto'
			],
			[
				'taxonomy' => 'magazine',
				'field' => 'slug',
				'terms' => $issue->slug
			],
		]
	];
	
	
	/**
	 *  Posts stream.
	 *
	 *  The home posts stream can contain both articles and calendar nodes. EXCLUDES video post format, as those load below main query
	 */
	$issue_query = [
		'posts_per_page' => 5,
		'post_type' => 'post',
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post__not_in' => [],
		'meta_query' => [[ 'key' => '_thumbnail_id' ]],
		'tax_query' => [[
			'taxonomy' => 'magazine',
			'field' => 'slug',
			'terms' => $issue->slug
		]]
	];
	
	/**
	 *  Posts stream.
	 *
	 *  The home posts stream can contain both articles and calendar nodes. EXCLUDES video post format, as those load below main query
	 */
	$main_query = [
		'posts_per_page' => 3,
		'post_type' => 'post',
		'orderby' => 'post_date',
		'order' => 'DESC',
		'meta_query' => [[ 'key' => '_thumbnail_id' ]],
		'post__not_in' => [],
	];
	
	/**
	*  Issue filtering.
	*
	*  If issue string parameter is provided,
	*  show only connected posts and calendars.
	*/
	if ( isset( $_GET['issue'] ) )
	
		$feat_query['tax_query'][] =
		$main_query['tax_query'][] = [
			'taxonomy' => 'magazine',
			'field' => 'slug',
			'terms' => [$issue->slug]
		];
	
	// Build featured post row
	$featured = new WP_Query($feat_query);
	//$main_query['post__not_in'][];
	if( $featured->have_posts() ) {

	?>
	<div class="row">
		
	<?php 
		
		include 'templates/home-carousel.php'; 
		
		get_template_part('templates/advert-block-premium');
		
	?>
	
		<?php
		//echo do_shortcode('[display-posts posts_per_page="4" bootstrap="1"]');
		
		/*
		while( $featured->have_posts() ){
			
			$featured->the_post();
			
			// Excempt featured post from main streams
			
			$issue_query['post__not_in'][] = get_the_ID();
			get_template_part('templates/home', 'primary-row');

		}
		*/ ?>

		<?php   ?>

	</div>

	<div class="row">
		<?php 
			
			/*
			* 3 posts under the slider
			*/

			$latest_posts = new WP_Query( $latest_query );

			if ( $latest_posts->have_posts() ){
		?>
			<div class="hp-latest-posts">
		<?php
				while ( $latest_posts->have_posts() ) {
					$latest_posts->the_post();

					get_template_part('templates/home', 'latest-posts');

				}
		?>
			</div>
		<?php
			}
		 ?>
	</div>

	<?php
	}

	// Build second row
	$calnodes = new WP_Query($cal_query);
	
	?>
	<div class="row recent-agenda">
		<!--<div class="table-row">-->
		<?php
		if ( $calnodes->have_posts() ) {
		?>
			<br>
			<div class="col-xs-12">
		       <h3 class="archive-title">Calendar</h3>
		    </div>


		<?php
		while ($calnodes->have_posts())
			{
				$calnodes->the_post();
				get_template_part('templates/post-calendar');  
			}
		}
		?>
		<!--</div>-->
	</div>

	<?php 
		$main_event = get_field('highlighted_event', 'option');
	 	if( $main_event ){
	?>
		<hr>
		<article class="item-manifesto col-md-12" >
			
				<div class="row">
					<div class="col-md-8">
						<a href="<?php echo get_permalink( $main_event->ID ); ?>" rel="bookmark" title="<?php echo get_the_title( $main_event->ID ); ?>">
							<h1><span class="description">Events /</span><?php echo get_the_title( $main_event->ID ); ?></h1>

							<p><?php echo $main_event->post_excerpt ?></p>
						</a>
						<div class="previous"><a href="/events">View All Events</a></div>
						
					</div>

					<div class="col-md-4 post-image" style="background-image:url(<?php echo $url = wp_get_attachment_url( get_post_thumbnail_id( $main_event->ID ) ); ?>);"><a class="home-img-link" href="<?php echo get_permalink( $main_event->ID ); ?>"></a></div>

				</div>
			</a>
		</article>
		<hr>
	<?php
	 	} else {
			
			$args = array( 'post_type' => 'projects', 'posts_per_page' => 1 );
			$query = new WP_Query( $args );

			if( $query->have_posts() ){
				while( $query->have_posts() ){ $query->the_post(); global $post;
	?>
				<hr>
				<article class="item-manifesto col-md-12" >
					
						<div class="row">
							<div class="col-md-8">
								<a href="<?php echo get_permalink(); ?>" rel="bookmark" title="<?php echo get_the_title(); ?>">
									<h1><span class="description">Projects / </span><?php echo get_the_title(); ?></h1>

									<p><?php echo $post->post_excerpt ?></p>
								</a>
								<div class="previous"><a href="/projects">View All Projects</a></div>
							</div>

							<div class="col-md-4 post-image" style="background-image:url(<?php echo $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>);"><a class="home-img-link" href="<?php echo get_permalink( ); ?>"></a></div>

						</div>
					</a>
				</article>
				<hr>
	<?php
				}
			} wp_reset_postdata(); wp_reset_query();
	 	}
	?>

</div>

<?php /* sponsored content */ ?>
<div class="advert-grey-wrapper">
	<div class="container">
		
		<div class="row sponsored-content-wrapper">
			<div class="col-xs-12">
				<div class="middle advert">
				<?=function_exists('adrotate_group')? adrotate_group(6): null?>
				</div>
			</div>
		</div>
		
	</div>
</div>

<div class="container">
<?php

/**
 *	Manifesto & Articles
 *	The Manifesto and articles in this row are Issue-bound.
 */

// Fetch issue-related manifesto
$manifesto = new WP_Query($manf_query);

if( $manifesto->have_posts() ) $manifesto->the_post();

// Excempt manifesto from main streams
$main_query['post__not_in'][] = 
$issue_query['post__not_in'][] = get_the_ID();
?>

	<div class="empty-wrapper row">
		
		<div class="col-sm-12 col-md-8">
			<div class="row">
				<?php get_template_part('templates/post-manifesto'); ?>
			</div>
			<hr class="sub-column" />
			
			<h3 class="read-more-separator archive-title">Read DAMN° articles from previous issues</h3>

			<div class="row category-articles">
<?php

// Fetch issue-related articles
$issues = new WP_Query($issue_query);

// Excempt issue post from main stream
if ( $issues->have_posts() ){
	foreach ($issues->posts as $post)
		$main_query['post__not_in'][] = $post->ID;
}



// Default Categories: 
// Design, Architecture & Art
$cats = [56, 60, 57];

// Override 3rd Category
if ($issue_cat && !in_array($issue_cat->term_id, $cats))

	$cats[2] = $issue_cat->term_id;

foreach ($cats as $n):

	$main_query['cat'] = $n;
	
	$main_query['posts_per_page'] = 4;
	$main_query['orderby'] = 'rand';
	// query for last 6 months 
	$main_query['date_query'] = array(
        'column'  => 'post_date',
        'after'   => '- 180 days'
    );


	// Fetch category-related articles
	$dynamics = new WP_Query($main_query);
	$category = get_term ($n, 'category');
?>

				<div class="col-sm-12 col-md-4">
					<a href="<?=get_category_link($n)?>">
						<h2 class="category-title"> 
						<category><?=$category->name?></category> <span class="description">/ Articles</span>
						</h2>
					</a>
					
					<div class="empty-wrapper row">
<?php
	if( $dynamics->have_posts() ){
		while ( $dynamics->have_posts() )
		{
			$dynamics->the_post();
			
			get_template_part(
				has_post_format( 'quote' )? 'templates/post-quote': 'templates/post-simple'
			);
			
			$main_query['post__not_in'][] = get_the_ID();
		}
	}

?>					
					</div>
				</div>
				
<?php endforeach; ?>

			</div>
		</div>

		<div class="col-sm-12 col-md-4 issue-articles">
			<h2>ISSUE #<?=$issue_number?> <span class="description">/ Articles</span></h2>
			
			<div class="row">
			<?php
	
			while ($issues->have_posts())
			{
				$issues->the_post();
				get_template_part('templates/post');  
			}
		
			?>
			</div>
		</div>
		
	</div>
</div>

<?php /* 4 up products feed */ ?>
<?php
$product_query = [
	'posts_per_page' => 4,
	'post_type' => 'product',
	'orderby' => 'post_date',
	'order' => 'DESC'
];

if ( isset( $_GET['issue'] ) )
	$product_query['tax_query'][] = [
		'taxonomy' => 'magazine',
		'field' => 'slug',
		'terms' => [$issue->slug]
	];

$products = new WP_Query($product_query);

if ($products->have_posts()) : ?>

<div class="products-row">
  <div class="container">
    <div class="product-feed-home row">

      <div class="col-xs-12">
        <h3 class="archive-title">Productivity</h3>
      </div>
      <?php /* display as table above 768, so heights all line up / 768 - 991, table cell is 50% height, since there are 2 per row, 100% height at 992 +, as all 4 fit across one row / css home.scss */ ?>
      <div class="table-display">
      <?php while ($products->have_posts()) : $products->the_post(); ?>
        <div class="col-xs-12 col-sm-6 col-md-3 table-cell">

        <?php get_template_part('templates/content-productivity', get_post_type() != 'product' ? get_post_type() : get_post_format()); ?>

        <div class="clearthis"></div>
        </div>
      <?php endwhile; ?>
      </div>

    </div>
  </div>
</div>

  <?php endif; ?>

<div class="container">

	<?php /* 3 bottom widgets */ ?>
	<div class="row bottom-widgets">
		<div class="col-xs-12 col-sm-6 col-md-6 table-cell">
		<?php if ( is_active_sidebar( 'sidebar-homepage-agenda' ) ) : dynamic_sidebar( 'sidebar-homepage-agenda' ); endif; ?>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-6">
		<?php if ( is_active_sidebar( 'sidebar-homepage-socials' ) ) : dynamic_sidebar( 'sidebar-homepage-socials' ); endif; ?>
		</div>

	</div>
</div>

<?php 
/*
* Spoted with DAMN
*/
 ?>

<br>
<div class="row swd-container">
	<div class="container">
		<br>
		<div class="col-xs-12">
	       <h3 class="archive-title swd-title">#SPOTTEDWITHDAMN</h3>
	    </div>
		<br>
		<?php if ( function_exists( 'wdi_feed' ) ){
			echo wdi_feed(array('id'=>'1'));
		} ?>
	</div>
</div>

<?php 

/*
* Popup
 */
?>

<div id="popup-bg"></div>

<?php get_template_part('templates/popup', 'full'); ?>


<?php 
/*
* Mobile version
 */
 ?>
 
<?php get_template_part('templates/popup', 'mobile'); ?>


