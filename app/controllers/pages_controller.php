<?php
// include parent class ApplicationController
require_once 'application_controller.php';

class PagesController extends ApplicationController
{
  private $view_directory = 'pages';

  function index()
  {
    $meta_data = [
      'page_title' => 'Home Page',
    ];
    $this->render($this->view_directory, 'index', $meta_data);
  }

  function not_found()
  {
    $meta_data = [
      'page_title' => 'Page Not Found',
    ];
    $this->render($this->view_directory, 'not_found', $meta_data);
  }
}
