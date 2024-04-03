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
<title>入力完了</title>
</head>
<body>

<div id="container">

<?php
  if(isset($_SESSION['login'])==false){
#    print '<p>ログインされていません。</p>';
#    print '<a href="../staff_login/staff_login.html" class="btn-shadow"><p>ログイン画面へ</p></a>';
#    print '<form method="post" action="../staff_login/staff_login.html"><input type="submit" value="ログイン" class="btn-shadow"></form>';
    print '<p><form method="post" action="../staff_login/staff_login_check.php"><input type="submit" value="ログイン" class="btn-shadow">　ID：<input type="text" name="staff_code">　パスワード：<input type="password" name="staff_pass"></form>';
#    exit();
  } else {
    print '<p><form method="post" action="../staff_login/staff_logout.php"><input type="submit" value="ログアウト" class="btn-shadow">　'.$_SESSION['staff_name'].'さんログイン中</form></p>';
  }
?>

<h1>入力完了</h1>

<?php
  try{
    require_once('../common/common.php');

    $post=sanitize($_POST);
    $paper_done_type=$post['paper_done_type'];
    if($paper_done_type=='t_paper_sp_add'){
      print '<h2>【入　力】</h2>';
    } else {
      print '<h2>【修　正】</h2>';
      $paper_code=$post['paper_code'];
    }
    $paper_color=$post['paper_color'];
    $paper_atsusa=$post['paper_atsusa'];
    $paper_size=$post['paper_size'];
    $paper_name=$post['paper_name'];
    $paper_me=$post['paper_me'];
    $paper_number=$post['paper_number'];
    $paper_entryuser=$post['paper_entryuser'];

    // 別ファイルに記述しているDB設定情報ファイルを読み込む
    require_once('../../conf/stock_paper_dsn.php');
    // mySQLに接続
    $dbh = new PDO(DSN, DB_USER, DB_PWD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    if($paper_done_type=='t_paper_sp_add'){
      $sql='INSERT INTO mst_paper(p_color,p_atsusa,p_size,p_name,p_me,p_number,p_entryuser) VALUES (?,?,?,?,?,?,?)';
      $stmt=$dbh->prepare($sql);
      $data[]=$paper_color;
      $data[]=$paper_atsusa;
      $data[]=$paper_size;
      $data[]=$paper_name;
      $data[]=$paper_me;
      $data[]=$paper_number;
      $data[]=$paper_entryuser;
      $stmt->execute($data);

      $dbh=null;

      print '<br>';
      print '<p>'.$paper_color.'の情報を追加しました。</p>';

    } else {

      $sql='UPDATE mst_paper SET p_color=?,p_atsusa=?,p_size=?,p_name=?,p_me=?,p_number=?,p_entryuser=? WHERE p_code=?';
      $stmt=$dbh->prepare($sql);
      $data[]=$paper_color;
      $data[]=$paper_atsusa;
      $data[]=$paper_size;
      $data[]=$paper_name;
      $data[]=$paper_me;
      $data[]=$paper_number;
      $data[]=$paper_entryuser;
      $data[]=$paper_code;
      $stmt->execute($data);

      $dbh=null;

      print '<br>';
      print '<p>'.$paper_color.'の情報を修正しました。</p>';
    }

  } catch(Exception $e) {

    print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
    exit();
  }
?>

<br>
<p><a href="t_paper_list.php#paper_sp" class="btn-simple">戻る</a></p>

</div>

</body>
</html>
