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
<title>用紙情報削除</title>
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

<h1>用紙情報削除</h1>

<?php
  require_once('../common/common.php');

  $get=sanitize($_GET);
  $paper_table=$get['paper_table'];
  $paper_code=$get['paper_code'];

  switch ($paper_table) {
    //本文用紙
/*    case 't_paper_text':
      try{
        // 別ファイルに記述しているDB設定情報ファイルを読み込む
        require_once('../../conf/stock_paper_dsn.php');
        // mySQLに接続
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql='SELECT p_code,p_color,p_atsusa,p_size,p_name,p_me,p_number FROM '.$paper_table.' WHERE paper_code=?';
        $stmt=$dbh->prepare($sql);
        $data[]=$paper_code;
        $stmt->execute($data);

        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        $paper_name=$rec['paper_name'];
        $paper_size=$rec['paper_size'];
        $paper_me=$rec['paper_me'];
        $paper_atsusa=$rec['paper_atsusa'];
        $paper_price=$rec['paper_price'];
        $list_id='paper_text';

        $dbh=null;

      } catch(Exception $e) {

        print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
        exit();
      }
      print '<p>本文用紙</p>';
      print '<p>用紙名：'.$paper_name.'</p>';
      print '<p>サイズ：'.$paper_size.'</p>';
      print '<p>紙目：'.$paper_me.'</p>';
      print '<p>紙厚：'.$paper_atsusa.'</p>';
      print '<p>単価：'.$paper_price.'</p>';
      break;*/

    //特殊紙
    case 'mst_paper':
      try{
        // 別ファイルに記述しているDB設定情報ファイルを読み込む
        require_once('../../conf/stock_paper_dsn.php');
        // mySQLに接続
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql='SELECT p_color,p_atsusa,p_size,p_name,p_me,p_number FROM '.$paper_table.' WHERE p_code=?';
        $stmt=$dbh->prepare($sql);
        $data[]=$paper_code;
        $stmt->execute($data);

        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        $paper_color=$rec['p_color'];
        $paper_atsusa=$rec['p_atsusa'];
        $paper_size=$rec['p_size'];
        $paper_name=$rec['p_name'];
        $paper_me=$rec['p_me'];
        $paper_number=$rec['p_number'];
        $list_id='paper_sp';

        $dbh=null;

      } catch(Exception $e) {

        print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
        exit();
      }
      print '<p>特殊紙</p>';
      print '<p>用紙色：'.$paper_color.'</p>';
      print '<p>紙　厚：'.$paper_atsusa.'</p>';
      print '<p>サイズ：'.$paper_size.'</p>';
      print '<p>用紙名：'.$paper_name.'</p>';
      print '<p>紙　目：'.$paper_me.'</p>';
      print '<p>枚　数：'.$paper_number.'</p>';
      break;

    //封筒
/*    case 't_paper_fuuto':
      try{
        // 別ファイルに記述しているDB設定情報ファイルを読み込む
        require_once('../../conf/dsn.php');
        // mySQLに接続
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql='SELECT paper_name,paper_size,paper_atsusa,paper_price100,paper_price1000,paper_price5000,entry FROM '.$tanka_table.' WHERE code=?';
        $stmt=$dbh->prepare($sql);
        $data[]=$tanka_code;
        $stmt->execute($data);

        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        $paper_name=$rec['paper_name'];
        $paper_size=$rec['paper_size'];
        $paper_atsusa=$rec['paper_atsusa'];
        $paper_price100=$rec['paper_price100'];
        $paper_price1000=$rec['paper_price1000'];
        $paper_price5000=$rec['paper_price5000'];
        $list_id='paper_fuuto';

        $dbh=null;

      } catch(Exception $e) {

        print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
        exit();
      }
      print '<p>封筒</p>';
      print '<p>用紙名：'.$paper_name.'</p>';
      print '<p>サイズ：'.$paper_size.'</p>';
      print '<p>紙厚：'.$paper_atsusa.'</p>';
      print '<p>100枚迄単価：'.$paper_price100.'</p>';
      print '<p>1000枚迄単価：'.$paper_price1000.'</p>';
      print '<p>5000枚迄単価：'.$paper_price5000.'</p>';
      break;

    default:
      print '<p>その他</p>';
      break;*/
  }
?>

<br />
<p>この単価を削除してよろしいですか？</p>
<br />
<form method="post" action="paper_delete_done.php">
  <input type="hidden" name="paper_table" value="<?php print $paper_table; ?>">
  <input type="hidden" name="paper_code" value="<?php print $paper_code; ?>">
  <input type="hidden" name="list_id" value="<?php print $list_id; ?>">
  <br />
  <input type="button" onclick="history.back()" class="btn-simple" value="戻る">
  <input type="submit" class="btn-simple" value="ＯＫ">
</form>

</body>
</html>
