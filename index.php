<?php

// initialize dependencies
require_once 'config.php';
require_once 'routes.php';
require_once 'utilities/utilities.php';

// for debugging (delete on polish)
// echo nl2br(PHP_EOL .  'index.php running');

// get controller and action
$route_data = matchRoutesAndCollectData(HTTP_METHOD, SERVER_REQUEST_URI, ROUTES);
$controller_name = ucfirst($route_data['controller']['name'] ?? 'Pages') . 'Controller';
$controller_action = $route_data['controller']['action'] ?? 'not_found';
$route_parameter = $route_data['route_parameter'] ?? null;


$controller_file_name = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $controller_name));
$controller_file = "app/controllers/{$controller_file_name}.php";

if (file_exists($controller_file)) {
  require_once $controller_file;

  $controller = new $controller_name;

  if (method_exists($controller, $controller_action)) {
    $controller->$controller_action();
  } else {
    echo "{$controller_name} {$controller_action}() not found";
  }
} else {
  echo "{$controller_name} not found.";
}


// reference: https://medium.com/@iamjoestack/how-to-build-a-custom-php-mvc-framework-e5a23da8f73d
// reference: https://lancecourse.com/en/howto/how-to-start-your-own-php-mvc-framework-in-4-steps
// reference: https://kinsta.com/wp-content/uploads/2017/12/wordpress-admin-dashboard-2.jpeg