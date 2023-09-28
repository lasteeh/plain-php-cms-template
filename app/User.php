<?php

namespace App\Models;

class User
{
  protected $id;
  protected $email;
  protected $password;
  protected $created_at;
  protected $updated_at;

  // get methods
  public function getId()
  {
    return $this->id;
  }
  public function getEmail()
  {
    return $this->email;
  }
  public function getPassword()
  {
    return $this->password;
  }
  public function getCreatedAt()
  {
    return $this->created_at;
  }
  public function getUpdatedAt()
  {
    return $this->updated_at;
  }

  // set methods
  public function setId()
  {
    return $this->id;
  }
  public function setEmail()
  {
    return $this->email;
  }
  public function setPassword()
  {
    return $this->password;
  }
  public function setCreatedAt()
  {
    return $this->created_at;
  }
  public function setUpdatedAt()
  {
    return $this->updated_at;
  }

  // crud operations
  public function create(array $data)
  {
  }

  public function read(int $id)
  {
  }

  public function update(int $id, array $data)
  {
  }

  public function delete(int $id)
  {
  }
}
