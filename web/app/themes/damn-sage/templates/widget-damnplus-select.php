<?php
global $main_query;
	
$select_query = [
	'cat' => '4315',
	'posts_per_page' => 4,
	'post_type' => 'post',
	'orderby' => 'post_date',
	'order' => 'DESC',
	'post__not_in'=> $main_query['post__not_in']
];

$select = new WP_Query($select_query);

?>
<div class="widget row plus-select">
	<h3 class="widget-title">DAM<sub>N°</sub>+ Select</h3>
	<?php
	while ($select->have_posts())
	{
		$select->the_post();
		get_template_part('templates/post-list');  
	}
	?>
	
	<a href="/join-damn-plus">
		<article class="col-md-12">
			
			<div class="post-image no-hover-color"><div>+</div></div>
			
			<h1>
				Join DAM<sub>N°</sub>+
			</h1>
			<h3>
				Receive the latest news first, access all articles without restrictions.
			</h3>
		
		</article>
	</a>
</div>
