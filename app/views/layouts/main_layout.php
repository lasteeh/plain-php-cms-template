<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title; ?></title>
  <link rel="stylesheet" href="<?php echo ROOT_URL ?>/public/assets/stylesheets/application.css">
  <link rel="stylesheet" href="<?php echo ROOT_URL ?>/public/assets/stylesheets/header.css">
  <link rel="stylesheet" href="<?php echo ROOT_URL ?>/public/assets/stylesheets/footer.css">
</head>

<body>
  <?php include($header_file); ?>

  <?php include($view_file); ?>

  <?php include($footer_file); ?>

</body>

</html>