<?php
require_once '../../tmp/conf_common_thyme_jp.php';

try {
  $dbh = new PDO(DSN, DB_USER, DB_PASSWORD);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM user";

  // プリペアドステートメントを作成
  $stmt = $dbh->prepare($sql);

  // SQL文を実行する（インサートする）。
  $stmt->execute();

  // 配列で初期化。
  $data = array();
  // rowCount関数で行数を取得する。
  $count = $stmt->rowCount();
  // fetch関数の引数にPDO::FETCH_ASSOCを与えて一行ずつデータを取得する。
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // var_dump('<hr>');
    // var_dump($row);
    $data[] = $row;
  }
  
  // echo 'The process has been completed!';
} catch (PDOException $e) {
  print($e->getMessage());
  die();
}
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
  <script src="./behavior.js" defer></script>
</head>

<body>
  <div class="container">
    <p>メンバーは<?php echo $count ?>名</p>
    <ul>
        <?php
          $i = 0;
          while($i < count($data)) {
        ?>
      <li>
        <div class="item"><?php echo $data[$i]['id'] ?></div>
        <div class="item"><?php echo $data[$i]['name'] ?></div>
        <div class="item"><?php echo $data[$i]['age'] ?></div>
        <div class="item"><?php echo $data[$i]['email'] ?></div>
      </li>
        <?php
          $i++;
        }
        ?>
    </ul>
  </div>
</body>

</html>
