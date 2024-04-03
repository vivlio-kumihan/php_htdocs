<?php
  session_start();
  session_regenerate_id(true);
?>

<html lang="ja" id="Top">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" href="../common/css/common.css" media="screen,print">
<title>スタッフ追加</title>
</head>
<body>

<div id="container">

<?php
  if(isset($_SESSION['login'])==false){
    print '<p>ログインされていません。</p><br/>';
#    print '<a href="../staff_login/staff_login.html" class="btn-shadow"><p>ログイン画面へ</p></a>';
#    print '<form method="post" action="../staff_login/staff_login.html"><input type="submit" value="ログイン" class="btn-shadow"></form>';
    print '<p><form method="post" action="../staff_login/staff_login_check.php"><input type="submit" value="ログイン" class="btn-shadow">　ID：<input type="text" name="staff_code">　パスワード：<input type="password" name="staff_pass"></form></p>';
    exit();
  } else {
    print '<p><form method="post" action="../staff_login/staff_logout.php" class="f_left"><input type="submit" value="ログアウト" class="btn-shadow">　'.$_SESSION['staff_name'].'さんログイン中</form>';
    print '</p><br/>';
  }
?>

<h1>スタッフ追加</h1>

<form method="post" action="staff_add_check.php">
  <p>スタッフ名を入力してください。</p>
  <input type="text" name="staff_name" style="width:200px">
  <br />
  <p>スタッフ権限を選んでください。</p>
  <select name="staff_kengen">
    <option value="一般" selected>一般</option>
    <option value="管理">管理</option>
  </select>
  <br />
  <p>パスワードを入力してください。</p>
  <input type="password" name="staff_pass" style="width:100px">
  <br />
  <p>パスワードをもう１度入力してください。</p>
  <input type="password" name="staff_pass2" style="width:100px">
  <br /><br />
  <input type="button" onclick="history.back()" class="btn-simple" value="戻る">
  <input type="submit" class="btn-simple" value="ＯＫ">
</form>

</body>
</html>
