<?php
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $product = $_POST['product'];
    $num = $_POST['num'];
    $_SESSION['cart'][$product] = $num;
}

$cart = array();
if(isset($_SESSION['cart'])){
$cart = $_SESSION['cart'];
}
var_dump($cart);
?>
<html>
<body>
<h1>商品一覧</h1>
<a href="cart.php">カートを見る</a>
<table style="text-align:center">
    <tr><th>商品</th><th>数量</th><th>ボタン</th></tr>
    <form action="" method="post">
    <tr>
        <td>業務用デスク</td>
        <td>
            <select name="num">
            <?php for($i = 1; $i < 10; $i++):?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
            <?php endfor; ?>
            </select>
        </td>
        <td>
            <input type="hidden" name="product" value="desk_01">
            <?php if(isset($cart['desk_01']) === TRUE):?>
            <p>追加済み</p>
            <?php else: ?>
            <input type="submit" value="カートに入れる">
            <?php endif;?>
        </td>
    </tr>
    </form>
    <form action="" method="post">
    <tr>
        <td>快適椅子</td>
        <td>
            <select name="num">
            <?php for($i = 1; $i < 10; $i++):?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
            <?php endfor; ?>
            </select>
        </td>
        <td>
            <input type="hidden" name="product" value="chair_07">
            <?php if(isset($cart['chair_07']) === TRUE): ?>
            <p>追加済み</p>
            <?php else: ?>
            <input type="submit" value="カートに入れる">
            <?php endif; ?>
        </td>
    </tr>
    </form>
</table>
</body>
</html>