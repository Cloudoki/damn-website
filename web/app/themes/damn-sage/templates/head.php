<?php
	global $issue_image;
	$magazineimage = wp_get_attachment_image_src($issue_image, 'large');
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:image" content="<?=$magazineimage[0]?>" />
	
	<link rel="apple-touch-icon" href="<?= get_template_directory_uri(); ?>/dist/images/apple-touch-icon.png">
	<link rel="icon" href="<?= get_template_directory_uri(); ?>/dist/images/favicon.png">
	
	<?php wp_head(); ?>

</head>



