<?php the_content(); ?>

<?php if ( is_page('search') ) { ?>
  <div class="search-large">
   <?php get_search_form(); ?>
  </div>
<?php } ?>

<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
