<?php
// include parent class ApplicationController
require_once 'application_controller.php';

// require User model
require_once './app/models/user.php';

class SessionsController extends ApplicationController
{
  function new()
  {
    $page_info = [
      'page_layout' => 'dashboard',
      'page_title' => 'Log In',
    ];
    $this->render($this->view_directory, 'new', $page_info);
  }

  // function create()
  // {
  // }

  // function delete()
  // {
  // }
}
