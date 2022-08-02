<?php
$user_name = $_POST['user_name'];
$hobby = $_POST['hobby'];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>登録ページ</h1>
  <p>こんにちは<?php echo $user_name; ?>さん。</p>
  <p>趣味は<?php echo $hobby; ?>ということで承りました。</p>
  <p>以上で登録を完了しました。</p>
</body>

</html>