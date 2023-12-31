<?php
$excludedURLs = ['/login', '/signup'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title; ?></title>
  <link rel="stylesheet" href="<?php echo ROOT_URL ?>/public/assets/stylesheets/application.css">
  <link rel="stylesheet" href="<?php echo ROOT_URL ?>/public/assets/stylesheets/dashboard.css">
  <link rel="stylesheet" href="<?php echo ROOT_URL ?>/public/assets/stylesheets/dashboard_header.css">
  <link rel="stylesheet" href="<?php echo ROOT_URL ?>/public/assets/stylesheets/dashboard_footer.css">
</head>

<body data-layout="dashboard">
  <?php
  if (!in_array(SERVER_REQUEST_URI, $excludedURLs)) {
    include($header_file);
  }
  ?>

  <aside>
    <nav>
      <ul>
        <li><?php get_link('/dashboard', 'Dashboard'); ?></li>
        <li><?php get_link('/images', 'Images'); ?></li>
        <li><?php get_link('/albums', 'Albums'); ?></li>
        <li class="mt-auto"><?php get_link('/logout', 'Log Out'); ?></li>
      </ul>
    </nav>
  </aside>

  <main class="<?php echo isset($main_class) ? $main_class : ''; ?>">
    <?php include($view_file); ?>
  </main>

  <?php
  if (!in_array(SERVER_REQUEST_URI, $excludedURLs)) {
    include($footer_file);
  }
  ?>
</body>

</html>