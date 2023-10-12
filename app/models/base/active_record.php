<?php
require_once './db/database.php';

class ActiveRecord
{
  private $db;
  private $table;
  protected $attributes = [];
  protected $validations = [];
  protected $errors = [];


  public function __construct($model_object = [])
  {
    $this->db = new Database();
    $this->table = strtolower(get_class($this)) . 's';
    $this->attributes = $model_object;
    $this->validations = $this->validations();
  }


  // TODO: Fix SQL INSERT QUERY!!!
  public function save()
  {
    if (empty($this->attributes)) {
      echo 'empty attributes';
      return false;
    }

    if ($this->validate()) {
      // build the SQL query
      $sql = "INSERT INTO {$this->table} (";
      $values = "VALUES (";

      $param_values = [];

      foreach ($this->attributes as $key => $value) {
        if ($key !== 'password_confirmation') {
          $sql .= $key . ', ';
          $values .= ":$key, ";
          $param_values[":$key"] = $value;
        }
      }

      // remove the trailing commas and spaces
      $sql = rtrim($sql, ', ') . ')';
      $values = rtrim($values, ', ') . ')';

      $sql .= $values;

      try {
        // prepare and execute the query with dynamic parameters
        $stmt = $this->db->getPDO()->prepare($sql);

        // bind parameters using the parameter values
        foreach ($param_values as $key => $value) {
          $stmt->bindParam($key, $value);
        }

        $result = $stmt->execute();

        return $result;
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    } else {
      echo 'validation failed';
      return false;
    }
  }

  public function find($id)
  {
    // build a SQL query to retrieve a record by its primary key
    $sql = "SELECT * FROM {$this->table} WHERE id = :id";

    // prepare and execute the query
    $stmt = $this->db->getPDO()->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // fetch the record as an associative array
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    return $record;
  }

  protected function validations()
  {
    return [];
  }

  private function validate()
  {
    $errors = [];

    foreach ($this->validations as $field => $rules) {
      foreach ($rules as $rule => $value) {
        if ($rule === 'presence' && $value === true) {
          if (empty($this->attributes[$field])) {
            $errors[] = "{$field} can't be blank.";
          }
        }

        if ($rule === 'uniqueness' && $value === true) {
          //
        }

        if ($rule === 'length' && isset($value['minimum'])) {
          if (strlen($this->attributes[$field]) < $value['minimum']) {
            $errors[] = "{$field} is too short (minimum length: " . $value['minimum'] . " characters).";
          }
        }

        if ($rule === 'confirmation' && $value === true) {
          $confirmation_field = "{$field}_confirmation";
          if ($this->attributes[$field] !== $this->attributes[$confirmation_field]) {
            $errors[] = "{$field} and {$confirmation_field} do not match.";
          }
        }
      }
    }

    if (empty($errors)) {
      return true;
    } else {
      $this->errors = $errors;
      return false;
    }
  }
}
