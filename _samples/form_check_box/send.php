<?php
  // 1.
  // checkboxを使って値を配列に格納し、次のページへインスタンスを送り展開することをやってみる。

  // 2. 
  // 悪意ある特殊文字を変換してみる。phpらしい話題です。
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
    <h1>チェックボックスを使ったフォーム</h1>
    <p>お好きな色を選択してください。（複数選択可能）</p>
    <form action="./receive.php" method="POST">
      <div>
        <input id="blue" type="checkbox" name="select_color[]" value="青">
        <label for="blue">青</label>
        <input id="red" type="checkbox" name="select_color[]" value="赤">
        <label for="red">赤</label>
        <input id="yellow" type="checkbox" name="select_color[]" value="黄">
        <label for="yellow">黄</label>
        <input id="green" type="checkbox" name="select_color[]" value="緑">
        <label for="green">緑</label>
        <input id="puple" type="checkbox" name="select_color[]" value="紫">
        <label for="puple">紫</label>
        <input id="white" type="checkbox" name="select_color[]" value="白">
        <label for="white">白</label>
        <input id="orange" type="checkbox" name="select_color[]" value="橙">
        <label for="orange">橙</label>
      </div>
      <button type="submit">送信</button>
    </form>
  </div>
</body>

</html>