<!-- DBへ値をインサートする。 -->

<?php 
require_once '../../tmp/conf_common_thyme_jp.php';

try {
  $dbh = new PDO(DSN, DB_USER, DB_PASSWORD);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // SQL文を書いて。。。
  $sql = "INSERT INTO user (id, name, age, email) VALUES (NULL, '木田滋之', 59, 'kida@shigeyuki.com')";
  // SQL文を実行する（インサートする）。
  $dbh->exec($sql);
  echo 'Data inserted successfully!';
} catch (PDOException $e) {
  print($e -> getMessage());
  die();
}