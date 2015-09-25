<?php
/**
 *	Primary row
 *	Featured post and Premium Ad.
 */

if (has_post_thumbnail () && !has_post_format('quote'))
{
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
	$url = $thumb['0'];
}

$cats = [];

foreach(get_the_category() as $category)
	$cats[] = $category->slug;
?>

<div class="row">
	<div class="first-post-advert-wrapper">
		<div class="table-row">
			<div class="news-item-wrapper col-xs-12 col-sm-8 large-post <?=has_post_format('quote')? 'quote-format ':null?><?=implode (' ', $cats)?>"<?=isset ($url)? ' style="background-image:url(' . $url . ');"': null?>>

				<?php get_template_part('templates/snippet', has_post_format('quote')? 'item-post-quote': 'item-post'); ?>

			</div>

			<?php get_template_part('templates/advert-block-premium'); ?>

		</div>
	</div>
</div>