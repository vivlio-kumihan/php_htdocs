<?php
 
$arrays = array(
 
    1 => array(
    'name' => '鈴木',
    'hobby' => 'テニス',
    'email' => 'sample@sample.com'
    ),
    2 => array(
    'name' => '山田',
    'hobby' => 'パソコン',
    'email' => 'sample2@sample2.com'
    ),
    3 => array(
    'name' => '斉藤',
    'hobby' => '水泳',
    'email' => 'sample3@sample3.com'
    )
 
  );
//echo $arrays[2]['name'];
?>
<html>
<body>
 
<table border="1">
<tr><th>名前</th><th>趣味</th><th>メールアドレス</th></tr>
<?php foreach($arrays as $row){ ?>
<tr>
    <td><?php echo $row['name'];?></td>
    <td><?php echo $row['hobby'];?></td>
    <td><?php echo $row['email'];?></td>
</tr>
<?php } ?>

</table>
 
</body>
</html>



 
