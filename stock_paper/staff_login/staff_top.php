<?php
  session_start();
  session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja" id="Top">
<head>
<meta charset="UTF-8">
<title>在庫紙管理メニュー</title>
</head>
<body>

<div id="container">

<?php
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

<h2>在庫紙管理メニュー</h2>
<br />
<p><a href="../staff/staff_list.php">スタッフ管理</a></p>
<br />
<p><a href="../paper/t_paper_list.php">用紙管理</a></p>

</div>

</body>
</html>
