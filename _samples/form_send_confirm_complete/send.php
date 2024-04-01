<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>送信ページ</title>
  <link rel="stylesheet" href="https://unpkg.com/destyle.css@4.0.0/destyle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="./style.css">
  <script src="./behavior.js" defer></script>
</head>

<body>
  <div class="container">
    <h1>フォームからの送信</h1>
    <p>次のページへデータを渡してみる。</p>
    <form action="./confirm.php" method="POST">
      <label for="name">氏名</label>
      <input id="name" type="text" name="user_name" />
      <label for="hobby">趣味</label>
      <input id="hobby" type="text" name="hobby" />
      <button type="submit" value="確認">確認</button>
    </form>
  </div>
</body>

</html>