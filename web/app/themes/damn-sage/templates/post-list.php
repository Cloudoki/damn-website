<?php global $issue_number;
/**
 *	Article Item
 *	Visualise image, title, subtitle and excerpt.
 */

// Variables
$thumb = has_post_thumbnail ()? wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ): null;
?>

<a href="<?=the_permalink()?>" rel="bookmark" title="<?=the_title_attribute()?>">
	<article class="col-md-12">
		
		<div class="post-image" style="background-image:url(<?=$thumb['0']?>);"><div>+</div></div>
		
		<h1>
			<?php the_title()?>
		</h1>
		<h3>
			<?php the_field('sub-title')?>
		</h3>
		<author>
			By <?php the_author(); ?>
		</author>
		
		
	</article>
</a>