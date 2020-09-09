<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入履歴</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'data.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>

  <h1>購入履歴</h1>
  <div class="container">
    
  <form class="sort" action="index.php" style="text-align:right;">
    <select name = 'sort'>
      <option value = 'new'<?if($sort === 'new')echo 'selected';?>>新着順</option>
      <option value = 'price_asc'<?if($sort === 'price_asc')echo 'selected';?>>価格の安い順</option>
      <option value = 'price_desc'<?if($sort === 'price_desc')echo 'selected';?>>価格の高い順</option>
    </select>
    <input type="submit" value="並べ替え"/>
  </form>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    
    <?php if(count($data) > 0){ ?>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>注文番号</th>
            <th>購入日時</th>
            <th>合計金額</th>
            <th>購入明細</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data as $data){ ?>
          <tr>
            <td><?php print h($data['history_id']); ?></td>
            <td><?php print h($data['create_datetime']); ?></td>
            <td><?php print(number_format($data['sum'])); ?>円</td>
            <td><form action="purchase_detail.php">
                    <input type="submit" value="詳細" class="btn btn-primary btn-block">
                    <input type="hidden" name="history_id" value="<?php print($data['history_id']); ?>">
                  </form></td>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else { ?>
      <p>購入履歴はありません。</p>
    <?php } ?> 
  </div>
</body>
</html>