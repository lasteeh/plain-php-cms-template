<?php

// Calculate the base URL dynamically
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$base_url = $protocol . $_SERVER['HTTP_HOST'] . str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);


// Get the requested URL, removing the base URL
$request_url = str_replace($base_url, '', $_SERVER['REQUEST_URI']);

echo nl2br($protocol . PHP_EOL);
echo nl2br($base_url . PHP_EOL);
echo nl2br($request_url . PHP_EOL);
