<?php
  require_once(UTILS_PATH . 'view.php');
  class Controller {
    protected $model;
    protected $view;

    public function __construct(){
      $entity_name = explode('Controller', get_class($this))[0];
      $model_file_name = strtolower($entity_name) . '_model.php';
      require_once(MODEL_PATH . $model_file_name);
      $model_name = $entity_name . 'Model';
      $this -> model = new $model_name;
      $this -> view = new View;
    }
  }



 ?>
