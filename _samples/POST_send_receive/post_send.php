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
    <h1>POSTでデータを送信する</h1>
    <p>プロフィールを登録してみる。</p>
    <form action="./post_receive.php" method="POST">
      <div class="input name">
        <label for="name">氏　名</label>
        <input id="name" type="text" name="name" />
      </div>
      <div class="input gender">
        <label for="gender">性　別</label>
        <div class="radio male">
          <input id="male" type="radio" name="gender" value="男性" />
          <label for="male">男　性</label>
        </div>
        <div class="radio female">
          <input id="female" type="radio" name="gender" value="女性" />
          <label for="female">女　性</label>
        </div>
      </div>
      <div class="input country">
        <label for="country">出身国</label>
        <select name="country" id="country">
          <option>一覧からお選びください。</option>
          <option value="日本">日本</option>
          <option value="中国">中国</option>
          <option value="韓国">韓国</option>
        </select>
      </div>
      <div class="input message">
        <label for="message">一　言</label>
        <textarea name="message" id="message"></textarea>
      </div>
      <div class="input subscribe">
        <label for="subscribe">購読するにチェック</label>
        <input type="checkbox" name="subscribe" id="subscribe" />
      </div>
      <button type="submit">送信する</button>
    </form>
  </div>
</body>

</html>