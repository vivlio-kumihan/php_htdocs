<?php
session_start();
$_SESSION['cart']['desk_01'] = 12;
unset($_SESSION['cart']['desk_01']);
var_dump($_SESSION);
$profile = $_SESSION['profile'];
$cart = $_SESSION['cart'];

?>

<html>
<body>
<p>こんにちは、<?php echo $profile['user_name']; ?>さん　
地域：<?php echo $profile['location']; ?></p>
<h1>カートの中身</h1>
<hr>
<table border=1>
<tr><th>商品ID</th><th>個数</th></tr>
<?php foreach($cart as $key => $var): ?>
<tr align="center"><td><?php echo $key; ?></td><td><?php echo $var;?></td></tr>
<?php endforeach; ?>
</table>
<a href="session_set.php">戻る</a>
</body>
</html>