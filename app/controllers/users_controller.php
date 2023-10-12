<?php
// include parent class ApplicationController
require_once 'application_controller.php';

// require User model
require_once './app/models/user.php';

class UsersController extends ApplicationController
{
  function new()
  {
    $page_info = [
      'page_layout' => 'dashboard',
      'page_title' => 'Sign Up',
    ];
    $this->render($this->view_directory, 'new', $page_info);
  }

  function create()
  {
    $user = new User();
  }
}
