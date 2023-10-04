<?php

// initialize dependencies
require_once 'config.php';
require_once 'routes.php';
require_once 'utilities/utilities.php';

// for debugging (delete on polish)
echo nl2br(PHP_EOL .  'index.php running');

echo nl2br(PHP_EOL . '<a href=' . ROOT_URL . '>home link</a>');
echo nl2br(PHP_EOL . '<a href=' . ROOT_URL . SERVER_REQUEST_URI . '>current link</a>');
echo nl2br(PHP_EOL . '<form action=' . ROOT_URL . SERVER_REQUEST_URI . ' method="POST"><button type="submit">POST</button></form>');


echo nl2br(PHP_EOL . 'server request uri: ' . SERVER_REQUEST_URI);
echo nl2br(PHP_EOL . 'http method: ' . HTTP_METHOD);

// determine which controller, action, and parameters to call depending on the uri
foreach (ROUTES as $route => $methods) {
  foreach ($methods as $http_method => $routeinfo) {
    echo nl2br(PHP_EOL . 'ROUTE: ' . $route);
    echo nl2br(PHP_EOL . 'route info http method: ' . $http_method);

    $pattern = str_replace('/', '\/', $route);
    $pattern = '#^' . preg_replace('/:([^\s\/]+)/', '([^\/]+)', $pattern) . '$#';


    if (preg_match($pattern, SERVER_REQUEST_URI, $matches) && HTTP_METHOD === $http_method) {
      echo nl2br(PHP_EOL . ' - MATCH FOUNDDDDDDDDDD!!!');

      foreach ($matches as $key => $match) {
        echo nl2br(PHP_EOL . 'match' . $key . ': ' . $match);
      }

      list($controllername, $controlleraction) = explode('@', $routeinfo['controller']);

      echo nl2br(PHP_EOL . 'controllername: ' . $controllername .  ' | controlleraction: ' . $controlleraction);
    } else {
      echo nl2br(PHP_EOL . ' - doesnt match');
    }
  }
}

// reference: https://medium.com/@iamjoestack/how-to-build-a-custom-php-mvc-framework-e5a23da8f73d
// reference: https://lancecourse.com/en/howto/how-to-start-your-own-php-mvc-framework-in-4-steps
// reference: https://kinsta.com/wp-content/uploads/2017/12/wordpress-admin-dashboard-2.jpeg