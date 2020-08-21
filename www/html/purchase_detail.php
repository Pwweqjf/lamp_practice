<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'purchase_detail.php';

session_start();

if(is_logined() === false){
    redirect_to(LOGIN_URL);
  }
  
  $db = get_db_connect();
  $user = get_login_user($db);

  include_once VIEW_PATH . 'purchase_detail_view.php';