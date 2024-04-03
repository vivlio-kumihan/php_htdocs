<?php
  session_start();
  session_regenerate_id(true);
  if(isset($_SESSION['login'])==false){
    print '<p>ログインされていません。</p>';
    print '<a href="../staff_login/staff_login.html"><p>ログイン画面へ</p></a>';
    exit();
  }

  require_once('../common/common.php');

  $post=sanitize($_POST);

  //本文紙単価編集分岐チェック
  //修正処理
/*  if(isset($post['t_paper_text_edit'])==true){
    if(isset($post['tanka_code'])==false){
      header('Location:tanka_ng.php');
      exit();
    }
    $tanka_code=$post['tanka_code'];
    $paper_name=$post['paper_name'];
    $paper_size=$post['paper_size'];
    $paper_me=$post['paper_me'];
    $paper_atsusa=$post['paper_atsusa'];
    $paper_price=$post['paper_price'];
    header('Location:t_paper_text_check.php?tanka_code='.$tanka_code.'&paper_name='.$paper_name.'&paper_size='.$paper_size.'&paper_me='.$paper_me.'&paper_atsusa='.$paper_atsusa.'&paper_price='.$paper_price);
    exit();
  }
  //削除処理
  if(isset($post['t_paper_text_delete'])==true){
    if(isset($post['tanka_code'])==false){
      header('Location:tanka_ng.php');
      exit();
    }
    $tanka_table='t_paper_text';  //テーブル名設定
    $tanka_code=$post['tanka_code'];
    header('Location:t_paper_delete.php?tanka_table='.$tanka_table.'&tanka_code='.$tanka_code);
    exit();
  } */
  //本文紙単価編集分岐チェック：END


  //特殊紙単価編集分岐チェック
  //修正処理
  if(isset($post['t_paper_sp_edit'])==true){
    if(isset($post['paper_code'])==false){
      header('Location:tanka_ng.php');
      exit();
    }
    $paper_code=$post['paper_code'];
    $paper_color=$post['paper_color'];
    $paper_atsusa=$post['paper_atsusa'];
    $paper_size=$post['paper_size'];
    $paper_name=$post['paper_name'];
    $paper_me=$post['paper_me'];
    $paper_number=$post['paper_number'];  ////ここから作業再開
    header('Location:t_paper_sp_check.php?paper_code='.$paper_code.'&paper_color='.$paper_color.'&paper_atsusa='.$paper_atsusa.'&paper_size='.$paper_size.'&paper_name='.$paper_name.'&paper_me='.$paper_me.'&paper_number='.$paper_number);
    exit();
  }
  //削除処理
  if(isset($post['t_paper_sp_delete'])==true){
    if(isset($post['paper_code'])==false){
      header('Location:paper_ng.php');
      exit();
    }
    $paper_table='mst_paper_ond';  //テーブル名設定
    $paper_code=$post['paper_code'];
    header('Location:t_paper_delete.php?paper_table='.$paper_table.'&paper_code='.$paper_code);
    exit();
  }
  //特殊紙単価編集分岐チェック：END


  //封筒単価編集分岐チェック
  //修正処理
/*  if(isset($post['t_paper_fuuto_edit'])==true){
    if(isset($post['tanka_code'])==false){
      header('Location:tanka_ng.php');
      exit();
    }
    $tanka_code=$post['tanka_code'];
    $paper_name=$post['paper_name'];
    $paper_size=$post['paper_size'];
    $paper_atsusa=$post['paper_atsusa'];
    $paper_price100=$post['paper_price100'];
    $paper_price1000=$post['paper_price1000'];
    $paper_price5000=$post['paper_price5000'];
    header('Location:t_paper_fuuto_check.php?tanka_code='.$tanka_code.'&paper_name='.$paper_name.'&paper_size='.$paper_size.'&paper_atsusa='.$paper_atsusa.'&paper_price100='.$paper_price100.'&paper_price1000='.$paper_price1000.'&paper_price5000='.$paper_price5000);
    exit();
  }
  //削除処理
  if(isset($post['t_paper_fuuto_delete'])==true){
    if(isset($post['tanka_code'])==false){
      header('Location:tanka_ng.php');
      exit();
    }
    $tanka_table='t_paper_fuuto';  //テーブル名設定
    $tanka_code=$post['tanka_code'];
    header('Location:t_paper_delete.php?tanka_table='.$tanka_table.'&tanka_code='.$tanka_code);
    exit();
  } */
  //封筒単価編集分岐チェック：END
?>
