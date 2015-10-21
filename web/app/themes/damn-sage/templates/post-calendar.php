<?php
/**
 *	Calendar item
 *	Visualise image, date(s) and title.
 */

// Variables
$thumb = has_post_thumbnail ()? wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ): [null];
$start = get_field('start_date')? strtotime (get_field ('start_date')): (int) get_the_date ('U');
$end = get_field('end_date')? strtotime (get_field ('end_date')): null;

?>

<article class="item col-xs-6 col-sm-4 col-md-2">
	
	<a href="<?=the_permalink()?>" rel="bookmark" title="<?=the_title_attribute()?>">
		<div class="header-circle"<?=isset ($thumb['0'])? ' style="background-image:url(' . $thumb['0'] . ');"': null?>>
			<div>
				<span class="month"><?=date("M", $start);?></span>
				<span class="day"><?=date("j", $start);?></span>
			</div>
		</div>

		<h1><?=the_title()?></h1>
		<h3><?=get_field('sub-title')?: get_the_excerpt()?></h3>
	</a>
	
	<hr>
	
	<?php if($end): ?>
	<span class='end-date'>Until <?=date("M jS", $end)?></span>
	<?php endif; ?>
	
	<div class="category-link pull-right<?=$end? " half-span":null?>">
	<?php foreach (get_the_category() as $cat): ?>
		<a href="<?=get_category_link($cat->term_id)?>" class="<?=$cat->slug?>"><?=$cat->cat_name?></a>
	<?php endforeach; ?>
	</div>

</article>