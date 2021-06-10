<?php

  session_start();

  if(!isset($_SESSION['like'])) { $_SESSION['like'] = []; }

  function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }

  if(!is_ajax_request()) { exit; }
  $raw_id = isset($_POST['id']) ? $_POST['id'] : '';
  if(preg_match("/post-no-(\d+)/", $raw_id, $matches)){
      $id = $matches[1];
      if(!in_array($id, $_SESSION['like'])){
          $_SESSION['like'][] = $id;
      }
      echo "true";
  }else{
      echo "false";
  }

?>
 