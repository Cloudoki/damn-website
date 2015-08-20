<?php // Other Articles, All Categories - Widget
class blog_Widget extends WP_Widget {
  function blog_Widget() {
    $widget_ops = array( 'classname' => 'latest-articles', 'description' => 'List of latest articles across all categories' );
    $this->WP_Widget( 'latest_articles', 'Latest Articles', $widget_ops );
  }

  function widget( $args, $instance ) {
    extract( $args, EXTR_SKIP );
    echo $before_widget;
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
    if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };

    global $post;
    $args=array(
      'posts_per_page'=> $instance['posts_number'], // Number of related posts that will be shown.
      'post_type' => 'post',
      'post__not_in' => array($post->ID),
    );
    $my_query = new wp_query( $args );
    if( $my_query->have_posts() ) {
      echo '<ol class="latest-articles-list">';
      while( $my_query->have_posts() ) {
        $my_query->the_post(); ?>
        <li>
          <?php if ( has_post_thumbnail()) { ?>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="list-thumb"><?php the_post_thumbnail('thumbnail'); ?></a>
          <?php } else { ?>
           <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="list-thumb">
            <img src="<?= get_template_directory_uri(); ?>/dist/images/default-thumb.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>"/>
           </a>
          <?php } ?>
          <div class="list-meta">
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
            <span><?php the_category(' '); ?></span>
          </div>
          <div class="clearthis"></div>
        </li>
      <?php }
      echo '</ul>';
    }
    wp_reset_query();
    echo $after_widget;
  }


  /** @see WP_Widget::update */
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['posts_number'] = strip_tags($new_instance['posts_number']);
    return $instance;
  }

  /** @see WP_Widget::form */
  function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 'title'    => 'Latest', 'posts_number'  => '6' ));
    $title = strip_tags($instance['title']);
    $posts_number = strip_tags($instance['posts_number']);
    ?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>">Widget Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('posts_number'); ?>">Number of Items: <input class="widefat" id="<?php echo $this->get_field_id('posts_number'); ?>" name="<?php echo $this->get_field_name('posts_number'); ?>" type="text" value="<?php echo esc_attr($posts_number); ?>" /></label></p>
    <?php
  }
}
// register widget
add_action( 'widgets_init', create_function( '', "register_widget('blog_Widget');" ) );