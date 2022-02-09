<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php $streamit_options = get_option('streamit_options'); ?>

  <?php
  if (!function_exists('has_site_icon') || !wp_site_icon()) {
    if (!empty($streamit_options['streamit_fevicon'])) { ?>
      <link rel="shortcut icon" href="<?php echo esc_url($streamit_options['streamit_fevicon']['url']); ?>" />
  <?php
    }
  }
  ?>
  <script type="text/javascript">
    <?php
    if (!empty($streamit_options['streamit_js_code'])) {
      echo wp_specialchars_decode($streamit_options['streamit_js_code']);
    }
    ?>
  </script>
  <?php wp_head(); ?>
</head>

<body data-spy="scroll" data-offset="80">

  <div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html__('Skip to content', 'streamit'); ?></a>

    <div class="site-content-contain">
      <div id="content" class="site-content">