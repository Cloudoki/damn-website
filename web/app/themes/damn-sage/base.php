<?php
use Roots\Sage\Config;
use Roots\Sage\Wrapper;
?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>

    <div class="wrap" role="document">
      <?php if (is_tax( 'magazine' ) || is_page()) { ?>
        <?php /* container enforces max-width */ ?>
        <div class="content container">
      <?php } else {?>

      <?php } ?>

        <?php if (is_page('back-issues') || is_page('search') || is_page('colophon') || is_page('colofon')) { ?>
        <?php } elseif (is_tax( 'magazine' ) || is_page()) { ?>
          <?php if (Config\display_sidebar()) : ?>
            <aside class="sidebar" role="complementary">
              <?php include Wrapper\sidebar_path(); ?>
            </aside><!-- /.sidebar -->
          <?php endif; ?>
        <?php } ?>

        <main class="main" role="main">
          <?php if (is_page('search')) { ?>
            <div class="container">
              <?php include Wrapper\template_path(); ?>
            </div>
          <?php } elseif (is_tax( 'magazine' ) || is_page()) { ?>
            <?php include Wrapper\template_path(); ?>
          <?php } else {?>
            <div class="container">
              <?php include Wrapper\template_path(); ?>
            </div>
          <?php } ?>
        </main><!-- /.main -->
      </div><!-- /.content -->

      <?php /* Back Issues */ ?>
      <?php get_template_part('templates/back issues'); ?>

      <div class="clearthis"></div>
    </div><!-- /.wrap -->

    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
