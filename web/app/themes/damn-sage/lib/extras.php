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
  if ( has_post_format( 'quote' )) {
    return '';
  } else {
    return ' &hellip; <a class="more-link" href="' . get_permalink() . '">' . __('More', 'sage') . '</a>';
  }
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


function custom_excerpt_length($length) {
    if(in_category('damn-plus') && is_single()) {
        return 120; //return 65 words for the excerpt
    } elseif(is_single()) {
        return 50;
    } else {
      return 25;
    }
}
add_filter( 'excerpt_length', __NAMESPACE__ . '\\custom_excerpt_length', 999 );


// make links and emails clickable
// add_filter('the_content', 'make_clickable');


//Page Slug Body Class

function add_slug_body_class( $classes ) {
global $post;
if ( isset( $post ) ) {
$classes[] = $post->post_type . '-' . $post->post_name;
}
return $classes;
}
add_filter( 'body_class', __NAMESPACE__ . '\\add_slug_body_class' );

/**
 *  DAMN Customised
 *  All action & hook functionalities - add them here for clear overview.
 */

// add_action ('pre_get_posts', array('Roots\DAMN', 'filter_home'));


function db_filter_authors_search( $posts_search ) {
  // Don't modify the query at all if we're not on the search template
  // or if the LIKE is empty
  if ( !is_search() || empty( $posts_search ) )
    return $posts_search;
  global $wpdb;
  // Get all of the users of the blog and see if the search query matches either
  // the display name or the user login
  add_filter( 'pre_user_query', __NAMESPACE__ . '\\db_filter_user_query' );
  $search = sanitize_text_field( get_query_var( 's' ) );
  $args = array(
    'count_total' => false,
    'search' => sprintf( '*%s*', $search ),
    'search_fields' => array(
      'display_name',
      'user_login',
    ),
    'fields' => 'ID',
  );
  $matching_users = get_users( $args );
  remove_filter( 'pre_user_query', __NAMESPACE__ . '\\db_filter_user_query' );
  // Don't modify the query if there aren't any matching users
  if ( empty( $matching_users ) )
    return $posts_search;
  // Take a slightly different approach than core where we want all of the posts from these authors
  $posts_search = str_replace( ')))', ")) OR ( {$wpdb->posts}.post_author IN (" . implode( ',', array_map( 'absint', $matching_users ) ) . ")))", $posts_search );
  return $posts_search;
}
/**
 * Modify get_users() to search display_name instead of user_nicename
 */
function db_filter_user_query( &$user_query ) {
  if ( is_object( $user_query ) )
    $user_query->query_where = str_replace( "user_nicename LIKE", "display_name LIKE", $user_query->query_where );
  return $user_query;
}
add_filter( 'posts_search', __NAMESPACE__ . '\\db_filter_authors_search' );


/*********************
* MIKE'S CUSTOM      *
*********************/

// Mike's function to modify the main/homepage query object to display 6 posts, not the default in "reading" settings

function mike_modify_main_query( $query ) {
  if ( $query->is_home() && $query->is_main_query() ) { // Run only on the homepage
  $query->query_vars['posts_per_page'] = 1; // Show only 6 posts on the homepage only
  }
}


// modify calendar posts to show 12 items per page

function mike_modify_calendar_archive_query( $query ) {
  if ( $query->is_post_type_archive('calendar') && is_archive()) { // Run only on archive pages, but not custom post types
    $query->query_vars['posts_per_page'] = 12; // Show only 15 posts per page
    $query->query_vars['meta_key'] = '_thumbnail_id'; // hide if no post thumbnail
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


// make sure calendar and productivity have post_tag registered

register_taxonomy_for_object_type( 'post_tag', 'calendar' );
register_taxonomy_for_object_type( 'post_tag', 'productivity' );


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


// return to homepage after logout

add_action('wp_logout', __NAMESPACE__ . '\\go_home');
function go_home(){
  wp_redirect( home_url() );
  exit();
}

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

