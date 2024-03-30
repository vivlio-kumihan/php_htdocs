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
    <h1>GETでデータを送信する。</h1>
    <p>入力してください。</p>
    <form action="./get_receive.php" method="GET">
      <label for="name">氏名</label>
      <input id="name" type="text" name="name" />
      <label for="hobby">趣味</label>
      <input id="hobby" type="text" name="hobby" />
      <button type="submit">送信</button>
    </form>
  </div>
</body>

</html>