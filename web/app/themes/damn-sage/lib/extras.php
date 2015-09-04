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
  return ' &hellip; <a href="' . get_permalink() . '">' . __('More', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


function custom_excerpt_length( $length ) {
  return 10;
}
add_filter( 'excerpt_length', __NAMESPACE__ . '\\custom_excerpt_length', 999 );

/*********************
* MIKE'S CUSTOM      *
*********************/

// Mike's function to modify the main/homepage query object to display 6 posts, not the default in "reading" settings

function mike_modify_main_query( $query ) {
  if ( $query->is_home() && $query->is_main_query() ) { // Run only on the homepage
  $query->query_vars['posts_per_page'] = 6; // Show only 6 posts on the homepage only
  }
}
// Hook my above function to the pre_get_posts action
add_action( 'pre_get_posts', __NAMESPACE__ . '\\mike_modify_main_query' );


// Mike's function to modify the archive query object to display 15 posts

// function mike_modify_archive_query( $query ) {
//   if ( $query->is_archive() ) { // Run only on archive pages, but not custom post types
//   $query->query_vars['posts_per_page'] = 15; // Show only 15 posts per page
//   }
// }
// // Hook my above function to the pre_get_posts action
// add_action( 'pre_get_posts', __NAMESPACE__ . '\\mike_modify_archive_query' );


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
    echo '<ul class="pagination">';
    foreach ( $pages as $page ) {
      echo "<li>$page</li>";
    }
    echo '</ul>';
  }
}/* end page navi */
add_filter('sage_page_navi', __NAMESPACE__ . '\\sage_page_navi');

