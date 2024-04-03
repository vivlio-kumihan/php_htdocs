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
<title>封筒単価チェック</title>
</head>
<body>

<h2>封筒単価チェック</h2>

<?php
  require_once('../common/common.php');

  if(isset($_POST['t_paper_fuuto_add'])==true){
    $post=sanitize($_POST);
    $paper_name=$post['paper_name'];
    $paper_size=$post['paper_size'];
    $paper_atsusa=$post['paper_atsusa'];
    $paper_price100=$post['paper_price100'];
    $paper_price1000=$post['paper_price1000'];
    $paper_price5000=$post['paper_price5000'];
  } else {
    $get=sanitize($_GET);
    $tanka_code=$get['tanka_code'];
    $paper_name=$get['paper_name'];
    $paper_size=$get['paper_size'];
    $paper_atsusa=$get['paper_atsusa'];
    $paper_price100=$get['paper_price100'];
    $paper_price1000=$get['paper_price1000'];
    $paper_price5000=$get['paper_price5000'];
  }

  $okflg=true;

  if($paper_name=='クラフト' || $paper_name=='ホワイト' || $paper_name=='コニーカラー' || $paper_name=='フレッシュトーン' || $paper_name=='洋２ホワイト'){
    print '<p>封筒名：'.$paper_name.'</p>';
  } else {
    print '<p>封筒名が正しくありません。</p>';
    $okflg=false;
  }

  if($paper_size=='長４' || $paper_size=='長３' || $paper_size=='角３' || $paper_size=='角２' || $paper_size=='洋形'){
    print '<p>サイズ：'.$paper_size.'</p>';
  } else {
    print '<p>サイズが正しくありません。</p>';
    $okflg=false;
  }

  if($paper_atsusa=='70' || $paper_atsusa=='80' || $paper_atsusa=='85' || $paper_atsusa=='100'){
    print '<p>紙厚：'.$paper_atsusa.'</p>';
  } else {
    print '<p>紙厚が正しくありません。</p>';
    $okflg=false;
  }

  if(is_numeric($paper_price100)==0){
    print '<p>単価は、半角数字で入力してください。</p>';
    $okflg=false;
  } else {
    print '<p>単価：'.$paper_price100.'</p>';
  }

  if(is_numeric($paper_price1000)==0){
    print '<p>単価は、半角数字で入力してください。</p>';
    $okflg=false;
  } else {
    print '<p>単価：'.$paper_price1000.'</p>';
  }

  if(is_numeric($paper_price5000)==0){
    print '<p>単価は、半角数字で入力してください。</p>';
    $okflg=false;
  } else {
    print '<p>単価：'.$paper_price5000.'</p>';
  }

  if($okflg==true){
    if(isset($post['t_paper_fuuto_add'])==true){
      print '<p>上記内容で追加します。</p>';
      print '<form method="post" action="t_paper_fuuto_done.php">';
        print '<input type="hidden" name="paper_done_type" value="t_paper_fuuto_add">';
        print '<input type="hidden" name="paper_name" value="'.$paper_name.'">';
        print '<input type="hidden" name="paper_size" value="'.$paper_size.'">';
        print '<input type="hidden" name="paper_atsusa" value="'.$paper_atsusa.'">';
        print '<input type="hidden" name="paper_price100" value="'.$paper_price100.'">';
        print '<input type="hidden" name="paper_price1000" value="'.$paper_price1000.'">';
        print '<input type="hidden" name="paper_price5000" value="'.$paper_price5000.'">';
        print '<br />';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '<input type="submit" value="ＯＫ">';
      print '</form>';
    } else {
      print '<p>上記内容で修正します。</p>';
      print '<form method="post" action="t_paper_fuuto_done.php">';
        print '<input type="hidden" name="paper_done_type" value="t_paper_fuuto_edit">';
        print '<input type="hidden" name="tanka_code" value="'.$tanka_code.'">';
        print '<input type="hidden" name="paper_name" value="'.$paper_name.'">';
        print '<input type="hidden" name="paper_size" value="'.$paper_size.'">';
        print '<input type="hidden" name="paper_atsusa" value="'.$paper_atsusa.'">';
        print '<input type="hidden" name="paper_price100" value="'.$paper_price100.'">';
        print '<input type="hidden" name="paper_price1000" value="'.$paper_price1000.'">';
        print '<input type="hidden" name="paper_price5000" value="'.$paper_price5000.'">';
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
