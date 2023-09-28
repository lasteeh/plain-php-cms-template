<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>User</h1>
  <ul>
    <li>ID: <?php echo $product->getId(); ?></li>
    <li>Email: <?php echo $product->getEmail(); ?></li>
    <li>Password: <?php echo $product->getPassword(); ?></li>
    <li>Created At: <?php echo $product->getCreatedAt(); ?></li>
    <li>Updated At: <?php echo $product->getUpdatedAt(); ?></li>
  </ul>
  <a href="<?php echo $routes->get('homepage')->getPath(); ?>">Back to Home</a>
</body>

</html>