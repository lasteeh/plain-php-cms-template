<?php

session_start();

// initialize dependencies
require_once 'config/config.php';
require_once 'config/routes.php';

// initialize App
require_once 'config/application.php';
$app = new App;
$app->run();


// for debugging. remove on polish
var_dump($_SESSION);

// reference: https://medium.com/@iamjoestack/how-to-build-a-custom-php-mvc-framework-e5a23da8f73d
// reference: https://lancecourse.com/en/howto/how-to-start-your-own-php-mvc-framework-in-4-steps
// reference: https://kinsta.com/wp-content/uploads/2017/12/wordpress-admin-dashboard-2.jpeg

// TODO:
// 1. create image/s uploads
// 2. create album creation
// 3. create page management
// 4. create html page builder
// 5. build sqlbuilder
// 6. build router & request models