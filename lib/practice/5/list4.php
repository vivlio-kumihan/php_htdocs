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
	<li class="color-red"><?php echo $i;?></li>
	<?php }else{ ?>
	<li><?php echo $i;?></li>
	<?php }

} ?>

</ul>
 
</body>
</html>
