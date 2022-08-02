<?php
// 変数の初期化
$movie = '';
// point | _SERVER => Super Global Variable
// point | REQUEST_METHOD => キーにこの引数をしていすることで『POST』されてきたかどうかを判定する。
// point | REQUEST_METHOD
//         URLを入力してアクセスしてきた場合は、       =>『GET』
//         フォームや送信ボタンを押してやってきた場合は、=>『POST』
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  // ポスト内容を取得し、入力値が正しいか検証する。
  $movie = $_POST['movie'];
  if(mb_strlen($movie) === 0){
    $err = '好きな映画を入力してください。';
  }elseif(mb_strlen($movie) >= 20){
    $err = '20文字以内で入力してください。';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validation</title>
  <style type="text/css">
    .cneter {
      text-align: center;
    }
    input {
      margin: 5px;
    }
  </style>
</head>

<body>
  <div class="center">
    <h1>入力フォームの検証</h1>
    <p>
      <?php
        if (isset($err)) {
          echo $err;
        } else {
          echo "あなたの好きな映画は{$movie}です。";
        }
      ?>
    </p>
    <!-- 『action』が『空』の時、『POST』された内容を自分自身に投げる。 -->
    <form action="" method="POST">
      <label for="">好きな映画</label>
      <input type="text" name="movie"><br>
      <input type="submit">
    </form>
  </div>
</body>

</html>