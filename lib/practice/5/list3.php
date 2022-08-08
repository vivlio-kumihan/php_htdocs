<html>
<head>
<style>
ul{width:100px;}
.color-red{background-color:red;}
</style>
</head>
<body>
 
<ul>
<?php for ($i = 1; $i <= 20; $i++) {
	//ここに連続する処理の内容を書き込む
	if($i % 2 === 1){ ?>
	<li class="color-red">奇数</li>
	<?php }else{ ?>
	<li>偶数</li>
	<?php }

} ?>

</ul>
 
</body>
</html>
