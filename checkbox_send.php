<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkbox Send</title>
</head>

<body>
  <h1>チェックボックスを使ったフォーム</h1>
  <!-- form => actionで『post』で指定して送信先へデータを送るのがこの1行でやってること。 -->
  <form action="checkbox_receive.php" method="post">
    <p>
      <!-- colors[]とするこで、配列へチェックボックスに印をする度に値がappendされるわけ。 -->
      <!-- 配列名としては『colors』であることに注意が必要。 -->
      <input type="checkbox" name="colors[]" value="青">青
      <input type="checkbox" name="colors[]" value="赤">赤
      <input type="checkbox" name="colors[]" value="黄">黄
      <input type="checkbox" name="colors[]" value="緑">緑
      <input type="checkbox" name="colors[]" value="紫">紫
      <input type="checkbox" name="colors[]" value="白">白
      <input type="checkbox" name="colors[]" value="橙">橙
    </p>
    <input type="submit" value="Submit">
  </form>
</body>

</html>