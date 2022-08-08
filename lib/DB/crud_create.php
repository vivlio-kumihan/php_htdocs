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
