<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員専用ページ</title>
</head>
<body>
<p>こんにちは<?php echo html_escape($member['name']); ?>さん。
Email:<?php echo html_escape($member['email']); ?>) <a href="logout.php">ログアウト</a></p>
<h1>会員専用ページ</h1>
<hr width="300px" align="left">
<p style="font-size:small">こちらはログイン後の画面です</p>
<h2>会員一覧</h2>
<ul>
<?php foreach($members as $member): ?>
<li><?php echo html_escape($member['name']); ?></li>
<?php endforeach; ?>
</body>
</html>