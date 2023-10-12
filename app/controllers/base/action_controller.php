<?php
// define the base ActionController

class ActionController
{
  const PARTIALS_DIRECTORY = 'app/views/partials';
  const LAYOUTS_DIRECTORY = 'app/views/layouts';

  public $view_directory;

  function __construct()
  {
    // set the view sub directory of the controller
    $this->view_directory = strtolower(str_replace('Controller', '', get_class($this)));
  }

  function render($page_info = [])
  {
    // Use debug_backtrace() to get the calling function's name
    $backtrace = debug_backtrace();
    $callingFunction = $backtrace[1]['function'];
    $action = $callingFunction;

    $view_file = "app/views/{$this->view_directory}/{$action}.php";

    if (file_exists($view_file)) {

      $page_title = isset($page_info['page_title']) ? $page_info['page_title'] . ' | ' . SITE_NAME : SITE_NAME;
      $page_layout = isset($page_info['page_layout']) && $page_info['page_layout'] === 'dashboard' ? 'dashboard' : 'main';

      $layout_config = $this->getLayoutConfiguration($page_layout);
      $header_file = $layout_config['header'];
      $footer_file = $layout_config['footer'];

      $layout_file = self::LAYOUTS_DIRECTORY . "/{$page_layout}_layout.php";

      include  $layout_file;
    } else {
      echo "{$view_file} not found.";
    }
  }

  function redirect($url)
  {
    header("Location: {$url}");
    exit();
  }

  private function getLayoutConfiguration($page_layout)
  {
    $layouts = [
      'main' => [
        'header' => self::PARTIALS_DIRECTORY . "/main_header.php",
        'footer' => self::PARTIALS_DIRECTORY . "/main_footer.php",
      ],
      'dashboard' => [
        'header' => self::PARTIALS_DIRECTORY . "/dashboard_header.php",
        'footer' => self::PARTIALS_DIRECTORY . "/dashboard_footer.php",
      ],
    ];

    return $layouts[$page_layout];
  }
}
