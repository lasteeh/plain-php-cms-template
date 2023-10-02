<?php
// define parent controller class ApplicationController

class ApplicationController
{
  private $model;

  function __construct($model)
  {
    $this->model = $model;
  }
}
