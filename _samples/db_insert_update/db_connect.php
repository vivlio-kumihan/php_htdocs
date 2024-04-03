<!-- DBへ繋げる。 -->
<!-- 
  問い合わせる先は『DB』です。
『テーブル』ではないです。

なのでここでは、DB『member』へアクセスします。 
-->

<?php 
$dsn = 'mysql:dbname=member;host=localhost;charset=utf8';
$user = 'root';
$password = '';

try {
  $dbh = new PDO($dsn, $user, $password);
  $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo 'Success connect!';
} catch (PDOException $e) {
  print($e -> getMessage());
  die();
}