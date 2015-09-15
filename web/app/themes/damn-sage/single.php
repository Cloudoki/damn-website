<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php if (is_singular( 'magazines' )) { ?>
  <?php get_template_part('templates/content-single-magazines', get_post_type()); ?>
<?php } elseif (is_singular( 'calendar' )) { ?>
  <?php get_template_part('templates/content-single-calendar', get_post_type()); ?>
<?php } elseif (is_singular( 'product' )) { ?>
  <?php get_template_part('templates/content-single-product', get_post_type()); ?>
<?php } else { ?>
  <?php get_template_part('templates/content-single', get_post_type()); ?>
<?php } ?>

<?php /* Facebook Comments */ ?>
<?php comments_template('/templates/facebook-comments.php'); ?>

<?php if (is_singular( 'magazines' )) { ?>
<?php } else { ?>
  <?php /* Related Posts */ ?>
  <?php get_template_part('templates/related-posts'); ?>
<?php } ?>
