<?php
  session_start();
  session_regenerate_id(true);
  if(isset($_SESSION['login'])==false){
    print '<p>ログインされていません。</p>';
    print '<a href="../staff_login/staff_login.html"><p>ログイン画面へ</p></a>';
    exit();
  } else {
    print '<p>'.$_SESSION['staff_name'];
    print 'さんログイン中</p>';
    print '<form method="post" action="staff_logout.php"><input type="submit" value="ログアウト"></form>';
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>単価管理トップメニュー</title>
</head>
<body>
  <h2>単価管理トップメニュー</h2>
  <br />
  <p><a href="./t_prepress_list.php">プリプレス工程単価リスト</a></p>
  <br />
  <p><a href="./t_ondemand_list.php">オンデマンド工程単価リスト</a></p>
  <br />
  <p><a href="./t_press_list.php">プレス工程単価リスト</a></p>
  <br />
  <p><a href="./t_paper_list.php">用紙単価リスト</a></p>
  <br />
  <p><a href="./t_postpress_list.php">ポストプレス工程単価リスト</a></p>
  <br />
  <p><a href="../staff_login/staff_top.php">トップメニューへ戻る⇒</a></p>
</body>
</html>
