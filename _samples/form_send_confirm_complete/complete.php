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
  <title>Document</title>
  <link rel="stylesheet" href="https://unpkg.com/destyle.css@4.0.0/destyle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="./style.css">
  <script src="./behavior.js" defer></script>
</head>

<body>
  <div class="container">
    <h1>完了のページ</h1>
    <p>こんにちは、<?php echo $user_name; ?>さん</p>
    <p>ご趣味は、<?php echo $hobby; ?>ということで承りました。</p>
  </div>
</body>

</html>