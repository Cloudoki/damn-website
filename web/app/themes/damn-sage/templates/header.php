<?php
	// This file assumes that you have included the nav walker from https://github.com/twittem/wp-bootstrap-navwalker
	// somewhere in your theme.
	
	// Identifier between issue- and event-based header will be placed here
?>

<?php if (is_home()): ?>

	<?php get_template_part('templates/header', 'magazine'); // or 'event' ?>
	
<?php else: ?>
	
	<div class="home-feature">
		<?php get_template_part('templates/snippet', 'header-nav'); ?>
	</div>

<?php endif; ?>