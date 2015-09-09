<footer class="content-info" role="contentinfo">
  <div class="container">
    <div class="advert footer-advert">
      <?php if (function_exists('adrotate_group')) echo adrotate_group(2); ?>
    </div>
  </div>

  <div class="footer-wrap">
    <div class="container">
      <div class="row logo-buttons">
        <div class="col-xs-12 col-sm-6">
          <a class="main-logo" href="/">DAMn MAGAZINE - <?php bloginfo('name'); ?></a>
        </div>
        <div class="col-xs-12 col-sm-6 text-right">
          <div class="btn-toolbar pull-right" role="toolbar">
            <div class="btn-group">
              <button type="button" class="btn btn-whitestroke btn-xl btn-noRadius">
                <a href="/subscribe" title="Join The Mailing List">Join The Mailing List</a>
              </button>
            </div>

            <div class="btn-group pull-right">
              <button type="button" class="btn btn-whitestroke btn-xl btn-noRadius">
                <a href="/back-issues" title="DAMN Magazine - Back Issues">Back Issues</a>
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="row row-links">
        <div class="col-xs-6 col-sm-12 col-md-3">
          <h4>About Damn</h4>
          <?php the_field('about_damn', 'option'); ?>
        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-xs-6 col-sm-4 col-md-3">
          <h4>Information</h4>
          <?php
          if (has_nav_menu('footer_navigation')) :
            wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'footer-nav list-unstyled']);
          endif;
          ?>
        </div>

        <div class="col-xs-6 col-sm-4 col-md-3">
          <h4>Socials</h4>
          <?php
          if (has_nav_menu('footer_socials')) :
            wp_nav_menu(['theme_location' => 'footer_socials', 'menu_class' => 'footer-nav list-unstyled']);
          endif;
          ?>
        </div>

        <div class="col-xs-6 col-sm-4 col-md-3">
          <h4>Colophon</h4>
          <?php
          if (has_nav_menu('colophon')) :
            wp_nav_menu(['theme_location' => 'colophon', 'menu_class' => 'footer-nav list-unstyled']);
          endif;
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 text-center">
          <p class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
        </div>
      </div>

    </div>
  </div>
</footer>
