<?php

// controllers/TodoController.php

class PillsController {

  private $model;

  public function __construct(PillsModel $model) {
    $this->model = $model;
  }

  public function display() {
    $todos = $this->model->getAllTodos();
    include '../views/pills.php';
  }

}
