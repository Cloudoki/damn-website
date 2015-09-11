<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Config\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a class="more-link" href="' . get_permalink() . '">' . __('More', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


function custom_excerpt_length($length) {
    if(in_category('damn-plus')) {  //For posts belonging to category IDs 4 and 40
        return 65; //return 65 words for the excerpt
    } else {
        return 10; //for all others, return 40 words.
    }
}
add_filter( 'excerpt_length', __NAMESPACE__ . '\\custom_excerpt_length', 999 );


/**
 *  DAMn Customised
 *  All action & hook functionalities - add them here for clear overview.
 */

// add_action ('pre_get_posts', array('Roots\DAMn', 'filter_home'));




/*********************
* MIKE'S CUSTOM      *
*********************/

// Mike's function to modify the main/homepage query object to display 6 posts, not the default in "reading" settings

function mike_modify_main_query( $query ) {
  if ( $query->is_home() && $query->is_main_query() ) { // Run only on the homepage
  $query->query_vars['posts_per_page'] = 1; // Show only 6 posts on the homepage only
  }
}
// Hook my above function to the pre_get_posts action
// add_action( 'pre_get_posts', __NAMESPACE__ . '\\mike_modify_main_query' );

// modify normal archive to show 18 items per page

// function mike_modify_normal_archive_query( $query ) {
//   if ( $query->is_archive()) { // Run only on archive pages, but not custom post types
//   $query->query_vars['posts_per_page'] = 18; // Show only 15 posts per page
//   }
// }
// // Hook my above function to the pre_get_posts action
// add_action( 'pre_get_posts', __NAMESPACE__ . '\\mike_modify_normal_archive_query' );


// modify calendar posts to show 12 items per page

function mike_modify_calendar_archive_query( $query ) {
  if ( $query->is_post_type_archive('calendar') && is_archive()) { // Run only on archive pages, but not custom post types
  $query->query_vars['posts_per_page'] = 12; // Show only 15 posts per page
  }
}
// Hook my above function to the pre_get_posts action
add_action( 'pre_get_posts', __NAMESPACE__ . '\\mike_modify_calendar_archive_query' );


// modify magazine taxonomy posts to show 16 items per page

function mike_modify_magazine_query( $query ) {
  if ( $query->is_tax('magazine') ) { // Run only on magazine taxonomy archive
  $query->query_vars['posts_per_page'] = 18; // Show only 15 posts per page
  }
}

// Hook my above function to the pre_get_posts action
add_action( 'pre_get_posts', __NAMESPACE__ . '\\mike_modify_magazine_query' );

// removed "category:" or "archives:" etc from showing automatically in the archive title

add_filter( 'get_the_archive_title', function ($title) {
  if ( is_category() ) {
    $title = single_cat_title( '', false );
  // } elseif ( is_tag() ) {
  //   $title = single_tag_title( '', false );
  // } elseif ( is_author() ) {
  //   $title = '<span class="vcard">' . get_the_author() . '</span>' ;
  } elseif ( is_post_type_archive() ) {
    $title = post_type_archive_title( '', false );
  }
  return $title;
});

function add_slug_class_wp_list_categories($list) {

    $cats = get_categories('hide_empty=0');
    foreach($cats as $cat) {
        $find = 'cat-item-' . $cat->term_id . '"';
        $replace = 'cat-item-' . $cat->slug . ' cat-item-' . $cat->term_id . '"';
        $list = str_replace( $find, $replace, $list );
        $find = 'cat-item-' . $cat->term_id . ' ';
        $replace = 'cat-item-' . $cat->slug . ' cat-item-' . $cat->term_id . ' ';
        $list = str_replace( $find, $replace, $list );
    }

    return $list;
}
add_filter('wp_list_categories', __NAMESPACE__ . '\\add_slug_class_wp_list_categories');



/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)

function sage_page_navi() {
  global $wp_query;
  $big = 999999999; // need an unlikely integer
  $pages = paginate_links( array(
  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
  'format' => '?paged=%#%',
  'current' => max( 1, get_query_var('paged') ),
  'total' => $wp_query->max_num_pages,
  'prev_next' => false,
  'type'  => 'array',
  'prev_next'   => TRUE,
  'prev_text'    => '&larr;',
  'next_text'    => '&rarr;',
  ) );
  if( is_array( $pages ) ) {
    $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
    echo '<ul class="pagination pagination-lg">';
    foreach ( $pages as $page ) {
      echo "<li>$page</li>";
    }
    echo '</ul>';
  }
}/* end page navi */
add_filter('sage_page_navi', __NAMESPACE__ . '\\sage_page_navi');

