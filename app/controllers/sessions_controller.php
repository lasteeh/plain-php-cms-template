<?php
// include parent class ApplicationController
require_once 'application_controller.php';

// require User model
require_once './app/models/user.php';

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
    // Check if the required POST fields are set
    if (isset($_POST['email']) && isset($_POST['password'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $user = (new User)->find('1');
      var_dump($user);
    }
  }

  function delete()
  {
  }
}
