<?php
$dsn = "mysql:dbname=sample;host=localhost;charset=utf8";
$user = "root";
$password = "root";

try {
  $db_ins = new PDO($dsn, $user, $password);
  $db_ins->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM `user`";
  $stmt = $db_ins->prepare($sql);
  $stmt->execute();
  $data = array();
  $count = $stmt->rowCount();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
  }
  echo '';
} catch (PDOException $e) {
  print("会員データベースへの接続に失敗しました。" . $e->getMessage());
  die();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>会員データベース</title>
  <style type="text/css">
    table,
    th,
    td {
      border: 1px solid #333;
      border-collapse: collapse;
    }
  </style>
</head>

<body>
  <h5>ご希望の手続きをはじめてください。</h5>
  <button onclick="location.href='./crud_create.php'">会員の追加</button>
  <button onclick="location.href='./crud_update.php'">会員情報の変更</button>
  <button onclick="location.href='./crud_delete.php'">退会</button>
  <h4>会員データ一覧</h4>
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

</body>

</html>