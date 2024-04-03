<?php
  try{
    require_once('../common/common.php');

    $post=sanitize($_POST);
    $staff_code=$post['staff_code'];
    $staff_pass=$post['staff_pass'];

    // 別ファイルに記述しているDB設定情報ファイルを読み込む
    require_once('../../conf/dsn.php');
    // mySQLに接続
    $dbh = new PDO(DSN, DB_USER, DB_PWD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql='SELECT staff_name,staff_pass,staff_kengen FROM hkt_staff WHERE staff_code=?';
    $stmt=$dbh->prepare($sql);
    $data[]=$staff_code;
    $stmt->execute($data);

    $dbh=null;

    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
    $hash=$rec['staff_pass'];

    if(password_verify($staff_pass,$hash)==false){
      print '<p>スタッフコードかパスワードが間違っています。</p>';
      print '<a href="../paper/t_paper_list.php"><p>戻る</p></a>';
    } else {
      session_start();
      $_SESSION['login']=1;
      $_SESSION['staff_code']=$staff_code;
      $_SESSION['staff_name']=$rec['staff_name'];
      $_SESSION['staff_kengen']=$rec['staff_kengen'];
      header('Location:../paper/t_paper_list.php');
      exit();
    }
  } catch(Exception $e) {
    print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
    exit();
  }
?>