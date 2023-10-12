<?php
// include parent class ApplicationRecord
require_once 'application_record.php';

class User extends ApplicationRecord
{
  public $id;
  public $email;
  public $password;
  public $password_confirmation;

  function __construct($email = null, $password = null, $password_confirmation = null)
  {
    $this->email = $email;
    $this->password = $password;
    $this->password_confirmation = $password_confirmation;
  }
}
