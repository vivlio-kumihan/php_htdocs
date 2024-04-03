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
<title>スタッフ修正</title>
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

<?php
  require_once('../../conf/dsn.php');

  try{
    $staff_code=$_GET['staff_code'];
    $staff_code=htmlspecialchars($staff_code,ENT_QUOTES,'UTF-8');

    // mySQLに接続
    $dbh = new PDO(DSN, DB_USER, DB_PWD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='SELECT staff_name,staff_kengen FROM hkt_staff WHERE staff_code=?';
    $stmt=$dbh->prepare($sql);
    $data[]=$staff_code;
    $stmt->execute($data);

    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
    $staff_name=$rec['staff_name'];
    $staff_kengen=$rec['staff_kengen'];

    $dbh=null;

  } catch(Exception $e) {

    print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
    exit();
  }
?>

<h1>スタッフ修正</h1>

<p>スタッフコード</p>
<?php print '<p>'.$staff_code.'</p>'; ?>
<form method="post" action="staff_edit_check.php">
  <input type="hidden" name="staff_code" value="<?php print $staff_code; ?>">
  <p>スタッフ名</p>
  <input type="text" name="staff_name" style="width:200px" value="<?php print $staff_name; ?>">
  <p>権限</p>
  <select name="staff_kengen">
    <option value="<?php print $staff_kengen; ?>" selected><?php print $staff_kengen; ?></option>
    <?php
      if($staff_kengen=='管理'){
        print '<option value="一般">一般</option>';
      } else {
        print '<option value="管理">管理</option>';
      }
    ?>
  </select>
  <p>パスワードを入力してください。</p>
  <input type="password" name="staff_pass" style="width:10em">
  <p>パスワードをもう１度入力してください。</p>
  <input type="password" name="staff_pass2" style="width:10em">
  <br /><br />
  <input type="button" onclick="history.back()" class="btn-simple" value="戻る">
  <input type="submit" class="btn-simple" value="ＯＫ">
</form>

</body>
</html>
