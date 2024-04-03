<?php
  session_start();
  session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja" id="Top">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" href="../common/css/common.css" media="screen,print">
<title>スタッフ一覧</title>
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
  try{
    // 別ファイルに記述しているDB設定情報ファイルを読み込む
    require_once('../../conf/dsn.php');
    // mySQLに接続
    $dbh = new PDO(DSN, DB_USER, DB_PWD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql='SELECT staff_code,staff_name,staff_kengen,staff_create_date FROM hkt_staff WHERE 1';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();

    $dbh=null;

    print '<h1>スタッフ一覧</h1>';

    print '<form method="post" action="staff_branch.php">';
      print '<table>';
      print '<tr><th width="50px">選択</th><th width="50px">ＩＤ</th><th width="100px">スタッフ名</th><th width="50px">権限</th><th width="200px">登録日</th></tr>';
      while(true){
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false){
          break;
        }
        print '<tr>';
        print '<td style="text-align:center;"><input type="radio" name="staff_code" value="'.$rec['staff_code'].'"></td>';
        print '<td style="text-align:center;">'.$rec['staff_code'].'</td>';
        print '<td style="text-align:center;">'.$rec['staff_name'].'</td>';
        print '<td style="text-align:center;">'.$rec['staff_kengen'].'</td>';
        print '<td style="text-align:center;">'.$rec['staff_create_date'].'</td>';
        print '</tr>';
      }
      print '</table>';
      print '<br />';
      print '<input type="submit" name="staff_add" class="btn-simple" value="追加">';
      print '<input type="submit" name="staff_edit" class="btn-simple" value="修正">';
      print '<input type="submit" name="staff_delete" class="btn-simple" value="削除">';
    print '</form>';

  } catch(Exception $e) {

    print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
    exit();
  }
?>

  <br />
  <a href="../paper/t_paper_list.php" class="btn-shadow">用紙管理へ⇒</a>
</body>
</html>
