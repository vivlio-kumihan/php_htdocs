<?php
$user_name = $_POST['user_name'];
$hobby = $_POST['hobby'];
// echo var_dump($user_name);
// echo var_dump($hobby);
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
  <h1>受信ページ</h1>
  <p>あなたのお名前は<?php echo $user_name; ?>さんと承りました。</p>
  <p>趣味は<?php echo $hobby; ?>でらっしゃいますね。</p>
  <p>以上の情報でよろしいでしょうか？</p>
  <form action="./complete.php" method="POST">
    <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
    <input type="hidden" name="hobby" value="<?php echo $hobby; ?>">
    <input type="submit" value="登録">
  </form>
</body>

</html>