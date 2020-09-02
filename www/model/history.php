<?php 
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

 function get_history($db,$user_id = null,$history_id = null){
    $arg = [];
    $where = '';
    $sql = '
    SELECT
        history.history_id,
        user_id,
        create_datetime,
        sum(price * amount) as sum
    FROM
        history INNER JOIN  purchase_detail
    ON
        history.history_id = purchase_detail.history_id';
    if($user_id !== null){
        $where = ' where user_id = ? ';
        $arg[] = $user_id;
    }
    if($history_id !== null){
        if($where === ''){
            $where = ' where history.history_id = ?';
        }else{
            $where .= ' AND history.history_id = ?';
        }
        $arg[] = $history_id;
    }
    $sql .= $where .' GROUP BY
        history.history_id 
    ';
    return fetch_all_query($db,$sql,$arg);
}
function get_detail($db,$history_id,$user_id = null){
    $arg = [$history_id];
    $sql = '
    SELECT
        name,
        purchase_detail.price,
        amount,
        purchase_detail.price * amount as subtotal
    FROM
        purchase_detail INNER JOIN items
    ON  
        purchase_detail.item_id = items.item_id
    where history_id = ? 
        ';
        if($user_id !== null){
            $sql .= ' AND exists(SELECT * FROM history where history_id = ? AND user_id = ?)';
            $arg[] = $history_id;
            $arg[] = $user_id;
        }
        return fetch_all_query($db,$sql,$arg);
}

function sum_detail($data){
    $total_price = 0;
    foreach($data as $data){
      $total_price += $data['price'] * $data['amount'];
    }
    return $total_price;
  }