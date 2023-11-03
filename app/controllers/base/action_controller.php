<?php
// define the base ActionController

class ActionController
{
  const PARTIALS_DIRECTORY = 'app/views/partials';
  const LAYOUTS_DIRECTORY = 'app/views/layouts';

  protected $view_directory;

  public function __construct()
  {
    // set the view sub directory of the controller
    $this->view_directory = strtolower(str_replace('Controller', '', get_class($this)));
  }

  public function render($page_info = [])
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
      if (isset($page_info['main_class'])) {
        $main_class = $page_info['main_class'];
      }

      include  $layout_file;
    } else {
      echo "{$view_file} not found.";
    }
  }

  public function redirect($url)
  {
    header("Location:" . ROOT_URL . "{$url}");
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

  public function dashboard()
  {
    $page_info = [
      'page_layout' => 'dashboard',
      'page_title' => 'Dashboard',
    ];
    $this->render($page_info);
  }

  public function index()
  {
    $page_info = [
      'page_title' => 'Home Page',
    ];
    $this->render($page_info);
  }
  public function not_found()
  {
    $page_info = [
      'page_title' => 'Page Not Found',
    ];
    $this->render($page_info);
  }
}
