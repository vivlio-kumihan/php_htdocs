<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ユーザー追加完了｜在庫紙管理</title>
</head>
<body>

<?php

try{
	$user_name=$_POST['user_name'];
	$user_kengen=$_POST['user_kengen'];
	$user_pass=$_POST['user_pass'];

	$user_name=htmlspecialchars($user_name,ENT_QUOTES,'UTF-8');
	$user_kengen=htmlspecialchars($user_kengen,ENT_QUOTES,'UTF-8');
	$user_pass=htmlspecialchars($user_pass,ENT_QUOTES,'UTF-8');

	$dsn='mysql:dbname=stock_paper;host=localhost;charset=utf8';
	$user='root';
	$password='';
	$dbh=new PDO($dsn,$user,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql='INSERT INTO mst_user(u_name,u_pass,u_kengen) VALUES (?,?,?)';
	$stmt=$dbh->prepare($sql);
	$data[]=$user_name;
	$data[]=$user_pass;
	$data[]=$user_kengen;
	$stmt->execute($data);

	$dbh=null;

	print '<p>'.$user_name;
	print 'さんを追加しました。</p>';
}catch(Exception $e){
	print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
	exit();
}

?>

<p><a href="user_list.php">戻る</a></p>

</body>
</html>