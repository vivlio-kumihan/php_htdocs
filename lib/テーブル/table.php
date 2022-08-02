<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>about table</title>
</head>

<?php
// テーブルに配置するデータ
$arrs = array(
  0 => array(
    'name' => '高広',
    'hobby' => 'バイクツーリング',
    'email' => 'vivlio@kumihan.com'
  ),
  1 => array(
    'name' => '木田',
    'hobby' => 'ドラム演奏',
    'email' => 'kida@gmail.com'
  ),
  2 => array(
    'name' => '竹中',
    'hobby' => 'フィギア収集',
    'email' => 'takenaka@gmail.com'
  )
);
?>

<body>
  <table>
    <tr>
      <th>氏名</th>
      <th>趣味</th>
      <th>Eメール</th>
    </tr>
    <?php foreach($arrs as $key => $arr) { ?>
      <tr>
        <td><?php echo $arr['name'] ?></td>
        <td><?php echo $arr['hobby'] ?></td>
        <td><?php echo $arr['email'] ?></td>
      </tr>
    <?php } ?>
  </table>
</body>
</html>

<!-- <body>
  <table>
    <tr>
      <th>氏名</th>
      <th>趣味</th>
      <th>Eメール</th>
    </tr>
    <tr>
      <td>高広</td>
      <td>バイクツーリング</td>
      <td>vivlio@kumihan.com</td>
    </tr>
    <tr>
      <td>木田</td>
      <td>ドラム演奏</td>
      <td>kida@gmail.com</td>
    </tr>
    <tr>
      <td>竹中</td>
      <td>フィギア収集</td>
      <td>takenaka@gmail.com</td>
    </tr>
  </table>
</body> -->