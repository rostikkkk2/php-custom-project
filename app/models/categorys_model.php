<?php
require_once(UTILS_PATH . 'model.php');

class CategorysModel extends Model {
  private $title;

  public function validate($title){
    $this -> title = $title;
    return $this -> validateEmpty() && $this -> isUniqueTitle() && $this -> validateForLength();
  }

  public function validateEmpty(){
    return !empty($this -> title);
  }

  public function isUniqueTitle(){
    return !$this -> findBy(['title' => $this -> title]);
  }

  public function validateForLength(){
    return strlen($this -> title) >= 3 && strlen($this -> title) <= 50;
  }

  public function getMaxPosition(){
    $max_position = intval($this -> max('position'));
    return ++$max_position;
  }
}
 ?>
