<?php
// include parent class ApplicationRecord
require_once 'application_record.php';

class User extends ApplicationRecord
{
  protected function validations()
  {

    return [
      'email' => [
        'presence' => true,
        'uniqueness' => true,
      ],
      'password' => [
        'presence' => true,
        'length' => [
          'minimum' => 8,
        ],
        'confirmation' => true,
      ],
      'password_confirmation' => [
        'presence' => true,
      ],
    ];
  }

  protected function before_save()
  {
    return [
      'hash_password',
    ];
  }

  public function register($user_params)
  {
    $this->attributes = $user_params;

    if ($this->save()) {
      return [$this, null];
    } else {
      $error_messages = $this->errors;
      return [$this, $error_messages];
    }
  }

  public function login($login_params)
  {
    $user = $this->find_by_email($login_params['email']);

    if ($user) {
      if (password_verify($login_params['password'], $user['password'])) {
        $_SESSION['user_id'] = $user['id'];

        return [$user, null];
      } else {
        return [null, ['invalid password']];
      }
    } else {
      return [null, ['invalid email']];
    }
  }

  protected function hash_password()
  {
    $this->attributes['password'] = password_hash($this->attributes['password'], PASSWORD_BCRYPT);
  }

  public function find_by_email($email)
  {
    $record = $this->find_by('email', $email);

    return $record;
  }
}
