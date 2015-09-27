<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="<?= get_template_directory_uri(); ?>/dist/images/apple-touch-icon.png">
  <link rel="icon" href="<?= get_template_directory_uri(); ?>/dist/images/favicon.png">

  <?php if (is_home()): ?>
    <?php
    global $issue, $issue_color, $issue_number;

    $issue = $_GET['issue']?

      get_term_by('slug', preg_replace ("/[^A-Za-z0-9-]/", '', $_GET['issue']), 'magazine'):
      get_field ('current_issue', 'option');

    $issue_acf_id = 'magazine_' . $issue->term_id;
    $header_image = get_field ('header_image', $issue_acf_id);
    ?>

    <meta property="og:image" content="<?=$header_image?>" />
  <?php endif; ?>

  <?php wp_head(); ?>

  <!-- fonts / typekit -->
  <script src="https://use.typekit.net/iir2zjt.js"></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>

</head>



