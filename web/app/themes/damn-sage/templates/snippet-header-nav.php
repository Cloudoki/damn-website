<?php /* Begin actual header/navigation */ ?>
<header class="banner navbar navbar-default navbar-static-top" role="banner">
  <div class="header-wrapper">
    <div class="container">
      <a class="main-logo" href="/">DAMn MAGAZINE - <?php bloginfo('name'); ?></a>
      <span class="issue-number" style="color: #<?php the_field('issue_number_color', 'option'); ?>"><?php the_field('issue_number', 'option'); ?></span>
    </div>
  </div>

  <div class="white-wrapper">
    <div class="container">
      <div class="navbar-header page-scroll">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <nav class="collapse navbar-collapse main-navigation" role="navigation">
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav']);
        endif;
        ?>
        <?php
        if (has_nav_menu('header_socials')) :
          wp_nav_menu(['theme_location' => 'header_socials', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'social-nav navbar-nav']);
        endif;
        ?>
      </nav>
    </div>
  </div>

  <?php /* leave this here, it activates the sticky nav */ ?>
  <div class="fixed-nav-activator clearthis"></div>
</header>
<?php /* end actual header/navigation */ ?>

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