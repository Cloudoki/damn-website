<?php

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
$contrast = (int) get_field ('colour_scheme', $issue_acf_id);
$issue_color = get_field ('issue_color', $issue_acf_id);
$issue_number = get_field ('magazine_number', $issue_acf_id);
$issue_link = get_term_link($issue->term_id, 'magazine');
$header_image = get_field ('header_image', $issue_acf_id);
$issue_cat = get_field ('primary_category', $issue_acf_id);
$header_highlight = get_field ('header_highlight', $issue_acf_id);
$header_subtitle = get_field ('header_subtitle', $issue_acf_id);

?>
	<?php /*-- style all colors based on issue # color --*/ ?>
	<style type="text/css" media="screen">
		a, a:visited, #menu-main-nav a span {
			color: <?=$issue_color?>;
		}
		.btn-default, .btn-primary, body.damn-plus .title-wrapper, body.category-damn-plus .title-wrapper, body.login .main h3.widget-title {
			background-color: <?=$issue_color?>;
			color: #fff !important;
		}
		.btn:hover {
			background-color: inherit;
		}
		.color-box, .damn-plus-badge, .join-damn-plus-home-image, .damn-plus-cta, .page-featured-image, .news-item-wrapper.damn-plus .news-item, .single-news-item {
			background-color: <?=$issue_color?>;
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

	<div class="home-feature<?=$contrast? ' black-text': null?>">
		<div class="single-news-item">

			<?php if ($header_image): ?>
			<div class="post-image">
				<a href="<?=$issue_link?>" rel="bookmark" title="<?=$header_highlight?>">
					<img src="<?=$header_image?>" alt="<?=$issue->name?>" />
				</a>
			</div>
			<?php endif; ?>

			<header>
				<div class="container">

					<?php if ($issue_cat): ?>
					<div class="category-link">
						<a href="<?=get_category_link($issue_cat->term_id)?>"  class="<?=$issue_cat->slug?>" title="View all posts in <?=$issue_cat->name?>"><?=$issue_cat->name?></a>
					</div>
					<? endif; ?>

					<h1 class="entry-title">
						<a href="<?=$issue_link?>" rel="bookmark" title="<?=$header_highlight?>"><?=$header_highlight?></a>
					</h1>
					<h3 class="subtitle"><?=$header_subtitle?></h3>

				</div>
			</header>
		</div>

		<?php get_template_part('templates/snippet', 'header-nav'); ?>
	</div>