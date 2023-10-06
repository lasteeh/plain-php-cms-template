<?php

// for debugging (delete on polish)
echo nl2br(PHP_EOL .  'utilities.php initiated');


// create a custom $_SERVER['REQUEST_URI']
function createCustomServerRequestURI($root_url, $server_request_uri)
{
  // remove the scheme (http/https) and host part from the domain
  $domain_parts = parse_url($root_url);
  $domain_path = isset($domain_parts['path']) ? $domain_parts['path'] : '';

  $request_uri = $server_request_uri;

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
define('SERVER_REQUEST_URI', createCustomServerRequestURI(ROOT_URL, $_SERVER['REQUEST_URI']));


// determine which controller, action, and parameters are needed depending on the URI
function matchRoutesAndCollectData($server_http_method, $server_request_uri, $configured_routes)
{
  foreach ($configured_routes as $route => $methods) {
    foreach ($methods as $http_method => $routeinfo) {

      // create a regular expression pattern to match the route.
      $pattern = str_replace('/', '\/', $route);
      $pattern = '#^' . preg_replace('/:([^\s\/]+)/', '([^\/]+)', $pattern) . '$#';

      // check if the current request URI matches the route pattern
      // and if the HTTP method matches the specified method.
      if (preg_match($pattern, $server_request_uri, $matches) && $server_http_method === $http_method) {

        // split the controller and action from the route information.
        list($controller_name, $controller_action) = explode('@', $routeinfo['controller']);

        return [
          'route' => $route,
          'http_method' => $http_method,
          'controller' => [
            'name' => $controller_name,
            'action' => $controller_action,
          ],
          'route_parameter' => isset($matches[1]) ? $matches[1] : null,
        ];
      }
    }
  }
}
