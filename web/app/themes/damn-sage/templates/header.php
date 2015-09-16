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

	 throw new Exception('No current issue is set, please contact the DAMn° Moderator.');

// Some dry data
$issue_acf_id = 'magazine_' . $issue->term_id;
$issue_color = get_field ('issue_color', $issue_acf_id);
$issue_number = get_field ('magazine_number', $issue_acf_id);
?>

<?php /*-- style all colors based on issue # color --*/ ?>
<style type="text/css" media="screen">
	a, a:visited, #menu-main-nav a span, a.mobile-menu .fa {
		color: <?=$issue_color?>;
	}
	.btn-default, .btn-primary, body.damn-plus .title-wrapper, body.category-damn-plus .title-wrapper, body.login .main h3.widget-title, .back-to-calendar a.btn-primary {
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


<?php if (is_home()): ?>

	<?php get_template_part('templates/header', 'magazine'); // or 'event' ?>

<?php else: ?>

	<div class="home-feature">
		<?php get_template_part('templates/snippet', 'header-nav'); ?>
	</div>

<?php endif; ?>