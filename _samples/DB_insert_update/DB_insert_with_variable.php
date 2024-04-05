<?php 
$dsn = 'mysql:dbname=member;host=localhost;charset=utf8';
$user = 'root';
$password = '';

$name = '坂本龍一';
$age = 76;
$email = 'sakamoto@ymo.com';

try {
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO user (id, name, age, email) VALUES (NULL, :name, :age, :email)";

  // プリペアドステートメントを作成
  $stmt = $dbh->prepare($sql);

  // プリペアドステートメントに値をバインド
  // PDO::は必須ではないらしい。
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':age', $age, PDO::PARAM_INT);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  
  // SQL文を実行する（インサートする）。
  $stmt->execute();
  
  echo 'Data inserted successfully!';
} catch (PDOException $e) {
  print($e->getMessage());
  die();
}
?>
