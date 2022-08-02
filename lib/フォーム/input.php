<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>練習フォーム</h1>
  <p>次のページへデータを渡してみる。</p>
  <form action="./confirm.php" method="POST">
    <label for="">名前</label>
    <input type="text" name="user_name">
    <label for="">趣味</label>
    <input type="text" name="hobby">
    <input type="submit" value="確認する">
  </form>
</body>
</html>


