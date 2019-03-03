<?php
  function renderHeader() {
    // session_start();
    if (isset($_SESSION['is_authenticated']) && $_SESSION['is_authenticated'] == '1'){
      include_once('app/views/partials/headers/authorized.php');
    }else{
      include_once('app/views/partials/headers/guest.php');
    }
  }
?>
