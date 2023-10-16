<?php
require_once './db/database.php';

class ActiveRecord
{
  private $db;
  private $table;
  protected $attributes = [];
  protected $validations = [];
  protected $errors = [];
  protected $before_save = [];


  public function __construct($model_object = [])
  {
    $this->db = new Database();
    $this->table = strtolower(get_class($this)) . 's';
    $this->attributes = $model_object;
    $this->validations = $this->validations();
    $this->before_save = $this->before_save();
  }

  public function save()
  {
    if (empty($this->attributes)) {
      return false;
    }

    if ($this->validate()) {

      // run callback functions
      $this->run_before_save();

      // build the SQL query
      $sql = "INSERT INTO {$this->table} (";
      $values = "VALUES (";

      $param_values = [];

      foreach ($this->attributes as $key => $value) {
        $sql .= $key . ', ';
        $values .= ':' . $key . ', ';
        $param_values[":$key"] = $value;
      }

      // remove the trailing commas and spaces
      $sql = rtrim($sql, ', ') . ') ';
      $values = rtrim($values, ', ') . ')';

      $sql .= $values;

      try {
        // prepare and execute the query with dynamic parameters
        $stmt = $this->db->getPDO()->prepare($sql);

        // bind parameters using the parameter values
        foreach ($param_values as $key => $value) {
          $stmt->bindValue($key, $value);
        }

        $result = $stmt->execute();

        return $result;
      } catch (PDOException $e) {
        $this->errors[] = $e->getMessage();
      }
    } else {
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

  public function find_by_email($email)
  {
    // build a SQL query to retrieve a record by its primary key
    $sql = "SELECT * FROM {$this->table} WHERE email = :email";

    // prepare and execute the query
    $stmt = $this->db->getPDO()->prepare($sql);
    $stmt->bindParam(':email', $email);
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
      $data_type = PDO::PARAM_STR;

      foreach ($rules as $rule => $value) {
        if ($rule === 'numericality' && isset($value['only_integer'])) {
          if (!is_numeric($this->attributes[$field]) || !is_int($this->attributes[$field] + 0)) {
            $data_type = PDO::PARAM_INT;

            $errors[] = "{$field} must be an integer.";
          }
        }

        if ($rule === 'presence' && $value === true) {
          if (empty($this->attributes[$field])) {
            $errors[] = "{$field} can't be blank.";
          }
        }

        if ($rule === 'uniqueness' && $value === true) {
          $sql = "SELECT COUNT(*) FROM {$this->table} WHERE {$field} = :{$field}";

          $stmt = $this->db->getPDO()->prepare($sql);
          $stmt->bindParam(':' . $field, $this->attributes[$field], $data_type);

          $stmt->execute();

          $count = $stmt->fetchColumn();

          if ($count !== 0) {
            $errors[] = $field . ' "' . $this->attributes[$field] . '" already exist.';
          }
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
      // remove 'password_confirmation' attribute if it exists
      unset($this->attributes['password_confirmation']);

      return true;
    } else {
      $this->errors = $errors;
      return false;
    }
  }

  protected function before_save()
  {
    return [];
  }

  private function run_before_save()
  {
    foreach ($this->before_save as $function) {
      call_user_func([$this, $function]);
    }
  }
}
