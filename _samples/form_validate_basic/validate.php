<!-- validateの超基本的な書き方。 -->
<!-- POSTされたらその値をスーパーグローバル変数に入れて作業を開始するというやつ。 -->

<?php
  $movie_name = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie_name = $_POST['movie_name'];
  
    if (mb_strlen($movie_name) === 0) {
      $warning = 'お好きな映画のタイトルを入力してください。';
    } elseif (mb_strlen($movie_name) > 20) {
      $warning = '入力は20文字以内でお願いします。';
    }
  }
  echo isset($warning) ? $warning : '入力されたのは'.$movie_name.'です。';
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
    <h1>入力フォームを検証する</h1>
    <p>文字列を入力してください。</p>
    <form action="#" method="POST">
      <label for="input">好きな映画は？</label>
      <input id="input" type="text"  name="movie_name" />
      <button type="submit" value="送信">送信</button>
    </form>
  </div>
</body>

</html>