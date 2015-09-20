<?php
	// Retreiving parameters from header template
	global $issue, $issue_color, $issue_number;
?>

<?php /* actual header nav items.. below is the title wrapper, if it needs to show */ ?>
<?php get_template_part('templates/snippet', 'header-nav-items'); ?>


<?php /* header title items, for areas where the title displays */ ?>

<?php if(is_single() || (is_front_page())) { ?>
  <?php /* dont display title wrapper if is single */ ?>
<?php } else { ?>
  <?php /* or else display title wrapper and show archive title based on if its a post type, category, taxonomy, or page */ ?>
  <div class="title-wrapper">
    <?php if(is_archive()) { ?>
      <h1 class="archive-title">
        <?php the_archive_title(); ?>
      </h1>
      <?php
        the_archive_description( '<div class="taxonomy-description">', '</div>' );
      ?>
    <?php } elseif(is_page()) { ?>
      <h1 class="page-title" itemprop="headline">
        <?php the_title(); ?>
      </h1>
    <?php } elseif(is_search()) { ?>
      <?php get_template_part('templates/page', 'header'); ?>
    <?php } ?>
  </div>
<?php } ?>