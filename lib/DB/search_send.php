<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>search app</title>
</head>
<body>
  <h1>検あアプリ</h1>
  <p>名前の一致する会員を一覧で表示します。</p>
  <form action="search_receive.php" method="POST">
    <label>お名前</label>
    <input type="text" name="name">
    <input type="submit" value="検索する">
  </form>
</body>
</html>