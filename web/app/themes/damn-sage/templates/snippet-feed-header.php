<header>
  <div class="category-link">
    <?php
      $sep = '';
      foreach ((get_the_category()) as $cat) {
          echo $sep . '<a href="' . get_category_link($cat->term_id) . '"  class="' . $cat->slug . '" title="View all posts in '. esc_attr($cat->name) . '">' . $cat->cat_name . '</a>';
          $sep = '';
      }
  ?>
  </div>

  <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

  <?php /* dont show on single pages, this would be for the "related posts" area */ ?>
  <?php if (is_single() || is_tax( 'magazine' )) { ?>
  <?php } else { ?>
    <?php if(get_field('sub-title')) { ?>
      <h3 class="subtitle">
        <?php the_field('sub-title'); ?>
      </h3>
    <?php } else { ?>
      <h3 class="subtitle">
        <?php the_excerpt(); ?>
      </h3>
    <?php } ?>
  <?php } ?>
</header>

