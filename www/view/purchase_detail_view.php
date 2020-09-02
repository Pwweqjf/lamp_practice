<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入明細</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'data.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>購入明細</h1>
  <div class="container">
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <?php if(count($data) > 0){ ?>
        <p class="text-right">注文番号: <?php print ($header[0]['history_id']); ?></p>
        <p class="text-right">購入日時: <?php print ($header[0]['create_datetime']); ?></p>
        <p class="text-right">合計金額: <?php print number_format($header[0]['sum']); ?>円</p>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>商品名</th>
            <th>商品価格</th>
            <th>購入数</th>
            <th>小計</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data as $data){ ?>
          <tr>
            <td><?php print h($data['name']); ?></td>
            <td><?php print h($data['price']); ?></td>
            <td><?php print h($data['amount']); ?></td>
            <td><?php print(number_format($data['subtotal'])); ?>円</td>

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