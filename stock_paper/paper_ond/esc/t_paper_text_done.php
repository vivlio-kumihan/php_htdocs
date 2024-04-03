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
<title>本文紙単価完了</title>
</head>
<body>

<?php
  try{
    require_once('../common/common.php');

    $post=sanitize($_POST);
    $paper_done_type=$post['paper_done_type'];
    if($paper_done_type=='t_paper_text_add'){
      print '<h2>本文紙単価入力</h2>';
    } else {
      print '<h2>本文紙単価編集</h2>';
      $tanka_code=$post['tanka_code'];
    }
    $paper_name=$post['paper_name'];
    $paper_size=$post['paper_size'];
    $paper_me=$post['paper_me'];
    $paper_atsusa=$post['paper_atsusa'];
    $paper_price=$post['paper_price'];

    // 別ファイルに記述しているDB設定情報ファイルを読み込む
    require_once('../../conf/dsn.php');
    // mySQLに接続
    $dbh = new PDO(DSN, DB_USER, DB_PWD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    if($paper_done_type=='t_paper_text_add'){
      $sql='INSERT INTO t_paper_text(paper_name,paper_size,paper_me,paper_atsusa,paper_price) VALUES (?,?,?,?,?)';
      $stmt=$dbh->prepare($sql);
      $data[]=$paper_name;
      $data[]=$paper_size;
      $data[]=$paper_me;
      $data[]=$paper_atsusa;
      $data[]=$paper_price;
      $stmt->execute($data);

      $dbh=null;

      print '<p>'.$paper_name.'の単価を追加しました。</p>';

    } else {

      $sql='UPDATE t_paper_text SET paper_name=?,paper_size=?,paper_me=?,paper_atsusa=?,paper_price=? WHERE code=?';
      $stmt=$dbh->prepare($sql);
      $data[]=$paper_name;
      $data[]=$paper_size;
      $data[]=$paper_me;
      $data[]=$paper_atsusa;
      $data[]=$paper_price;
      $data[]=$tanka_code;
      $stmt->execute($data);

      $dbh=null;

      print '<p>'.$paper_name.'の単価を修正しました。</p>';
    }

  } catch(Exception $e) {

    print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
    exit();
  }
?>

<p><a href="t_paper_list.php">戻る</a></p>

</body>
</html>
