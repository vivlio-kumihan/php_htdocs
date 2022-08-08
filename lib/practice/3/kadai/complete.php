<?php
$name = $_POST['name'];
$hobby = $_POST['hobby'];
?>

<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<h1>登録ページ</h1>
<p>こんにちは<?php echo $name; ?>さん</p>
<p>趣味は<?php echo $hobby;?>ですね</p>
<p>登録完了いたしました。</p>
<p></p>
</body>
</html>