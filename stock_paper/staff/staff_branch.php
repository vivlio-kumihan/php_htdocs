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

  if(isset($post['staff_add'])==true){
    header('Location:staff_add.php');
    exit();
  }

  if(isset($post['staff_edit'])==true){
    if(isset($post['staff_code'])==false){
      header('Location:staff_ng.php');
      exit();
    }
    $staff_code=$post['staff_code'];
    header('Location:staff_edit.php?staff_code='.$staff_code);
    exit();
  }

  if(isset($post['staff_delete'])==true){
    if(isset($post['staff_code'])==false){
      header('Location:staff_ng.php');
      exit();
    }
    $staff_code=$post['staff_code'];
    header('Location:staff_delete.php?staff_code='.$staff_code);
    exit();
  }
?>
