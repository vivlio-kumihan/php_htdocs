<?php
$dsn = "mysql:dbname=sample;host=localhost;charset = utf8";
$user = "root";
$password = "root";

try{
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM `user`";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $count = $stmt->rowCount();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $data[] = $row;
  }
} catch (PDOException $e) {
  echo($e->getMessage());
  die();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>recive</title>
</head>
<body>
  <h1>会員データ一覧</h1>
  <p><?php echo $count; ?>件見つかりました。</p>
  <table>
    <th>id</th>
    <th>お名前</th>
    <?php foreach($data as $row): ?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo $row['name']; ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
