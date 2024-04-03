<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ユーザー修正｜在庫紙管理</title>
</head>
<body>

<?php

try{
	$user_code=$_POST['user_code'];

	$dsn='mysql:dbname=stock_paper;host=localhost;charset=utf8';
	$user='root';
	$password='';
	$dbh=new PDO($dsn,$user,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql='SELECT u_name,u_kengen FROM mst_user WHERE u_code=?';
	$stmt=$dbh->prepare($sql);
	$data[]=$user_code;
	$stmt->execute($data);

	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	$user_name=$rec['u_name'];
	$user_kengen=$rec['u_kengen'];

	$dbh=null;
}catch(Exception $e){
		print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
		exit();
}

?>

<P>ユーザー修正｜在庫紙管理</P>
<br>
<P>ユーザーコード</P>
<?php print '<p>'.$user_code.'</p>'; ?>
<form method="post" action="user_edit_check.php" accept-charset="utf-8">
	<input type="hidden" name="user_code" value="<?php print $user_code; ?>">
	<p>ユーザー名</p>
	<input type="text" name="user_name" style="width: 10em" value="<?php print $user_name ?>"><br>
	<p>ユーザー権限</p>
	<input type="text" name="user_kengen" style="width: 10em" value="<?php print $user_kengen ?>"><br>
	<p>パスワードを入力してください。</p>
	<input type="password" name="user_pass1" style="width: 10em"><br>
	<p>パスワードをもう１度入力してください。</p>
	<input type="password" name="user_pass2" style="width: 10em"><br>
	<br>
	<input type="button" onclick="history.back()" value="戻る">
	<input type="submit" value="OK">
</form>

</body>
</html>