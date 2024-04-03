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

<h2>用紙情報削除完了</h2>

<?php
  try{
    require_once('../common/common.php');

    $post=sanitize($_POST);
    $paper_table=$post['paper_table'];
    $paper_code=$post['paper_code'];
    $list_id=$post['list_id'];

    // 別ファイルに記述しているDB設定情報ファイルを読み込む
    require_once('../../conf/dsn.php');
    // mySQLに接続
    $dbh = new PDO(DSN, DB_USER, DB_PWD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='DELETE FROM '.$tanka_table.' WHERE code=?';
    $stmt=$dbh->prepare($sql);
    $data[]=$tanka_code;
    $stmt->execute($data);

    $dbh=null;

    print '<p>削除しました。</p>';

  } catch(Exception $e) {

    print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
    exit();
  }

  if($tanka_table=='t_press_k' || $tanka_table=='t_press_4c' || $tanka_table=='t_press_fuuto' || $tanka_table=='t_press_spcolor'){
    print '<p><a href="t_press_list.php#'.$list_id.'">戻る</a></p>';
  }
  if($tanka_table=='t_paper_text' || $tanka_table=='t_paper_sp' || $tanka_table=='t_paper_fuuto'){
    print '<p><a href="t_paper_list.php#'.$list_id.'">戻る</a></p>';
  }
  if($tanka_table=='t_postpress_choai' || $tanka_table=='t_postpress_maki' || $tanka_table=='t_postpress_mikaeshi' || $tanka_table=='t_postpress_ori' || $tanka_table=='t_postpress_tozi' || $tanka_table=='t_postpress_nori'){
    print '<p><a href="t_postpress_list.php#'.$list_id.'">戻る</a></p>';
  }
  if($tanka_table=='t_ondemand_kihon' || $tanka_table=='t_ondemand_scan' || $tanka_table=='t_ondemand_mentsuke' || $tanka_table=='t_ondemand_press' || $tanka_table=='t_ondemand_meishitachi'){
    print '<p><a href="t_ondemand_list.php#'.$list_id.'">戻る</a></p>';
  }
if($tanka_table=='t_prepress_check' || $tanka_table=='t_prepress_hyoshi' || $tanka_table=='t_prepress_semoji' || $tanka_table=='t_prepress_mentsuke' || $tanka_table=='t_prepress_kanri' || $tanka_table=='t_prepress_nonburu' || $tanka_table=='t_prepress_plate' || $tanka_table=='t_prepress_p_check'){
    print '<p><a href="t_prepress_list.php#'.$list_id.'">戻る</a></p>';
  }
?>

</body>
</html>
