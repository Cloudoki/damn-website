<?php /* if video post format, center a big play icon */ if ( has_post_format( 'video' )) { ?>
  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="centerer">
  <i class="fa fa-play-circle-o play-video-icon fa-4x whitecolor"></i>
  </a>
<?php } ?>

<?php if (is_search()) { ?>
<header style="position: absolute !important;">
<?php } else { ?>
<header>
<?php } ?>

  <?php get_template_part('templates/snippet', 'category-link'); ?>

  <?php /* if video post format, show just title here */ if ( has_post_format( 'video' )) { ?>

    <h2 class="entry-title">
      <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
      </a>
    </h2>

  <?php } /* else all others are normal */ else { ?>

    <h2 class="entry-title">
      <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
        <?php /* if calendar post type, show calendar icon */ if ( get_post_type() == 'calendar' ){ ?>
          <!-- <i class="fa fa-calendar"></i> -->
        <?php } /* if video post format, show play icon */ elseif ( has_post_format( 'video' )) { ?>
          <i class="fa fa-play-circle-o play-video-icon"></i>
        <?php } ?>
        <?php the_title(); ?>
      </a>
    </h2>

    <?php /* dont show on single pages, this would be for the "related posts" area */ ?>
    <?php if (is_single()) { ?>
    <?php } elseif (is_tax( 'magazine' )) {?>
      <?php if(get_field('sub-title')) { ?>
        <h3 class="subtitle">
          <?php the_field('sub-title'); ?>
        </h3>
      <?php } ?>
    <?php } else { ?>

      <?php /* the title */ ?>

      <?php if(get_field('sub-title')) { ?>
        <h3 class="subtitle">
          <?php the_field('sub-title'); ?>
        </h3>

      <?php } else { ?>

      <?php /* the sub-title */ ?>

        <h3 class="subtitle">
          <?php the_excerpt(); ?>
        </h3>
      <?php } ?>

      <?php /* if calendar post type, show start/end date */ ?>

      <?php get_template_part('templates/snippet', 'start-end-date'); ?>

    <?php } ?>

  <?php } ?>



</header>


