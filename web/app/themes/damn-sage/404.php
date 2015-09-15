<div class="fourohfour text-center">
  <h2>404</h2>
   <div class="alert alert-warning">
    <?php _e('Sorry, but the page you were trying to view does not exist.', 'sage'); ?>
  </div>

  <div class="search-large">
    <form role="search" method="get" class="search-form form-inline" action="<?= esc_url(home_url('/')); ?>">
      <label class="sr-only"><?php _e('Search for:', 'sage'); ?></label>
      <div class="input-group input-group-lg">
        <input type="search" value="<?= get_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php _e('Search', 'sage'); ?> <?php bloginfo('name'); ?>" required>
        <span class="input-group-btn">
          <button type="submit" class="search-submit btn btn-default"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>

  </div>

</div>