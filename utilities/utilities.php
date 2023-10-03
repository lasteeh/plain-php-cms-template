<?php

// for debugging (delete on polish)
echo nl2br(PHP_EOL .  'utilities.php initiated');


// create a custom $_SERVER['REQUEST_URI']
function createCustomServerRequestURI()
{
  // remove the scheme (http/https) and host part from the domain
  $domain_parts = parse_url(ROOT_URL);
  $domain_path = isset($domain_parts['path']) ? $domain_parts['path'] : '';

  $request_uri = $_SERVER['REQUEST_URI'];

  // check if the request_uri starts with the domain path
  if (strpos($request_uri, $domain_path) === 0) {
    // remove the matching part from the request_uri
    $request_uri = substr($request_uri, strlen($domain_path));
  }

  // return the modified request_uri
  return $request_uri;
}

// put the newly created custom server request uri in a more consistent variable format
// make it immutable
// and make it globally accessible
define('SERVER_REQUEST_URI', createCustomServerRequestURI());
