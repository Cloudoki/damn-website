<?php
$tax = 'magazine';
$tax_args = array(
  'orderby' => 'ID',
  'order' => 'DESC',
  'number' => 1
);
$magazines = get_terms( $tax, $tax_args );
foreach($magazines as $magazine) {
  $editions = new WP_Query(array(
    'taxonomy'=>'magazine',
    'term' => $magazine->slug
  ));
  $link = get_term_link(intval($magazine->term_id),'magazine');
  $image_url = get_template_directory_uri();
  $magazineimage = wp_get_attachment_image_src(get_field('magazine_taxonomy_image', $magazine->taxonomy.'_'.$magazine->term_id), 'full');
  echo "<div class='news-item-wrapper'>";
    echo "<div class='news-item whiteBackground marginBottom'>";
      echo '<div class="post-image bordered-image noMargin">';
        echo "<a href=\"{$link}\" title='{$magazine->name}'>";
          echo '<img src="'.$magazineimage[0].'" alt="'.$magazine->name.'" class="placeholder" />';
        echo "</a>";
      echo "</div>";
    echo "</div>";
  echo "</div>";
  echo "<p class='noMargin'>";
  echo "<h3><strong><a href=\"{$link}\" title='{$magazine->name}'>{$magazine->name}</a></strong></h3>";
  echo "</p>";
}
?>