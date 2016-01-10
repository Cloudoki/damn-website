<?php

// Hack for Alcantara
if (function_exists('adrotate_group')) $banner =  adrotate_group(1);

$coloring = strpos ($banner, 'Alcantara')? '#A6A064': '#ddd';
	
?>

<div class="item col-xs-12 col-sm-4 advert advert-premium here">
	<div class="news-item">
		<div class="post-image" style="background-color: <?=$coloring?> !important;">
		
			<?=$banner?>
		
		</div>
	</div>
</div>