<?php 
  $user_name = $_POST['user_name'];
  $hobby = $_POST['hobby'];
  var_dump($user_name);
  var_dump($hobby);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>受信ページ</title>
  <link rel="stylesheet" href="https://unpkg.com/destyle.css@4.0.0/destyle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="./style.css">
  <script src="./behavior.js" defer></script>
</head>

<body>
  <div class="container">
    <h1>データの受信</h1>
    <p>データを受信した状態</p>
    <p>氏名：<?php echo $user_name; ?></p>
    <p>趣味：<?php echo $hobby; ?></p>
    <form action="./complete.php" method="POST">
      <input id="name" type="hidden" name="user_name" value="<?php echo $user_name; ?>" /> 
      <input id="hobby" type="hidden" name="hobby" value="<?php echo $hobby; ?>" />
      <button type="submit" value="登録">登録</button>
    </form>
  </div>
</body>

</html>