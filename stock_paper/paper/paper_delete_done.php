<?php
  session_start();
  session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" href="../common/css/common.css" media="screen,print">
<title>用紙情報削除完了</title>
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

<h1>用紙情報削除完了</h1>

<?php
  try{
    require_once('../common/common.php');

    $post=sanitize($_POST);
    $paper_table=$post['paper_table'];
    $paper_code=$post['paper_code'];
    $list_id=$post['list_id'];

    // 別ファイルに記述しているDB設定情報ファイルを読み込む
    require_once('../../conf/stock_paper_dsn.php');
    // mySQLに接続
    $dbh = new PDO(DSN, DB_USER, DB_PWD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='DELETE FROM '.$paper_table.' WHERE p_code=?';
    $stmt=$dbh->prepare($sql);
    $data[]=$paper_code;
    $stmt->execute($data);

    $dbh=null;

    print '<p>削除しました。</p>';
    print '<br>';

  } catch(Exception $e) {

    print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
    print '<br>';
    exit();
  }

  if($paper_table=='t_press_k' || $paper_table=='t_press_4c' || $paper_table=='t_press_fuuto' || $paper_table=='t_press_spcolor'){
    print '<p><a href="t_press_list.php#'.$list_id.'" class="btn-simple">戻る</a></p>';
  }
  if($paper_table=='t_paper_text' || $paper_table=='mst_paper' || $paper_table=='t_paper_fuuto'){
    print '<p><a href="t_paper_list.php#'.$list_id.'" class="btn-simple">戻る</a></p>';
  }
  if($paper_table=='t_postpress_choai' || $paper_table=='t_postpress_maki' || $paper_table=='t_postpress_mikaeshi' || $paper_table=='t_postpress_ori' || $paper_table=='t_postpress_tozi' || $paper_table=='t_postpress_nori'){
    print '<p><a href="t_postpress_list.php#'.$list_id.'" class="btn-simple">戻る</a></p>';
  }
  if($paper_table=='t_ondemand_kihon' || $paper_table=='t_ondemand_scan' || $paper_table=='t_ondemand_mentsuke' || $paper_table=='t_ondemand_press' || $paper_table=='t_ondemand_meishitachi'){
    print '<p><a href="t_ondemand_list.php#'.$list_id.'" class="btn-simple">戻る</a></p>';
  }
if($paper_table=='t_prepress_check' || $paper_table=='t_prepress_hyoshi' || $paper_table=='t_prepress_semoji' || $paper_table=='t_prepress_mentsuke' || $paper_table=='t_prepress_kanri' || $paper_table=='t_prepress_nonburu' || $paper_table=='t_prepress_plate' || $paper_table=='t_prepress_p_check'){
    print '<p><a href="t_prepress_list.php#'.$list_id.'" class="btn-simple">戻る</a></p>';
  }
?>

</body>
</html>
