<?php
  // まずはデバッグする。POSTされたオブジェクトが送られているかどうかを確かめる。これはJSでも一緒だよ。
  // ポストされたものを受け取る合言葉はすぐ思い付くようにしよう。
  $select_color = $_POST['select_color'];
  // var_dump($select_color);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://unpkg.com/destyle.css@4.0.0/destyle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <div class="container">
    <h1>選択した色は...</h1>
    <ul>
        <?php
        foreach ($select_color as $key => $color) { 
        ?>
      <li>
        <!-- <?php echo $color ?> -->
        <?php echo htmlspecialchars($color, ENT_QUOTES, 'UTF-8'); ?>
      </li>  
        <?php
        }
        ?>
    </ul>

  </div>
</body>

</html>