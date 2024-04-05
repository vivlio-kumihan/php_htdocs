<?php
// var_dump($_POST);
$name = $_POST['name'];
// $gender = (int)$_POST['gender'];
$gender = $_POST['gender'];
$country = $_POST['country'];
$message = $_POST['message'];
$subscribe = $_POST['subscribe'];
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
    <h1>POSTでデータを送信した結果</h1>
    <p><?php echo $name ?>さんの登録情報は以下の通りです。</p>
    <dl>
      <div>
        <dt>性　別：</dt>
        <dd><?php echo $gender ?></dd>
      </div>
      <div>
        <dt>出身国：</dt>
        <dd><?php echo $country ?></dd>
      </div>
      <div>
        <dt>一　言：</dt>
        <dd><?php echo $message ?></dd>
      </div>
      <div>
        <dt>購　読：</dt>
        <dd>
          <?php
          $response = ($subscribe === 'on') 
            ? "ニュースレターを購読する。" 
            : "ニュースレターは購読しない。" ;
          echo $response;
          ?>
        </dd>
      </div>
    </dl>
  </div>
</body>

</html>