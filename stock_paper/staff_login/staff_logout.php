<?php
  session_start();
  $_SESSION=array();
  if(isset($_COOKIE[session_name()])==true){
    setcookie(session_name(),'',time()-42000,'/');
  }
  session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" href="../common/css/common.css" media="screen,print">
<title>ログアウト画面</title>
</head>

<body>

<div id="container">
  <p class="alignCenter">ログアウトしました。</p>
  <br />
  <p class="alignCenter"><a href="../paper/t_paper_list.php" class="btn-shadow">用紙管理へ</a></p>
<!--  <a href="../staff_login/staff_login.html"><p>ログイン画面へ</p></a>	-->
</div>

</body>

</html>
