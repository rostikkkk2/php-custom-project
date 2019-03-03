<?php
  require_once(UTILS_PATH . '/controller.php');

  class CategorysController extends Controller{

    public function new() {
      $this -> view -> render('/admin/categorys/new.php');
    }

    public function create(){
      $title = $_POST['category'];
      if($this -> model -> validate($title)){
        $this -> model -> createBy(['title' => $title, 'position' => $this -> model -> getMaxPosition()]);
      }

      header('Location: /');
    }

    public function index(){
      $categorys_moded = new CategorysModel;
      $categorys = $categorys_moded -> selectAll();
      $this -> view -> render('/admin/categorys/index.php', ['categorys' => $categorys]);

    }

  }
?>
