<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php if (is_singular( 'magazine' )) { ?>
  <?php get_template_part('templates/content-magazines', get_post_type()); ?>
<?php } else { ?>
  <?php get_template_part('templates/content-single', get_post_type()); ?>
<?php } ?>
