<?php
// include parent class ApplicationController
require_once 'application_controller.php';

class PagesController extends ApplicationController
{
  function index()
  {
    $page_info = [
      'page_title' => 'Home Page',
    ];
    $this->render($page_info);
  }

  function not_found()
  {
    $page_info = [
      'page_title' => 'Page Not Found',
    ];
    $this->render($page_info);
  }
}
