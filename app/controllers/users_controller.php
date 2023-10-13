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
    $this->render($page_info);
  }

  function create()
  {
    $user_params = $this->user_params($_POST);
    $user = new User;
    list($user, $error_messages) = $user->register($user_params);

    if ($error_messages) {
      var_dump($error_messages);
    } else {
      $this->redirect('/login');
    }
  }

  private function user_params($user_input)
  {
    $permitted_fields = ['email', 'password', 'password_confirmation'];
    $user_params = [];

    foreach ($permitted_fields as $field) {
      if (isset($user_input[$field])) {
        $user_params[$field] = $user_input[$field];
      }
    }

    return $user_params;
  }
}
