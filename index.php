<?php
$dsn = "mysql:dbname=quad9_comthy_db;host=mysql57.quad9.sakura.ne.jp;charser=utf8";
$user = "quad9";
$password = "Bf109tugumi";

try {
  $dbh = new PDO($dsn, $user, $password);
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
    <h1>say hello</h1>
    <h1>say hello</h1>
    <h1>say hello</h1>
    <h1>say hello</h1>
    <h1>say hello</h1>
  </div>
</body>

</html>