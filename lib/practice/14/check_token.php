<?php

function check_token($token) {
    if (empty($_SESSION['token']) || ($_SESSION['token'] !== $token)) {
        echo "不正なPOSTが行われました！";
        exit;
    }
}

session_start();

$name = '';
$token = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
$name = $_POST['name'];
$token = $_POST['token'];
}

check_token($token);
?>
<html>
<body>
<h1>トークン受信ページ</h1>
<p><?php echo $name;?>さん、トークンを確認しました。</p>
</body>
</html>

