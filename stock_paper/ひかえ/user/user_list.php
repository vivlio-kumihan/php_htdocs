<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ユーザーリスト｜在庫紙管理</title>
</head>
<body>

<?php

try{
	$dsn='mysql:dbname=stock_paper;host=localhost;charset=utf8';
	$user='root';
	$password='';
	$dbh=new PDO($dsn,$user,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql='SELECT u_code,u_name,u_kengen FROM mst_user WHERE 1';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();

	$dbh=null;

	print '<p>ユーザーリスト｜在庫紙管理</p><br>';

	print '<form method="post" action="user_edit.php">';
	while(true) {
		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
		if($rec==false){
			break;
		}
		print '<p><input type="radio" name="user_code" value="'.$rec['u_code'].'">';
		print $rec['u_name'].'／';
		print $rec['u_kengen'].'</p>';
	}
	print '<input type="submit" value="修正">';
	print '</form>';
}catch(Exception $e){
		print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
		exit();
}

?>

</body>
</html>