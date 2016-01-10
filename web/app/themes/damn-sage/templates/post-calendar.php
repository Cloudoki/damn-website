<?php
/**
 *	Calendar item
 *	Visualise image, date(s) and title.
 */

// Variables
$thumb = has_post_thumbnail ()? wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ): [null];
$start = get_field('start_date')? strtotime (get_field ('start_date')): null;

if($start && $start < time()) $start = null;
?>

<article class="item col-xs-6 col-sm-4 col-md-2">
	
	<a href="<?=the_permalink()?>" rel="bookmark" title="<?=the_title_attribute()?>">
		<div class="header-circle"<?=isset ($thumb['0'])? ' style="background-image:url(' . $thumb['0'] . ');"': null?>>
			<div>
			<?php if ($start): ?>
				<span class="month"><?=date("M", $start);?></span>
				<span class="day"><?=date("j", $start);?></span>
			<?php else: ?>
				<span class="running"><i class="ion-ios-calendar-outline"></i></span>
			<?php endif; ?>
			</div>
		</div>

		<h1><?=the_title()?></h1>
		<h3><?=get_field('sub-title')?: get_the_excerpt()?></h3>
	</a>
	
	<div class="agenda-share">
		<a href="http://twitter.com/share?url=<?=the_permalink()?>" target="_blank"><i class='ion-social-twitter'></i></a>
		<a href="http://www.facebook.com/sharer.php?u=<?=the_permalink()?>" target="_blank"><i class='ion-social-facebook'></i></a>
		<a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" target="_blank"><i class='ion-social-pinterest'></i></a>
		<a href="http://www.tumblr.com/share/link?<?=the_permalink()?>" target="_blank"><i class='ion-social-tumblr'></i></a>
	</div>
	
</article>