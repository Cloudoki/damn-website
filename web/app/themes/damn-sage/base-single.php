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

    <?php /* news image & meta */ ?>

    <?php if (is_singular('calendar')) { ?>
    <?php } else { ?>
      <?php get_template_part('templates/single-header'); ?>
    <?php } ?>

    <div class="wrap" role="document">
      <div class="content single-content container">

        <?php if (Config\display_sidebar()) : ?>
          <aside class="sidebar visible-sm-block visible-md-block visible-lg-block" role="complementary">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>

        <main class="main" role="main">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->

        <?php if (Config\display_sidebar()) : ?>
          <aside class="sidebar visible-xs-block" role="complementary">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>

        <div class="clearfix"></div>
      </div><!-- /.content -->

      <?php if (is_singular( 'magazines' )) { ?>
      <?php } else { ?>
        <?php /* Back Issues */ ?>
        <?php get_template_part('templates/back issues'); ?>
      <?php } ?>

      <div class="clearthis"></div>
    </div><!-- /.wrap -->

    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
