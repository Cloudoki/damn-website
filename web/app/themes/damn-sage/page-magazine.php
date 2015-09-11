<?php
/*
Template Name: Magazine taxonomy
*/
?>

<?php
$tax = 'magazine';
$tax_args = array(
  'orderby' => 'ID',
  'order' => 'DESC'
);
$magazines = get_terms( $tax, $tax_args );
foreach($magazines as $magazine) {
  $editions = new WP_Query(array(
    'post_per_page'=>-1,
    'taxonomy'=>'magazine',
    'term' => $magazine->slug
  ));
  $link = get_term_link(intval($magazine->term_id),'magazine');
  $image_url = get_template_directory_uri();
  $magazineimage = wp_get_attachment_image_src(get_field('magazine_taxonomy_image', $magazine->taxonomy.'_'.$magazine->term_id), 'full');
  echo "<div class='news-item-wrapper col-xs-4 col-sm-4 col-md-3'>";
    echo "<div class='news-item'>";
      echo '<div class="post-image" style="background-image:url('.$magazineimage[0].');">';
        echo "<a href=\"{$link}\" title='{$magazine->name}'>";
          echo '<img src="'.$image_url.'/dist/images/blank-image-magazine.gif" alt="'.$magazine->name.'" class="placeholder" />';
        echo "</a>";
      echo "</div>";
      echo "<header>";
        echo "<h2 class='entry-title'><a href=\"{$link}\" title='{$magazine->name}'>{$magazine->name}</a></h2>";
      echo "</header>";
    echo "</div>";
  echo "</div>";
}
?>