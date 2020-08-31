<?php 
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

 function get_history($db,$user_id = null){
    $arg = [];
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
        $sql .= ' where user_id = ? ';
        $arg[] = $user_id;
    }
    $sql .= ' GROUP BY
        history.history_id 
    ';
    return fetch_all_query($db,$sql,$arg);
}
