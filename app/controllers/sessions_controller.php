<?php
// include parent class ApplicationController
require_once 'application_controller.php';

class SessionsController extends ApplicationController
{
  private $view_directory = 'sessions';

  function new()
  {
    $page_info = [
      'page_layout' => 'dashboard',
      'page_title' => 'Log In',
    ];
    $this->render($this->view_directory, 'new', $page_info);
  }

  function create()
  {
  }

  function delete()
  {
  }
}
