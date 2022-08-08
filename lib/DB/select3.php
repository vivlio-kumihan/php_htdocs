<?php
$dsn = "mysql:dbname=sample;host=localhost;charset=utf8";
$user = "root";
$password = "root";

try {
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT AVG(`age`) FROM `user`";
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
  
  // avg = "SELECT AVG(`age`) FROM `user`";
  // $found_name = "SELECT * FROM `user` WHERE `name` LIKE '%李%'";
  // $ord = "SELECT `name`, `age` FROM `user` ORDER BY `age` DESC";
}

var_dump($count);
var_dump($data);
echo $data;

