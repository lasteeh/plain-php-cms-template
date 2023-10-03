<?php

// for debugging (delete on polish)
echo nl2br(PHP_EOL .  'config.php initiated');

// set the root directory of the app
define('ROOT_PATH', __DIR__);
define('HTTP_METHOD', $_SERVER['REQUEST_METHOD']);
// set the location of the index.php file in the server
define('INDEX_PATH', str_replace('/index.php', '', $_SERVER['PHP_SELF']));

// site configuration
define('ROOT_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . INDEX_PATH);
define('SITE_NAME', 'A Plain PHP CMS Template');

// db configuration
