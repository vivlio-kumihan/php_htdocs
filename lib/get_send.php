<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>get send</title>
</head>
<body>
  <h1>GETでデータを送信する。</h1>
  <form action="get_receive.php" method="GET">
    <label for="">氏名</label>
    <input type="text" name="name"><br>
    <label for="">趣味</label>
    <input type="text" name="hobby"><br>
    <input type="submit" value="送信">
  </form>
</body>
</html>