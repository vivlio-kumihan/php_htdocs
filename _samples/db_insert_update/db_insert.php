<!-- DBへ値をインサートする。 -->

<?php 
$dsn = 'mysql:dbname=member;host=localhost;charset=utf8';
$user = 'root';
$password = '';

try {
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // SQL文を書いて。。。
  $sql = "INSERT INTO user (id, name, age, email) VALUES (NULL, '高橋幸宏', 70, 'takahasi@ymo.com')";
  // SQL文を実行する（インサートする）。
  $dbh->exec($sql);
  echo 'Data inserted successfully!';
} catch (PDOException $e) {
  print($e -> getMessage());
  die();
}