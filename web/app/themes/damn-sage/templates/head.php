<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>

  <!-- fonts / typekit -->
  <script src="https://use.typekit.net/iir2zjt.js"></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>

  <?php /*-- style all colors based on issue # color --*/ ?>
  <style type="text/css" media="screen">
    a, a:visited, #menu-main-nav a span {
      color: #<?php the_field('issue_number_color', 'option'); ?>;
    }
    .btn-default {
      background-color: #<?php the_field('issue_number_color', 'option'); ?>;
      color: #fff !important;
    }
    .btn:hover {
      background-color: inherit;
    }
  </style>
</head>
