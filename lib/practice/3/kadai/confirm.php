<?php
$name = $_POST['name'];
$hobby = $_POST['hobby'];
?>

<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<h1>受信ページ</h1>
<p>あなたの名前は<?php echo $name;?>さんです。</p>
<p>趣味は<?php echo $hobby;?>です。</p>
<p>こちらの情報でよろしいですか？</p>
<form action="complete.php" method="POST">
<input type="hidden" name="name" value="<?php echo $name;?>">
<input type="hidden" name="hobby" value="<?php echo $hobby;?>">
<input type="submit" value="登録">
</form>
</body>
</html>