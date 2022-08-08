<?php
$name = $_GET['name'];
$hobby = $_GET['hobby'];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>get receive</title>
</head>

<body>
  <h1>受信ページ</h1>
  <p>あなたの名前は、<?php echo $name ?>さんです。</p>
  <p>趣味は、<?php echo $hobby ?>です。</p>
</body>

</html>