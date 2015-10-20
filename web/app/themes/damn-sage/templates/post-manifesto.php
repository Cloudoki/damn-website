<?php
/**
 *	Calendar item
 *	Visualise image, date(s) and title.
 */

// Variables
$thumb = has_post_thumbnail ()? wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ): null;
?>

<article class="item-manifesto col-md-12">
	<a href="<?=the_permalink()?>" rel="bookmark" title="<?=the_title_attribute()?>">
	
	<?php if($thumb): ?>
			
		<div class="row">
			<div class="col-md-8">
			
				<h1>
					<span class="description">Manifesto /</span>
					<?=the_title()?>
				</h1>
				<h3><?=the_field('sub-title')?></h3>
			
				<?=the_excerpt()?>
		
			</div>
			<div class="col-md-4 post-image" style="background-image:url(<?=$thumb['0']?>);">
				
			</div>
		</div>

	<?php else: ?>
		
		<h1>
			<span class="description">Manifesto /</span>
			<?=the_title()?>
		</h1>
		<h3><?=the_field('sub-title')?></h3>
	
		<?=the_excerpt()?>

	<?php endif; ?>

	</a>
</article>