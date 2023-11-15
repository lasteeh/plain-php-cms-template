<?php

require_once 'app/helpers/application_helper.php';

class App
{
  public static $ROOT_DIR;
  public static $INDEX_PATH;
  public static $ROOT_URL;
  public static $SERVER_REQUEST_URI;

  protected $router;
  protected $route_data;

  public function __construct()
  {
    self::$ROOT_DIR = str_replace('\config', '', __DIR__);
    self::$INDEX_PATH = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
    self::$ROOT_URL = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . self::$INDEX_PATH;

    self::$SERVER_REQUEST_URI = $this->create_custom_server_request_URI(self::$ROOT_URL, $_SERVER['REQUEST_URI']);

    define('ROOT_DIR', self::$ROOT_DIR);
    define('INDEX_PATH', self::$INDEX_PATH);
    define('ROOT_URL', self::$ROOT_URL);
    define('SERVER_REQUEST_URI', self::$SERVER_REQUEST_URI);
  }

  public function run()
  {
    $this->router($_SERVER['REQUEST_METHOD'], SERVER_REQUEST_URI, ROUTES);
  }

  private function router($server_http_method, $server_request_uri, $configured_routes)
  {
    $route_data = $this->get_route_data($server_http_method, $server_request_uri, $configured_routes);
    $this->handle_route($route_data);
  }

  private function handle_route($route_data)
  {
    $controller_name = ucfirst($route_data['controller']['name'] ?? 'Application') . 'Controller';
    $controller_action = $route_data['controller']['action'] ?? 'not_found';
    $route_parameter = $route_data['route_parameter'] ?? null;


    $controller_file_name = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $controller_name));
    $controller_file = "app/controllers/{$controller_file_name}.php";

    $this->load_controller($controller_file, $controller_name, $controller_action);
  }

  private function load_controller($controller_file, $controller_name, $controller_action)
  {
    if (file_exists($controller_file)) {
      require_once $controller_file;

      $controller = new $controller_name;

      if (method_exists($controller, $controller_action)) {
        if ($controller_name !== 'SessionsController') {
          if ($controller_action !== 'not_found') {
            $controller->authenticate_request();
          }
        }
        $controller->$controller_action();
      } else {
        echo "{$controller_name} {$controller_action}() not found";
      }
    } else {
      echo "{$controller_name} not found.";
    }
  }

  private function get_route_data($server_http_method, $server_request_uri, $configured_routes)
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
            'route_parameter' => $matches[1] ?? null,
          ];
        }
      }
    }
  }

  private function create_custom_server_request_URI($root_url, $server_request_uri)
  {
    // remove the scheme (http/https) and host part from the domain
    $domain_parts = parse_url($root_url);
    $domain_path = $domain_parts['path'] ?? '';

    $request_uri = $server_request_uri;

    // check if the request_uri starts with the domain path
    if (strpos($request_uri, $domain_path) === 0) {
      // remove the matching part from the request_uri
      $request_uri = substr($request_uri, strlen($domain_path));
    }

    // return the modified request_uri
    return $request_uri;
  }
}
