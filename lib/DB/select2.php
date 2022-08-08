<?php
$dsn = "mysql:dbname=sample;host=localhost;charset=utf8";
$user = "root";
$password = "root";

try {
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM `user`";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  $data = array();
  $count = $stmt->rowCount();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
  }
  echo '処理が終了しました。';

} catch (PDOException $e) {
  print("接続に失敗しました。" . $e->getMessage());
  die();
}

// try {
//   $dbh = new PDO($dsn, $user, $password);
//   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   $sql = "SELECT * FROM `user`";
//   $stmt = $dbh->prepare($sql);
//   $stmt->execute();
//   echo '処理が終了しました。';

// } catch (PDOException $e) {
//   print("接続に失敗しました。" . $e->getMessage());
//   die();
// }
// $avg = "SELECT AVG(`age`) FROM `user`";
// $found_name = "SELECT * FROM `user` WHERE `name` LIKE '%李%'";
// $ord = "SELECT `name`, `age` FROM `user` ORDER BY `age` DESC";

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sql select</title>
  <style type="text/css">
    table, th, td {
      border: 1px solid #333;
      border-collapse: collapse;
    }
  </style>
</head>

<body>
  <h1>会員データ一覧</h1>
  <table>
    <th>id</th>
    <th>名前</th>
    <th>年齢</th>
    <th>Eメール</th>
    <?php foreach ($data as $row) : ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['age']; ?></td>
        <td><?php echo $row['email']; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <?php echo $avg . "<br>"; ?>
  <?php echo $found_name . "<br>"; ?>

</body>

</html>