<?php if (is_search()) { ?>
<header style="position: absolute !important;">
<?php } else { ?>
<header>
<?php } ?>
  <?php get_template_part('templates/snippet', 'category-link'); ?>

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

