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
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>スタッフ削除</title>
</head>
<body>

<h2>スタッフ削除</h2>

<?php
  try{
    require_once('../common/common.php');

    $post=sanitize($_POST);
    $staff_code=$post['staff_code'];

    // 別ファイルに記述しているDB設定情報ファイルを読み込む
    require_once('../../conf/dsn.php');
    // mySQLに接続
    $dbh = new PDO(DSN, DB_USER, DB_PWD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='DELETE FROM hkt_staff WHERE staff_code=?';
    $stmt=$dbh->prepare($sql);
    $data[]=$staff_code;
    $stmt->execute($data);

    $dbh=null;

    print '<p>削除しました。</p>';

  } catch(Exception $e) {

    print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
    exit();
  }
?>

<p><a href="staff_list.php">戻る</a></p>

</body>
</html>
