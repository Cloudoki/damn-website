<?php /* Begin actual header/navigation */ 
	global $issue_color, $issue_number;
?>


<header class="banner navbar navbar-default navbar-static-top" role="banner">
  <div class="header-wrapper">
    <div class="container">
      <a class="main-logo" href="/">DAMn MAGAZINE - <?php bloginfo('name'); ?></a>
      <span class="issue-number" style="color: <?=$issue_color?>"><?=$issue_number?></span>
      <div class="pull-right social-navs">
        <?php
        if (has_nav_menu('header_socials')) :
          wp_nav_menu(['theme_location' => 'header_socials', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'social-nav navbar-nav']);
        endif;
        ?>
      </div>
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