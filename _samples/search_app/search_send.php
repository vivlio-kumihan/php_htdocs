<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search App –SEND–</title>
  <link rel="stylesheet" href="https://unpkg.com/destyle.css@4.0.0/destyle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <div class="container">
    <h1>検索アプリ</h1>
    <!-- 『忘れたら動かない』 -->
    <!-- action属性、method属性に適宜 -->
    <form action="search_receive.php" method="POST">
      <label for="name">お名前を入力してください。</label>
      <!-- nameなり何なり、SQLで規定している属性名 -->
      <input id="name" type="text" name="name">
      <button type="submit">検索する</button>
    </form>
  </div>
</body>

</html>