<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/utils.php',                 // Utility functions
  'lib/init.php',                  // Initial theme setup and constants
  'lib/wrapper.php',               // Theme wrapper class
  'lib/conditional-tag-check.php', // ConditionalTagCheck class
  'lib/config.php',                // Configuration
  'lib/assets.php',                // Scripts and stylesheets
  'lib/titles.php',                // Page titles
  'lib/extras.php',                // Custom functions
  'lib/widgets.php',               // Custom widgets
  'lib/wp_bootstrap_navwalker.php', // Bringing back Bootstrap dropdown menu to the main nav
//'lib/damn.php'					// DAMN customisations
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

/**
 *	DAMN 
 *	Magazine specific functions
 *	Issues, Ads, Brands
 */
class DAMN {
	
	/**
	 *	Current Issue
	 *	Can be global, or item related
	 */
	public $issue;
	
	/**
	 *	Latest Issue
	 *	Should always be defined
	 */
	public $latest_issue;
	
	/**
	 *	Is Latest
	 *	Is issue the latest?
	 */
	public $latest;
	
	/**
	 *	Single View Issue
	 *	Does the single view have an Issue connected
	 */
	public $issued;
	
	/**
	 *	Single Template
	 *	Does the single view have a template
	 */
	public $template;
	
	/**
	 *	Issue Contrast
	 *	Positive or Negative issue
	 */
	public $contrast;
	
	/**
	 *	DAMN
	 *	The Class Constructor
	 */
	public function __construct ()
	{
		# Post Issue
		$this->issued = is_single () && ($terms = get_the_terms (get_the_ID (), 'magazine'))? 
			
			array_shift ($terms): 
			null;
		
		# Latest Issue
		$this->latest_issue = get_field ('current_issue', 'option');
		
		if(!$this->latest_issue)
		
			throw new Exception('No current issue is set, please contact the DAMN° Moderator.');
		
		# Current Issue
		$this->issue = $this->issued? : $this->filterIssue ($_GET['issue']);
		
		$this->expandIssue ();
		
		# Latest
		$this->latest = $DAMN->latest_issue->term_id == $DAMN->issue->term_id;
		
		# Template
		$this->template = is_single()? 
			
			get_post_meta (get_the_ID (), '_template_slug', true): 
			null;
			
		# Contrast
		$this->contrast = (int) get_field ('colour_scheme', $this->issue->acf_id);
	}
	
	/**
	 *	Issue
	 *	Filter issue
	 */
	public function filterIssue ($slug)
	{
		if ($slug)
			$issue = get_term_by ('slug', preg_replace ("/[^A-Za-z0-9-]/", '', $slug), 'magazine');
		
		return $issue? : $this->latest_issue;	
	}
	
	/**
	 *	Issue
	 *	Expand Issue
	 */
	public function expandIssue ()
	{
		# afc id
		$this->issue->acf_id	= 'magazine_' . $this->issue->term_id;
		
		$this->issue->link		= get_term_link ($this->issue->term_id, 'magazine');
		$this->issue->color		= get_field ('issue_color', $this->issue->acf_id);
		$this->issue->number	= get_field ('magazine_number', $this->issue->acf_id);
		
		$id = get_field ('magazine_taxonomy_image', $this->issue->acf_id);
		$this->issue->thumbnail	= $id? array_shift (wp_get_attachment_image_src ($id, 'small')): null;
	}
	
	/**
	 *	Related Filters
	 */
	 
	/**
	 *	Related Posts
	 *	Topical relation, with advertorial
	 */
	public function relatedPosts ($limit, $_single, $categories = null, $tags = null, $exclude = [])
	{
		wp_reset_query();
		
		# Filters
		$args = [];
		$base_args = [
			'posts_per_page' => $limit == -1? $limit: $limit * 2,
			'post_type'		 => 'post',
			'date_query'	 => [
				[
					'column' => 'post_date',
					'after'  => '2 year ago',
				]
			],
			'orderby'		 => 'rand'
		];
		
		# Tags
		if($tags) $args['tag__in'] = $this->filterIds ($tags);
		
		# Categories
		else if($categories) $args['category__in'] = $this->filterIds ($categories);
		
		# pre-parse excludes
		if(count ($exclude)) $exclude = $this->filterIds ($exclude);
		
		# In "the post"
		if($_single) $exclude[] = $_single->ID;
		
		# Excludes
		if(count ($exclude)) $args['post__not_in'] = $exclude;
		
		//print_r(array_merge ($base_args, $args));
		//exit ();
		
		$list = get_posts (array_merge ($base_args, $args));
		
		# Output limit
		if ($limit != -1 && count ($list) > $limit)
			
			$list = array_slice ($list, 0, $limit);
			
		# Fill to limit
		else if (count ($list) < $limit && $_single)
		{	
			$base_args['posts_per_page'] = $limit - count ($list);
			$base_args['post__not_in']	 = array_merge ($this->filterIds ($list), $exclude);
			$base_args[ 'author']		 = $_single->post_author;
			
			$list = array_merge ($list, get_posts ($base_args));
		}
		
		# Add partner content
		if($partnered = $this->partneredContent (1, 'post'))
		
			$list [rand (0,count($list)-1)] = $partnered;
		
		return $this->sugar ($list);
	}

	/**
	 *	Related Products
	 *	Topical relation, with partner product
	 */
	public function relatedProducts ($limit, $is_single, $categories = null, $tags = null, $exclude = null)
	{
		
	}
	
	/**
	 *	Related Calendar Nodes
	 *	Topical relation, currently running, with partner calendar
	 */
	public function relatedCalendars ($limit, $is_single, $categories = null, $tags = null, $exclude = null)
	{
	}
	
	/**
	 *	Partner Content
	 *	Advertorials or highlighted content
	 */
	public function partneredContent ($limit, $post_type, $categories = null, $tags = null, $exclude = null)
	{
		$date = date('Ymd');
		
		$args = [
			'posts_per_page' => $limit,
			'post_type'      => $post_type,
			'meta_query'	 => [
				'relation'		=> 'AND',
				[
					'key'		=> 'highlight_start_date',
					'compare'	=> '<=',
					'value'		=> $date,
				],
				[
					'key'		=> 'highlight_end_date',
					'compare'	=> '>=',
					'value'		=> $date,
				]
			]
		];
		
		return get_posts ($args);
	}
	
	/**
	 *	Return IDs
	 *	Like the title says
	 */
	 public function filterIds ($list)
	 {
		 return $list? 
		 	
		 	array_map (function ($item){ return $item->ID | $item->post_id | $item->term_id | $item->id; }, $list): 
		 	[];
	 }
	 
	 /**
	 *	Sugar Item
	 *	Add additional required data per post
	 */
	 public function sugar ($list)
	 {
		 return array_map (function ($item)
		 {
			$id = $item->ID | $item->post_id | $item->term_id | $item->id;
			
			# Sub-title
			$item->subtitle = get_field ('sub-title', $id);
			
			# Thumbnail
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id ($id), 'full');			
			$item->thumbnail = $thumbnail[0];
			
			# Issue
			if ($terms = get_the_terms ($id, 'magazine'))
			{
				$term = array_shift ($terms); 
				$item->issue = get_field ('magazine_number', 'magazine_' . $term->term_id);
			}
			
			return $item;
			 
		 }, $list);
	 }
}