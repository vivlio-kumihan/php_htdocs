<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ユーザー追加｜在庫紙管理</title>
</head>
<body>

<p>ユーザー追加</p>
<form method="post" action="user_add_check.php">
	<p>ユーザー名を入力してください。</p>
	<input type="text" name="user_name" style="width: 200px">
	<p>ユーザー権限を選択してください。</p>
	<select name="user_kengen">
		<option value="一般" selected>一般</option>
		<option value="管理">管理</option>
	</select>
	<p>パスワードを入力してください。</p>
	<input type="password" name="user_pass1" style="width: 100px">
	<p>パスワードをもう１度入力してください。</p>
	<input type="password" name="user_pass2" style="width: 100px">
	<br>
	<input type="button" onclick="history.back()" value="戻る">
	<input type="submit" value="OK">
</form>

</body>
</html>