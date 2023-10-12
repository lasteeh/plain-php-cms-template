<?php
require_once './db/database.php';

class ActiveRecord
{
  private $db;
  private $table;

  function __construct()
  {
    $this->db = new Database();
    $this->table = strtolower(get_class($this)) . 's';
  }

  function find($id)
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
}
