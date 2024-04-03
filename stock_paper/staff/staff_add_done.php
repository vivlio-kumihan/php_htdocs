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
<title>スタッフ追加完了</title>
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

<?php
  // 別ファイルに記述しているDB設定情報ファイルを読み込む
  require_once('../../conf/dsn.php');

  try{
    require_once('../common/common.php');

    $post=sanitize($_POST);
    $staff_name=$post['staff_name'];
    $staff_pass=$post['staff_pass'];
    $staff_kengen=$post['staff_kengen'];

    // mySQLに接続
    $dbh = new PDO(DSN, DB_USER, DB_PWD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='INSERT INTO hkt_staff(staff_name,staff_pass,staff_kengen) VALUES (?,?,?)';
    $stmt=$dbh->prepare($sql);
    $data[]=$staff_name;
    $data[]=password_hash($staff_pass, PASSWORD_DEFAULT);
//    $data[]=$staff_pass;
    $data[]=$staff_kengen;
    $stmt->execute($data);

    $dbh=null;

    print '<p>'.$staff_name.'さんを追加しました。</p>';

  } catch(Exception $e) {

    print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
    exit();
  }
?>

<p><a href="staff_list.php" class="btn-simple">戻る</a></p>

</body>
</html>
