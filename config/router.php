<?php
  final class Router {
    private $controler_name; //errors
    private $action_name; //error404
    private $controller_full_path; //D://....flowingo.com/app/controller/errors_controller.php
    private static $instance;

    public static function getInstance(){
      if (self::$instance == null) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    private function setBase(){
      $request = $_SERVER['REQUEST_URI'];
      $request_arr = explode('/', $request);
      $this -> controller_name = $request_arr[1];
      $this -> action_name = $request_arr[2];
    }

    private function controllerExists($is_admin = false) {
      if (!$is_admin) {
        $base_path = CONTROLLER_PATH; // /var/www/flowingo.com/app/controllers
      }else {
        $base_path = CONTROLLER_PATH . 'admin/';
      }

      $controller_file_name = $this -> controller_name . '_controller.php'; //errors_controller.php
      $this -> controller_full_path = $base_path . $controller_file_name;
      return file_exists($this -> controller_full_path);
    }

    private function isMainPage() {
      return $_SERVER['REQUEST_URI'] == '/';
    }

    public function init(){
      if ($this -> isMainPage()) {
        header('Location:http://flowingo.com/pages/landing');
        return;
      }

      if($this -> isAdminPage()){
        $this -> showAdminPage();
        return;
      }

      $this -> setBase();

      if ($this -> controllerExists()) {
        $controller = $this -> createControllerInstance();
        if (method_exists($controller, $this -> action_name)){
          $action = $this -> action_name;
          $controller -> $action();
        }else{
          header('Location:http://flowingo.com/errors/error404');
        }
      }else{
        header('Location:http://flowingo.com/errors/error404');
      }
    }

    private function isAdminPage() {
      // /admin/categorys/new
      $request = $_SERVER['REQUEST_URI'];
      $request_arr = explode('/', $request);
      return $request_arr[1] == 'admin';
    }

    private function showAdminPage() {
      // /admin/categorys/new
      $request = $_SERVER['REQUEST_URI'];
      $request_arr = explode('/', $request);
      $this -> controller_name = $request_arr[2]; //categorys
      $this -> action_name = $request_arr[3]; //new
      if ($this -> controllerExists(true)){
        $controller = $this -> createControllerInstance();
        if (method_exists($controller, $this -> action_name)){
          $action = $this -> action_name;
          $controller -> $action();
        }else {
        }
      }
    }

    private function createControllerInstance() {
      include_once($this -> controller_full_path);
      $controller_instance_name = ucfirst($this -> controller_name) . 'Controller'; //ErrorsController
      return new $controller_instance_name; //new ErrorsController
    }
  }
?>
