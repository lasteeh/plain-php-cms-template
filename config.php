<?php

// for debugging (delete on polish)
// echo nl2br(PHP_EOL .  'config.php initiated');

// set the root directory of the app
define('ROOT_PATH', __DIR__);
// set the location of the index.php file in the server
define('INDEX_PATH', str_replace('/index.php', '', $_SERVER['PHP_SELF']));
// capture the HTTP method being requested
define('HTTP_METHOD', $_SERVER['REQUEST_METHOD']);
// set the base url of the app
define('ROOT_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . INDEX_PATH);

// site configuration
define('SITE_NAME', 'A Plain PHP CMS Template');

// db configuration
