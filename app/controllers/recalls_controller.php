<?php
  require_once(UTILS_PATH . '/controller.php');
  include_once(VIEW_PATH . 'partials/_header.php');

  class RecallsController extends Controller{
    public $get_post_num;

    public function __construct(){
      $this -> get_post_num = $_POST['num'];
    }

    public function getValidNum(){
      $num = $this -> get_post_num;
      if ($num != "" && ctype_digit($num)){
        if($this -> validNumLength($num)){
          return true;
        }
      }
    }

    public function validNumLength($value){
      if (strlen($value) >= 10 && strlen($value) <= 14) {
        return true;
      }
    }

    public function create(){
      if ($this -> getValidNum()) {
        require_once(MODEL_PATH . 'recalls_model.php');
        $recalls_model = new RecallsModel;
        $recalls = $recalls_model -> createBy('recalls', ['phone_number' => $this -> get_post_num]);
      }
    }
  }

 ?>
