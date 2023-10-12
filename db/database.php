<?php

class Database
{
  private $db_host = DB_HOST;
  private $db_username = DB_USER;
  private $db_password = DB_PASSWORD;
  private $db_name = DB_NAME;
  private $pdo;

  function __construct()
  {
    try {
      $this->pdo = new PDO("mysql:host={$this->db_host};dbname={$this->db_name}", $this->db_username, $this->db_password);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Database connection failed: " . $e->getMessage());
    }
  }

  function getPDO()
  {
    return $this->pdo;
  }
}
