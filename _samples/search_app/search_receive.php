<?php 

// POSTの受信はコードの最初に行う（くらに重要なこと）。
// サーバーから送信されてデータが『POST』という文字列と同じなら。。。
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
}

$dsn = 'mysql:dbname=member;host=localhost;charset=utf8';
$user = 'root';
$password = '';

// html内で持ち運ぶための変数を初期化する。
// $data = [];
// 配列で初期化。
$data = array();

try {
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // SQL文を定義する。
  $sql = "SELECT id, name FROM user WHERE name LIKE :name";

  // プリペアドステートメントを作成
  $stmt = $dbh->prepare($sql);

  // db_insert_with_variable.phpでやったのはパラメータと変数を結びつけるやつ
  // $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  // $stmt->bindParam(':age', $age, PDO::PARAM_INT);

  $stmt->bindValue(':name', '%'.$name.'%', PDO::PARAM_STR);

  // SQL文を実行する（インサートする）。
  $stmt->execute();

  // rowCount関数で行数を取得する。
  $count = $stmt->rowCount();
  // fetch関数の引数にPDO::FETCH_ASSOCを与えて一行ずつデータを取得する。
    // FETCH_BOTH => 通常は、インデックスと一緒に連想配列を返すこちらを使うらしい。
    // FETCH_ASSOC => 連想配列だけを返す場合はこちらを使う。
    
  // while($row = $stmt->fetch(PDO::FETCH_BOTH)) {
  //   var_dump('<hr>');
  //   var_dump($row);
  //   $data[] = $row;
  // }
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
  <title>Search App –RECEIVE–</title>
  <link rel="stylesheet" href="https://unpkg.com/destyle.css@4.0.0/destyle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <div class="container">
    <h1>会員データ一覧</h1>
    <p><?php echo $count ?>件見つかりました。</p>
    <ul>
      <li class="header">
        <div class="item">ID</div>
        <div class="item">氏名</div>
      </li>

        <?php foreach ($data as $item): ?>
      <li>
        <div class="item"><?php echo $item['id'] ?></div>
        <div class="item"><?php echo $item['name'] ?></div>
      </li>
        <?php endforeach; ?>

    </ul>
  </div>
</body>

</html>
