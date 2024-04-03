<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ユーザー修正チェック｜在庫紙管理</title>
</head>
<body>

<?php

$user_code=$_POST['user_code'];
$user_name=$_POST['user_name'];
$user_kengen=$_POST['user_kengen'];
$user_pass1=$_POST['user_pass1'];
$user_pass2=$_POST['user_pass2'];

$user_name=htmlspecialchars($user_name,ENT_QUOTES,'UTF-8');
$user_kengen=htmlspecialchars($user_kengen,ENT_QUOTES,'UTF-8');
$user_pass1=htmlspecialchars($user_pass1,ENT_QUOTES,'UTF-8');
$user_pass2=htmlspecialchars($user_pass2,ENT_QUOTES,'UTF-8');

$okflg=true;


if($user_name==''){
	print '<p>ユーザー名が入力されていません。</p>';
	$okflg=false;
}else{
	print '<P>ユーザー名：';
	print $user_name;
	print '</p>';
}

if($user_kengen=='一般' || $user_kengen=='管理'){
	print '<p>ユーザー権限：'.$user_kengen.'</p>';
}else{
	print '<p>ユーザー権限が正しくありません。</p>';
	$okflg=false;
}

if($user_pass1==''){
	print '<p>パスワードが入力されていません。</p>';
	$okflg=false;
}

if($user_pass1!=$user_pass2){
	print '<p>パスワードが一致しません。</p>';
	$okflg=false;
}

if($okflg==false){
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
}else{
	$user_pass1=md5($user_pass1);
	print '<form method="post" action="user_edit_done.php">';
	print '<input type="hidden" name="user_code" value="'.$user_code.'">';
	print '<input type="hidden" name="user_name" value="'.$user_name.'">';
	print '<input type="hidden" name="user_kengen" value="'.$user_kengen.'">';
	print '<input type="hidden" name="user_pass" value="'.$user_pass1.'">';
	print '<br>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="OK">';
	print '</form>';
}

?>

</body>
</html>