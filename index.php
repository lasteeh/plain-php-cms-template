<?php

// initialize dependencies
require_once 'config.php';
require_once 'utilities/utilities.php';

// for debugging (delete on polish)
echo nl2br(PHP_EOL .  'index.php running');

echo nl2br(PHP_EOL . '<a href=' . ROOT_URL . '>home link</a>');
echo nl2br(PHP_EOL . '<a href=' . ROOT_URL . SERVER_REQUEST_URI . '>current link</a>');


echo nl2br(PHP_EOL . 'server request uri: ' . SERVER_REQUEST_URI);

// determine which controller to call depending on the uri
['requested_controller' => $controller, 'requested_action' => $action, 'requested_parameters' => $parameters] = REQUEST_URI;

echo nl2br(PHP_EOL . 'requested controller: ' . $controller . ' | type: ' . gettype($controller));
echo nl2br(PHP_EOL . 'requested action: ' . $action . ' | type: ' . gettype($action));
echo nl2br(PHP_EOL . 'requested parameters: ');
foreach ($parameters as $key => $value) {
  echo nl2br(PHP_EOL . $key . ': ' . $value . ' | type: ' . gettype($value));
}

if ($controller === '' || $controller === 'settings') {
  // these are the general pages,
  // initiate the page controller
  // and render the respective view

  echo nl2br(PHP_EOL . 'call PageController');
}



// foreach ($_SERVER as $key => $value) {
//   echo nl2br(PHP_EOL . $key . ': ' . $value);
// }


// reference: https://medium.com/@iamjoestack/how-to-build-a-custom-php-mvc-framework-e5a23da8f73d
// reference: https://lancecourse.com/en/howto/how-to-start-your-own-php-mvc-framework-in-4-steps
// reference: https://kinsta.com/wp-content/uploads/2017/12/wordpress-admin-dashboard-2.jpeg