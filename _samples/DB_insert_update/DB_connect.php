<!-- DBへ繋げる。 -->
<!-- 
  問い合わせる先は『DB』です。
『テーブル』ではないです。

なのでここでは、DB『quad9_comthy_db』へアクセスします。 
-->
<?php
// DSN, DB_USER, DB_PASSWORDはそれぞれconf_common_thyme_jp.phpで設定している。
require_once '../../tmp/conf_common_thyme_jp.php';

try {
  $dbh = new PDO(DSN, DB_USER, DB_PASSWORD);
  $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo 'Success connect!';
} catch (PDOException $e) {
  print($e -> getMessage());
  die();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://unpkg.com/destyle.css@4.0.0/destyle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="./style.css">
  <script src="./behavior.js" defer></script>
</head>

<body>
  <div class="container">
    hello
  </div>
</body>

</html>

