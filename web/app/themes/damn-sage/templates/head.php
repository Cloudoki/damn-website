<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="<?= get_template_directory_uri(); ?>/dist/images/apple-touch-icon.png">
  <link rel="icon" href="<?= get_template_directory_uri(); ?>/dist/images/favicon.png">


  <?php /*
    global $issue;
    $issue_acf_id = 'magazine_' . $issue->term_id;
    $headerimage = get_field ('header_image', $issue_acf_id);
  ?>

  <?php if (is_home() || is_archive()) : ?>
    <?php if($headerimage) { ?>
      <meta property="og:image" content="<?=$headerimage?>" />
    <?php } ?>
  <?php endif; */ ?>


  <?php /* OG IMAGE TAG */ ?>
  <?php if (is_home() || is_archive()) : ?>
    <meta property="og:image" content="<?= get_template_directory_uri(); ?>/dist/images/damn-ogtag.png" />
  <?php endif; ?>

  <?php wp_head(); ?>

  <!-- fonts / typekit -->
  <script src="https://use.typekit.net/iir2zjt.js"></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>

</head>



