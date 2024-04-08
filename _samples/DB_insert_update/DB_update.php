<?php 
require_once '../../tmp/conf_common_thyme_jp.php';

$name = '坂本竜一';
$age = 77;
$email = 'sakamoto@dragon.com';

try {
  $dbh = new PDO(DSN, DB_USER, DB_PASSWORD);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // 上手く使い分けること。
  // 一つの属性の値を変更するだけだとこれ。
  $sql = "UPDATE `user` SET `name`=:name WHERE id=7";
  // 複数の場合はこちら。
  $sql = "UPDATE `user` SET `age`=:age, `email`=:email WHERE id=7";

  // プリペアドステートメントを作成
  $stmt = $dbh->prepare($sql);

  // プリペアドステートメントに値をバインド
  // PDO::は必須ではないらしい。
  // $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':age', $age, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);

  // SQL文を実行する（インサートする）。
  $stmt->execute();
  
  echo 'Data updated successfully!';
} catch (PDOException $e) {
  print($e->getMessage());
  die();
}
?>