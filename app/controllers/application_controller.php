<?php
// define parent controller class ApplicationController

class ApplicationController
{
  private $model;

  function __construct($model =  null)
  {
    $this->model = $model;
  }

  function render($controller_name, $action, $meta_data = [])
  {
    $partials_directory = 'app/views/partials';
    $header_file = "{$partials_directory}/header.php";
    $footer_file = "{$partials_directory}/footer.php";
    $layout = "app/views/layouts/main_layout.php";
    $view_file = "app/views/{$controller_name}/{$action}.php";

    if (file_exists($view_file)) {

      $page_title = isset($meta_data['page_title']) ? $meta_data['page_title'] . ' | ' . SITE_NAME : SITE_NAME;

      include $layout;
    } else {
      echo "{$view_file} not found.";
    }
  }
}
