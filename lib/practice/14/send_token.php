<?php

function set_token() {
    $token = sha1(uniqid(mt_rand(), true));
    $_SESSION['token'] = $token;
    return $token;
}

session_start();
$token = set_token();
?>

<html>
<body>
<h1>トークン送信用フォーム</h1>
<form action="./check_token.php" method="post">
名前：<input type="text" name="name">
<input type="hidden" name="token" value="<?php echo $token;?>">
<input type="submit">
</form>
</body>
</html>