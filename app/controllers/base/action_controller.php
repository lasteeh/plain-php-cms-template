<?php
// define the base ActionController

class ActionController
{
  const PARTIALS_DIRECTORY = 'app/views/partials';
  const LAYOUTS_DIRECTORY = 'app/views/layouts';

  private $model;

  function __construct($model =  null)
  {
    $this->model = $model;
  }


  function render($controller_name, $action, $page_info = [])
  {
    $view_file = "app/views/{$controller_name}/{$action}.php";

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