<?php

// models/TodoModel.php

class PillsModel {

  private $pdo;

  public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
  }

  public function getAllTodos() {
    $sql = "SELECT name
            FROM medictable
            order by name ASC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

}
