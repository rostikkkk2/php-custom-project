<?php
  require_once(UTILS_PATH . '/controller.php');
  require_once(MODEL_PATH . 'categorys_model.php');/// aded wrong?????

  class PagesController extends Controller{
    public function landing() {
      require_once(MODEL_PATH . 'goods_model.php');
      require_once(MODEL_PATH . 'news_model.php');
      $goods_model = new GoodsModel;
      $goods = $goods_model -> selectAll();
      $news_model = new NewsModel;
      $news = $news_model -> selectAll();
      $this -> view -> render('/pages/landing.php', ['goods' => $goods, 'news' => $news]);

    }

    public function delivery() {
      $this -> view -> render('/pages/delivery.php');
    }

    public function catalog() {
      $categorys_moded = new CategorysModel;
      $categorys = $categorys_moded -> selectAll();
      $this -> view -> render('/pages/catalog.php', ['categorys' => $categorys]);
    }

    public function about_us() {
      $this -> view -> render('/pages/about_us.php');
    }



  }
?>
