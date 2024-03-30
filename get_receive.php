<?php 
$name = $_GET['name'];
$hobby = $_GET['hobby'];
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
</head>

<body>
  <div class="container">
    <h3>
      <?php echo $name ?>さん、こんにちは。
    </h3>
    <h3>
      ご趣味は<?php echo $hobby ?>ということで承りました。
    </h3>
  </div>
</body>

</html>