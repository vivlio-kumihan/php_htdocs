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
    <?php foreach ($colors as $val) { ?>
      <!-- POSTから出力されてきたデータに対して、 -->
      <!-- セキュリティの観点から -->
      <!-- ENT_QUOTESというオプションで、 -->
      <!-- プログラムとして意味のある『’』『”』をただの『文字列』に変換させる。 -->
      <!-- 送信データは簡単に編集することが可能なんだそう。 -->
      <!-- であるから、受信したデータの出力時には、データに対して、 -->
      <!-- プログラム言語が動作出来ないよう無効化する処置が必要。 -->
      <!-- こういう理解でいいのだろうか？ -->
      <li> <?php echo htmlspecialchars($val, ENT_QUOTES, 'UTF-8') ?> </li>
    <?php } ?>
  </ul>
</body>

</html>