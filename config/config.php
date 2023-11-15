<?php

// for debugging (delete on polish)
// echo nl2br(PHP_EOL .  'config.php initiated');

// set the root directory of the app
define('ROOT_DIR', str_replace('\config', '', __DIR__));
// set the location of the index.php file in the server
define('INDEX_PATH', str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']));
// set the base url of the app
define('ROOT_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . INDEX_PATH);

// site configuration
define('SITE_NAME', 'A Plain PHP CMS Template');

// db configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'plain-php-cms-template');
define('DB_USER', 'plain-php-cms-template');
define('DB_PASSWORD', 'password');
