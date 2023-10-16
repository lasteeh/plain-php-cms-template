<?php
// include base ActionController
require_once 'base/action_controller.php';

// require User model
require_once './app/models/user.php';

class ApplicationController extends ActionController
{
  protected $pages_requiring_authentication = [
    '/images',
  ];

  protected function current_user()
  {
    if (isset($_SESSION['user_id'])) {
      $user  = new User();
      $current_user = $user->find($_SESSION['user_id']);

      return $current_user;
    } else {
      return null;
    }
  }

  public function authenticate_request()
  {
    if (!$this->current_user() && in_array(SERVER_REQUEST_URI, $this->pages_requiring_authentication)) {
      $this->redirect('/login');
    }
  }
}
