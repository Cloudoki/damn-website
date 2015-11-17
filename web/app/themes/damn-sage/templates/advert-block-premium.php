<?php

// Hack for Alcantara
if (function_exists('adrotate_group')) $banner =  adrotate_group(1);

$coloring = strpos ($banner, 'Alcantara')? ' style="background-color: #A6A064;"': null;
	
?>

<div class="item col-xs-12 col-sm-4 advert advert-premium"<?=$coloring?>>
	<div class="news-item">
		<div class="post-image">
		
			<?=$banner?>
		
		</div>
	</div>
</div>