<?php
	// This file assumes that you have included the nav walker from https://github.com/twittem/wp-bootstrap-navwalker
	// somewhere in your theme.
	
	// Identifier between issue- and event-based header will be placed here
?>

<?php if (is_home()): ?>

	<?php get_template_part('templates/header', 'magazine'); // or 'event' ?>
	
<?php else: ?>
	
	<?php	
	// Big Fat !Hack!
	// non-dry data from templates/header-magazine
	// Until decided on non-home header
	global $issue, $issue_color, $issue_number;
	
	$issue = $_GET['issue']?
	
		get_term_by('slug', preg_replace ("/[^A-Za-z0-9-]/", '', $_GET['issue']), 'magazine'):
		get_field ('current_issue', 'option');
	
	
	if (!$issue) $issue = get_field ('current_issue', 'option');
	if (!$issue)
	
		 throw new Exception('No current issue is set, please contact the DAMn° Moderator.');
	
	// Some dry data
	$issue_acf_id = 'magazine_' . $issue->term_id;
	$issue_color = get_field ('issue_color', $issue_acf_id);
	$issue_number = get_field ('magazine_number', $issue_acf_id);
	?>
	
	
	<div class="home-feature">
		<?php get_template_part('templates/snippet', 'header-nav'); ?>
	</div>

<?php endif; ?>