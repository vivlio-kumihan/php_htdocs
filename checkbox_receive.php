<?php
// チェックボックスの値を受け取る。
// 連想配列colorsで収集したデータをここで新たな器に納めている。
$colors = $_POST['colors'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkbox Receive</title>
</head>
<body>
  <h1>受信ページ</h1>
  <h3>お好きな色</h3>
  <!-- 好みの色をリストで展開させる。 -->
  <ul>
    <?php foreach($colors as $val) { ?>
      <li> <?php echo $val ?> </li>
    <?php } ?>
  </ul>
</body>
</html>