<?php
$dsn = "mysql:dbname=sample;host=localhost;charset=utf8";
$user = "root";
$password = "root";
$name = "王　貞治";
$age = 77;

try {
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO `user`(`name`, `age`) VALUES (:name, :age)";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':name', $name, PDO::PARAM_STR);
  $stmt->bindValue(':age', $age, PDO::PARAM_INT);
  $stmt->execute();
  echo "{$name}さんのデータを追加しました。";
} catch (PDOException $e) {
  print("接続に失敗しました。".$e->getMessage());
  die();
}