<!doctype html>
<html data-type="event" class="no-js" <?php language_attributes(); ?>>

<?php
global $DAMN;

/**
 *	Single Post
 *	Use the DAMN Constructor
 */
 
$DAMN = new DAMN ();

# Issue numbers
/*$latest_number = (int) !$DAMN->latest? 
	
	get_field ('magazine_number', 'magazine_' . $DAMN->latest_issue->term_id):
	$DAMN->issue->number;*/
	
# Template required data
$parameters = (object)[
	'background'	=> [
		'image' => get_field ('background_image'),
		'color' => get_field ('background_color'),
	],
	'image' 	 => get_field ('image'),
	'issue'		 => $DAMN->issue,
	'issued'	 => $DAMN->issued,
	'contrast'	 => get_field ('contrast'),
	'next_issue' => $DAMN->latest? null: $DAMN->issue->number +1,
	'prev_issue' => $DAMN->issue->number > $latest_number-10? $DAMN->issue->number -1: null,
	'history'	 => range ($latest_number, $latest_number-10),
	'theme_path' => get_template_directory_uri(),
	'navigation' => wp_nav_menu (
	[
		'menu' => 'Minimal Nav', 
		'echo' => false
	]),
	
	// To update: should be issued release date
	'date'			=> get_the_date ("F o")
];

$template_path = 'advertorial/';

# Template smarts
$parameters->template = $template_path . '.default';


# The Post
$parameters->post = get_post();

# Tags
if ( get_the_tags() ){
	$parameters->tags = get_the_tags ();
}

# Categories
if ( get_the_category( get_the_ID() ) ){
	$parameters->categories = get_the_category (get_the_ID());
}

# Agenda
if (get_field ('calnode')  ){
	$parameters->calnode = get_field ('calnode');
	$parameters->calnode->subtitle = get_field ('subtitle', $parameters->calnode->ID);
	$parameters->calnode->start = get_field ('start_date', $parameters->calnode->ID);
	$parameters->calnode->start_day = date ('d', strtotime ($parameters->calnode->start));
	$parameters->calnode->start_month = date ('M', strtotime ($parameters->calnode->start));
	$parameters->calnode->end = get_field ('end_date', $parameters->calnode->ID);
	$parameters->calnode->url = get_post_permalink ($parameters->calnode->ID);
}



# Brand
if( get_field ('brand') ){
	$parameters->brand = get_field ('brand');
	$parameters->brand->logo = get_field ('logo', $parameters->brand->ID);
	$parameters->brand->link = get_field ('link', $parameters->brand->ID);
	$parameters->brand->acfid = 'brand_' . $parameters->brand->ID;
}


#Highlight
$highlights = ($highlight = get_field ('highlight'))? $DAMN->sugar ([$highlight]): [];

# Listed Posts
$posts[0] = $DAMN->relatedPosts (-1, $parameters->post, null, $parameters->tags, $highlights?: null);
$posts[1] = $DAMN->relatedPosts (13 - count ($posts[0]) - count ($highlights), false, $parameters->categories, null, array_merge ($highlights, $posts[0]));

$parameters->posts = array_merge ($highlights, $posts[0], $posts[1]);

# Classes
$classes = get_field ('class')?: null;

if ($parameters->contrast) $classes .= ' positive-contrast';

# Load Head
get_template_part('templates/head'); 

?>

	<body <?php body_class ($classes); ?>>	
	
<?php

	/**
	 *	Code is Poetry.
	 */
	$Wustache = new Cloudoki\Wustache\Publication ();
	echo $Wustache->template_content ($parameters, 'cpt/event');
	
	// Handled comfortably by Wustache.
	
				
	// Get some more
	do_action('get_footer');
	get_template_part('templates/footer');
	wp_footer();
?>

	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-565b1d483536298e" async="async"></script>
	
	</body>
</html>
