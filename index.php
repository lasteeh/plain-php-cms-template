<?php

// initialize dependencies
require_once 'config.php';
require_once 'routes.php';
require_once 'utilities/utilities.php';

// for debugging (delete on polish)
echo nl2br(PHP_EOL .  'index.php running');

// get controller and action
$route_data = matchRoutesAndCollectData(HTTP_METHOD, SERVER_REQUEST_URI, ROUTES);
$controller_name = isset($route_data['controller']['name']) ? $route_data['controller']['name'] : 'pages';
$controller_action = isset($route_data['controller']['action']) ? $route_data['controller']['action'] : 'not_found';
$route_parameter = isset($route_data['route_parameter']) ? $route_data['route_parameter'] : null;


echo nl2br(PHP_EOL . 'controllername: ' . $controller_name .  ' | controlleraction: ' . $controller_action);

// reference: https://medium.com/@iamjoestack/how-to-build-a-custom-php-mvc-framework-e5a23da8f73d
// reference: https://lancecourse.com/en/howto/how-to-start-your-own-php-mvc-framework-in-4-steps
// reference: https://kinsta.com/wp-content/uploads/2017/12/wordpress-admin-dashboard-2.jpeg