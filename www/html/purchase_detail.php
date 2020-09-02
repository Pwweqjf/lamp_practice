<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'history.php';

session_start();

if(is_logined() === false){
    redirect_to(LOGIN_URL);
  }
  
  $db = get_db_connect();
  $user = get_login_user($db);
  $history_id = get_get('history_id');

  if(is_admin($user)){
    $header = get_history($db,null,$history_id);
    $data = get_detail($db,$history_id);
  }else{
    $header = get_history($db,$user['user_id'],$history_id);
    $data = get_detail($db,$history_id,$user['user_id']);
  }
  
  $total_price = sum_detail($data);
  include_once VIEW_PATH . 'purchase_detail_view.php';