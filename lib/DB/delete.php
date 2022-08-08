<?php
$dsn = "mysql:dbname=sample;host=localhost;charset=utf8";
$user = "root";
$password = "root";

try {
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "DELETE FROM `user` WHERE id = 10";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  echo '処理が終了しました。';
} catch (PDOException $e) {
  print("接続に失敗しました。".$e->getMessage());
  die();
}