<?php
setcookie('email', '', time() - 3600);
var_dump($_COOKIE);
?>
<html>
<body>
<p>クッキーが削除されました。</p>
<a href="cookie_set.php">戻る</a>
</body>
</html>