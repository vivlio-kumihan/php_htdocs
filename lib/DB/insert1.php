<?php
$dsn = "mysql:dbname=sample;host=localhost;charset=utf8";
$user = "root";
$password = "root";

try {
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO `user`(`id`, `name`, `age`, `email`) VALUES (NULL, '若山　富三郎', '90', 'tomi@saburo.com')";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':name', $name, PDO::PARAM_STR);
  $stmt->bindValue(':age', $age, PDO::PARAM_INT);
  $stmt->bindValue(':email', $age, PDO::PARAM_STR);
  $stmt->execute();
  echo 'データを追加しました。';
} catch (PDOException $e) {
  print("接続に失敗しました。".$e->getMessage());
  die();
}