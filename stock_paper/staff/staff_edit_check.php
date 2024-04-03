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
<title>スタッフ修正入力チェック</title>
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

<h1>スタッフ修正</h1>

<?php
  require_once('../common/common.php');

  $post=sanitize($_POST);
  $staff_code=$post['staff_code'];
  $staff_name=$post['staff_name'];
  $staff_pass=$post['staff_pass'];
  $staff_pass2=$post['staff_pass2'];
  $staff_kengen=$post['staff_kengen'];

  $okflg=true;

  if($staff_name==''){
    print '<p>スタッフ名が入力されていません。</p>';
    $okflg=false;
  } else {
    print '<p>スタッフ名：'.$staff_name.'</p>';
  }

  if($staff_pass==''){
    print '<p>パスワードが入力されていません。</p>';
    $okflg=false;
  }

  if($staff_pass!=$staff_pass2){
    print '<p>パスワードが一致しません。</p>';
    $okflg=false;
  }

  if($staff_kengen=='一般' || $staff_kengen=='管理'){
    print '<p>スタッフ権限：'.$staff_kengen.'</p>';
  } else {
    print '<p>スタッフ権限が正しくありません。</p>';
    $okflg=false;
  }

  if($okflg==true){
//    $staff_pass=password_hash($staff_pass, PASSWORD_DEFAULT);
    print '<p>上記内容で修正します。</p>';
    print '<form method="post" action="staff_edit_done.php">';
      print '<input type="hidden" name="staff_code" value="'.$staff_code.'">';
      print '<input type="hidden" name="staff_name" value="'.$staff_name.'">';
      print '<input type="hidden" name="staff_pass" value="'.$staff_pass.'">';
      print '<input type="hidden" name="staff_kengen" value="'.$staff_kengen.'">';
      print '<br />';
      print '<input type="button" onclick="history.back()" class="btn-simple" value="戻る">';
      print '<input type="submit" class="btn-simple" value="ＯＫ">';
    print '</form>';
  } else {
    print '<form><input type="button" onclick="history.back()" class="btn-simple" value="戻る"></form>';
  }
?>

</body>
</html>
