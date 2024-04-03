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
<title>本文紙単価チェック</title>
</head>
<body>

<h2>本文紙単価チェック</h2>

<?php
  require_once('../common/common.php');

  if(isset($_POST['t_paper_text_add'])==true){
    $post=sanitize($_POST);
    $paper_name=$post['paper_name'];
    $paper_size=$post['paper_size'];
    $paper_me=$post['paper_me'];
    $paper_atsusa=$post['paper_atsusa'];
    $paper_price=$post['paper_price'];
  } else {
    $get=sanitize($_GET);
    $tanka_code=$get['tanka_code'];
    $paper_name=$get['paper_name'];
    $paper_size=$get['paper_size'];
    $paper_me=$get['paper_me'];
    $paper_atsusa=$get['paper_atsusa'];
    $paper_price=$get['paper_price'];
  }

  $okflg=true;

  if($paper_name=='上質' || $paper_name=='日本の色上質' || $paper_name=='紀州の色上質' || $paper_name=='書籍（淡クリームキンマリ）' || $paper_name=='コート' || $paper_name=='マットコート'){
    print '<p>用紙名：'.$paper_name.'</p>';
  } else {
    print '<p>用紙名が正しくありません。</p>';
    $okflg=false;
  }

  if($paper_size=='四六判８切' || $paper_size=='Ａ判４切' || $paper_size=='菊判４切'){
    if($paper_size=='菊判４切' && ($paper_name=='日本の色上質' || $paper_name=='紀州の色上質' || $paper_name=='書籍（淡クリームキンマリ）')){
      print '<p>サイズが正しくありません。</p>';
      $okflg=false;
    } else {
    print '<p>サイズ：'.$paper_size.'</p>';
    }
  } else {
    print '<p>サイズが正しくありません。</p>';
    $okflg=false;
  }

  if($paper_me=='Ｔ・Ｙ目' || $paper_me=='Ｔ目' || $paper_me=='Ｙ目'){
    print '<p>紙目：'.$paper_me.'</p>';
  } else {
    print '<p>紙目が正しくありません。</p>';
    $okflg=false;
  }

  if(is_numeric($paper_atsusa)==true || $paper_atsusa=='薄口' || $paper_atsusa=='中厚' || $paper_atsusa=='厚口' || $paper_atsusa=='特厚' || $paper_atsusa=='最厚' || $paper_atsusa=='超厚'){
    print '<p>紙厚：'.$paper_atsusa.'</p>';
  } else {
    print '<p>紙厚が正しくありません。</p>';
    $okflg=false;
  }

  if(is_numeric($paper_price)==0){
    print '<p>単価は、半角数字で入力してください。</p>';
    $okflg=false;
  } else {
    print '<p>単価：'.$paper_price.'</p>';
  }

  if($okflg==true){
    if(isset($post['t_paper_text_add'])==true){
      print '<p>上記内容で追加します。</p>';
      print '<form method="post" action="t_paper_text_done.php">';
        print '<input type="hidden" name="paper_done_type" value="t_paper_text_add">';
        print '<input type="hidden" name="paper_name" value="'.$paper_name.'">';
        print '<input type="hidden" name="paper_size" value="'.$paper_size.'">';
        print '<input type="hidden" name="paper_me" value="'.$paper_me.'">';
        print '<input type="hidden" name="paper_atsusa" value="'.$paper_atsusa.'">';
        print '<input type="hidden" name="paper_price" value="'.$paper_price.'">';
        print '<br />';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '<input type="submit" value="ＯＫ">';
      print '</form>';
    } else {
      print '<p>上記内容で修正します。</p>';
      print '<form method="post" action="t_paper_text_done.php">';
        print '<input type="hidden" name="paper_done_type" value="t_paper_text_edit">';
        print '<input type="hidden" name="tanka_code" value="'.$tanka_code.'">';
        print '<input type="hidden" name="paper_name" value="'.$paper_name.'">';
        print '<input type="hidden" name="paper_size" value="'.$paper_size.'">';
        print '<input type="hidden" name="paper_me" value="'.$paper_me.'">';
        print '<input type="hidden" name="paper_atsusa" value="'.$paper_atsusa.'">';
        print '<input type="hidden" name="paper_price" value="'.$paper_price.'">';
        print '<br />';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '<input type="submit" value="ＯＫ">';
      print '</form>';
    }
  } else {
    print '<form><input type="button" onclick="history.back()" value="戻る"></form>';
  }
?>

</body>
</html>
