<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title; ?></title>
  <link rel="stylesheet" href="<?php echo ROOT_URL ?>/public/assets/stylesheets/application.css">
  <link rel="stylesheet" href="<?php echo ROOT_URL ?>/public/assets/stylesheets/main.css">
  <link rel="stylesheet" href="<?php echo ROOT_URL ?>/public/assets/stylesheets/main_header.css">
  <link rel="stylesheet" href="<?php echo ROOT_URL ?>/public/assets/stylesheets/main_footer.css">
</head>

<body>
  <?php include($header_file); ?>

  <main class="<?php echo isset($main_class) ? $main_class : ''; ?>">
    <?php include($view_file); ?>
  </main>

  <?php include($footer_file); ?>

</body>

</html>