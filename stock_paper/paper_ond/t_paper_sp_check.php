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
<title>入力内容チェック</title>
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

<h1>入力内容チェック</h1>

<?php
  require_once('../common/common.php');

  if(isset($_POST['t_paper_sp_add'])==true){
    $post=sanitize($_POST);
    $paper_color=$post['paper_color'];
    $paper_atsusa=$post['paper_atsusa'];
    $paper_size=$post['paper_size'];
    $paper_name=$post['paper_name'];
    $paper_me=$post['paper_me'];
    $paper_number=$post['paper_number'];
    $paper_entryuser=$_SESSION['staff_name'];
  } else {
    $get=sanitize($_GET);
    $paper_code=$get['paper_code'];
    $paper_color=$get['paper_color'];
    $paper_atsusa=$get['paper_atsusa'];
    $paper_size=$get['paper_size'];
    $paper_name=$get['paper_name'];
    $paper_me=$get['paper_me'];
    $paper_number=$get['paper_number'];
    $paper_entryuser=$_SESSION['staff_name'];
  }

  $okflg=true;

  if($paper_color!=''){
    print '<p>用紙色：'.$paper_color.'</p>';
  } else {
    print '<p>用紙色が入力されていません。</p>';
    $okflg=false;
  }

#  if(preg_match('/\A[0-9]+\z/',$paper_atsusa)==1 || $paper_atsusa=='薄口' || $paper_atsusa=='中厚口' || $paper_atsusa=='厚口' || $paper_atsusa=='特厚口'|| $paper_atsusa=='最厚口'|| $paper_atsusa=='超厚口'){
  if($paper_atsusa!=''){
    print '<p>紙　厚：'.$paper_atsusa.'</p>';
  } else {
    print '<p>紙厚が正しくありません。</p>';
    $okflg=false;
  }

  if($paper_size!=''){
#  if($paper_size=='Ａ判８切' || $paper_size=='Ａ判４切' || $paper_size=='四六判８切' || $paper_size=='四六判４切' || $paper_size=='菊判４切'){
    print '<p>サイズ：'.$paper_size.'</p>';
  } else {
    print '<p>サイズが正しくありません。</p>';
    $okflg=false;
  }

  if($paper_name=='日本の色上質' || $paper_name=='紀州の色上質' || $paper_name=='レザック６６' || $paper_name=='レザック７５' || $paper_name=='レザック８０つむぎ' || $paper_name=='レザック８２ろうけつ' || $paper_name=='その他'){
    print '<p>用紙名：'.$paper_name.'</p>';
  } else {
    print '<p>用紙名が正しくありません。</p>';
    $okflg=false;
  }

  if($paper_me=='T' || $paper_me=='Y'){
    print '<p>紙　目：'.$paper_me.'</p>';
  } else {
    print '<p>紙目が正しくありません。Ｔ目かＹ目を選んでください。</p>';
    $okflg=false;
  }

  if(preg_match('/\A[0-9]+\z/',$paper_number)==0){
    print '<p>枚数は、半角数字で入力してください。</p>';
    $okflg=false;
  } else {
    print '<p>枚　数：'.$paper_number.'</p>';
  }

  if($okflg==true){
    if(isset($post['t_paper_sp_add'])==true){
      print '<br><p>上記内容で追加します。</p>';
      print '<form method="post" action="t_paper_sp_done.php">';
        print '<input type="hidden" name="paper_done_type" value="t_paper_sp_add">';
        print '<input type="hidden" name="paper_color" value="'.$paper_color.'">';
        print '<input type="hidden" name="paper_atsusa" value="'.$paper_atsusa.'">';
        print '<input type="hidden" name="paper_size" value="'.$paper_size.'">';
        print '<input type="hidden" name="paper_name" value="'.$paper_name.'">';
        print '<input type="hidden" name="paper_me" value="'.$paper_me.'">';
        print '<input type="hidden" name="paper_number" value="'.$paper_number.'">';
        print '<input type="hidden" name="paper_entryuser" value="'.$paper_entryuser.'">';
        print '<br />';
        print '<input type="button" onclick="history.back()" class="btn-simple" value="戻る">';
        print '<input type="submit" class="btn-simple" value="ＯＫ">';
      print '</form>';
    } else {
      print '<br><p>上記内容で修正します。</p>';
      print '<form method="post" action="t_paper_sp_done.php">';
        print '<input type="hidden" name="paper_done_type" value="t_paper_sp_edit">';
        print '<input type="hidden" name="paper_code" value="'.$paper_code.'">';
        print '<input type="hidden" name="paper_color" value="'.$paper_color.'">';
        print '<input type="hidden" name="paper_atsusa" value="'.$paper_atsusa.'">';
        print '<input type="hidden" name="paper_size" value="'.$paper_size.'">';
        print '<input type="hidden" name="paper_name" value="'.$paper_name.'">';
        print '<input type="hidden" name="paper_me" value="'.$paper_me.'">';
        print '<input type="hidden" name="paper_number" value="'.$paper_number.'">';
        print '<input type="hidden" name="paper_entryuser" value="'.$paper_entryuser.'">';
        print '<br />';
        print '<input type="button" onclick="history.back()" class="btn-simple" value="戻る">';
        print '<input type="submit" class="btn-simple" value="ＯＫ">';
      print '</form>';
    }
  } else {
    print '<br />';
    print '<form><input type="button" onclick="history.back()" class="btn-simple" value="戻る"></form>';
  }
?>

</div>

</body>
</html>
