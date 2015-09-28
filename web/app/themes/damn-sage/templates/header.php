<?php
// This file assumes that you have included the nav walker from https://github.com/twittem/wp-bootstrap-navwalker
// somewhere in your theme.

// Identifier between issue- and event-based header will be placed here


/**
 *	Selected Issue
 */
global $issue, $issue_color, $issue_number;

$issue = $_GET['issue']?

	get_term_by('slug', preg_replace ("/[^A-Za-z0-9-]/", '', $_GET['issue']), 'magazine'):
	get_field ('current_issue', 'option');


if (!$issue) $issue = get_field ('current_issue', 'option');
if (!$issue)

	 throw new Exception('No current issue is set, please contact the DAMN° Moderator.');

// Some dry data
$issue_acf_id = 'magazine_' . $issue->term_id;
$issue_color = get_field ('issue_color', $issue_acf_id);
$issue_number = get_field ('magazine_number', $issue_acf_id);
$contrast = (int) get_field ('colour_scheme', $issue_acf_id);
$issue_link = get_term_link($issue->term_id, 'magazine');
$header_image = get_field ('header_image', $issue_acf_id);
$issue_cat = get_field ('primary_category', $issue_acf_id);
$header_highlight = get_field ('header_highlight', $issue_acf_id);
$header_subtitle = get_field ('header_subtitle', $issue_acf_id);
?>

<?php /*-- style all colors based on issue # color --*/ ?>
<style type="text/css" media="screen">
	a, a:visited, .nav a span, a.mobile-menu .fa {
		color: <?=$issue_color?>;
	}
	span.category-sep a.damn-plus {
		color: <?=$issue_color?> !important;
	}
	.btn-default, .btn-primary, body.damn-plus .title-wrapper, body.category-damn-plus .title-wrapper, body.login .main h3.widget-title,
	.back-to-calendar a.btn-primary, .article-navigation .pagination li span.current {
		background-color: <?=$issue_color?>;
		color: #fff !important;
	}
	.btn:hover {
		background-color: inherit;
	}
	.color-box, .damn-plus-badge, .join-damn-plus-home-image, .damn-plus-cta, .page-featured-image, .news-item-wrapper.damn-plus .news-item, .single-news-item {
		background-color: <?=$issue_color?>;
	}
	.first-post-advert-wrapper .blackBackground {
		background-color: <?=$issue_color?> !important;
	}
	.category-link .damn-plus {
		border-color: <?=$issue_color?> !important;
		background-color: <?=$issue_color?>;
		color: #fff !important;
	}
	.category-link .damn-plus:hover {
		background-color: <?=$issue_color?> !important;
		color: #000 !important;
	}
	body.damn-plus .title-wrapper h1, body.category-damn-plus .title-wrapper h1 {
		border-color: #fff;
	}
</style>

<?php /* mobile nav */ ?>
<nav id="my-menu" style="display:none;">
  <?php
	  if (has_nav_menu('primary_navigation')) :
	    wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'mobile-navigation']);
	  endif;
  ?>
</nav>

<?php if (!$header_image) : ?>
  <div class="home-feature nothing">
<?php else : ?>
  <div class="home-feature<?=$contrast? ' black-text': null?>">
