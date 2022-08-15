<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新と登録ユーザー</title>
</head>

<body>
  <h1>新規登録ユーザー</h1>
  <form action="../signup.php" method="POST">
    <p>お名前<input type="text" name="name"><?php echo $errs['name']; ?></p>
    <p>メールアドレス<input type="text" name="email"><?php echo $errs['email']; ?></p>
    <p>パスワード<input type="password" name="password"><?php echo $errs['password']; ?></p>
    <p><input type="submit" value="登録する"> </p>
  </form>
</body>

</html>