<?php
$dsn = 'mysql:dbname=sample;host=localhost;charset=utf8';
$user = 'root';
$password = '';

try {
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INFO user (id, name, age, email) VALUES (NULL, '田中三郎', '28', 'sample@sample.com')";
  echo '接続に成功しました。';
} catch (PDOException $e) {
  print("接続に失敗しました。" . $e->getMessage());
  die();
}