<?php endif; ?>


	<?php /* If is home, load the header image and magazine details, if they exist */
	if (is_home()): ?>

		<?php if ($header_image): ?>
		<div class="single-news-item">

			<?php /* advertorial, if present */ ?>

				<?php
					$custom_query = new WP_Query( array( 'post_type' => array( 'advertorial' ), 'posts_per_page' => 1));
					while($custom_query->have_posts()) : $custom_query->the_post();
					?>
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="advertorial-badge">
							<?php the_title(); ?>
							<?php if(get_field('sub-title')) { ?>
			          <h3 class="subtitle">
			            <?php the_field('sub-title'); ?>
			          </h3>
			        <?php } ?>
						</a>
					<?php endwhile; ?>
				<?php wp_reset_postdata(); // reset the query ?>

			<?php /* advertorial, end */ ?>

			<div class="post-image">
				<a href="<?=$issue_link?>" rel="bookmark" title="<?=$header_highlight?>">
					<img src="<?=$header_image?>" alt="<?=$issue->name?>" />
				</a>
			</div>

			<header>
				<div class="container">

					<?php if ($issue_cat): ?>
					<div class="category-link">
						<a href="<?=get_category_link($issue_cat->term_id)?>"  class="<?=$issue_cat->slug?>" title="View all posts in <?=$issue_cat->name?>"><?=$issue_cat->name?></a>
					</div>
					<?php endif; ?>

					<h1 class="entry-title">
						<a href="<?=$issue_link?>" rel="bookmark" title="<?=$header_highlight?>"><?=$header_highlight?></a>
					</h1>
					<h3 class="subtitle"><?=$header_subtitle?></h3>

				</div>
			</header>
		</div>
		<?php endif; ?>

  <?php /* end if is home */
  endif; ?>


  <?php /* load normal navigation that shows on all pages. IF header image, show it in place of the solid black header */ ?>
	<header class="banner navbar navbar-default" role="banner">
	  <?php if (is_home()) : ?>
	    <div class="header-wrapper">
	  <?php elseif ($header_image) : ?>
	    <div class="header-wrapper" style="background-image: url(<?=$header_image?>);">
	  <?php else : ?>
	    <div class="header-wrapper">
	  <?php endif; ?>
	    <div class="container">
	      <div class="pull-left">
	        <a class="main-logo" href="/">DAMN MAGAZINE - <?php bloginfo('name'); ?></a>
	        <span class="issue-number" style="color: <?=$issue_color?>"><?=$issue_number?></span>

	        <?php /* toggle selector for issues */ ?>
	        <ul id="issue-selector" class="nav navbar-nav">
	          <li id="" class="dropdown">
	            <a title="Select An Issue" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">
	              <i class="fa fa-chevron-up"></i>
	              <i class="fa fa-chevron-down"></i>
	            </a>
	            <ul class="dropdown-menu">

	              <?php
	                $tax = 'magazine';
	                $tax_args = array(
	                  'orderby' => 'ID',
	                  'order' => 'DESC'
	                );
	                $magazines = get_terms( $tax, $tax_args );
	                foreach($magazines as $magazine) {
	                  $issue_color = get_field('issue_color', $magazine->taxonomy.'_'.$magazine->term_id);
	                  echo '<li style="background-color: ' . $issue_color . '"><a href="?issue=' . $magazine->slug . '" title="">'. $magazine->name .'</a></li>';
	                }
	              ?>

	            </ul>
	          </li>
	        </ul>

	      </div>

	      <?php /* mobile menu toggle */ ?>
	      <a class="mobile-menu no-badge normal-menu" data-count="0" href="#my-menu">
	        <i class="fa fa-bars"></i>
	      </a>

	      <div class="pull-right social-navs">
	        <?php
	        if (has_nav_menu('header_socials')) :
	          wp_nav_menu(['theme_location' => 'header_socials', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'social-nav navbar-nav']);
	        endif;
	        ?>
	      </div>
	    </div>
	  </div>

	  <div class="white-wrapper">
	    <div class="container">
	      <nav class="collapse navbar-collapse main-navigation" role="navigation">
	        <?php
	        if (has_nav_menu('primary_navigation')) :
	          wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav', ]);
	        endif;
	        ?>
	        <?php
	        if (has_nav_menu('header_socials')) :
	          wp_nav_menu(['theme_location' => 'header_socials', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'social-nav navbar-nav']);
	        endif;
	        ?>
	      </nav>
	    </div>
	  </div>

	  <?php /* leave this here, it activates the sticky nav */ ?>
	  <div class="fixed-nav-activator clearthis"></div>
	</header>

	<div id="search-bar" class="collapse">
	  <div class="container">
	    <?php get_template_part('templates/snippet-search-form'); ?>
	  </div>
	</div>
	<?php /* end actual header/navigation */ ?>


	<?php /* header title items, for areas where the title displays */ ?>
	<?php if(is_single() || (is_front_page()) || (is_author())) { ?>
	  <?php /* dont display title wrapper if is single */ ?>
	<?php } else { ?>
	  <?php /* or else display title wrapper and show archive title based on if its a post type, category, taxonomy, or page */ ?>
	  <div class="title-wrapper">

	    <?php if(is_author()) { ?>
	      <?php /* show nothing, the author name is in archive.php under if_author, it loads the author profile */ ?>
	    <?php } elseif(is_archive()) { ?>
	      <h1 class="archive-title">
	        <?php the_archive_title(); ?>
	      </h1>
	      <?php
	        the_archive_description( '<div class="taxonomy-description">', '</div>' );
	      ?>
	    <?php } elseif(is_page()) { ?>
	      <h1 class="page-title" itemprop="headline">
	        <?php the_title(); ?>
	      </h1>
	    <?php } elseif(is_search()) { ?>
	      <?php get_template_part('templates/page', 'header'); ?>
	    <?php } else { ?>
	    <?php } ?>
	  </div>
	<?php } ?>

</div>
