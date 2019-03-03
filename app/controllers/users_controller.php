<?php
  require_once(UTILS_PATH . '/controller.php');

  class UsersController extends Controller{
    public function index(){
      $this -> view -> render('/users/index.php');
    }



  }
 ?>
