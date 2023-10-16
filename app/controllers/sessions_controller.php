<?php
// include parent class ApplicationController
require_once 'application_controller.php';

class SessionsController extends ApplicationController
{
  function new()
  {
    $page_info = [
      'page_layout' => 'dashboard',
      'page_title' => 'Log In',
    ];
    $this->render($page_info);
  }

  function create()
  {
    $user_params = $this->login_params($_POST);
    $user = new User();

    list($user, $error_messages) = $user->login($user_params);

    if ($error_messages) {
      var_dump($error_messages);
    } else {
      $this->redirect('/dashboard');
    }
  }

  function delete()
  {
    session_unset();
    session_destroy();
    $this->redirect('/login');
  }

  private function login_params($user_input)
  {
    $permitted_fields = ['email', 'password'];
    $user_params = [];

    foreach ($permitted_fields as $field) {
      if (isset($user_input[$field])) {
        $user_params[$field] = $user_input[$field];
      }
    }

    return $user_params;
  }
}
