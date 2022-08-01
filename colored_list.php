<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>colored_list</title>
  <style>
    ul {
      width: 100px;
    }

    .color-red {
      background-color: red;
    }
  </style>
</head>
<body>
  <ul>
    <li class="color-red">1</li>
    <li>2</li>
    <li class="color-red">3</li>
    <li>4</li>
  </ul>
</body>
</html>

<!-- これは書いてられない。 -->
<!-- 関数にしてhtmlに埋め込むような形で値を呼び出すようにしないと煩雑になる印象。要対策 -->
<?php for($l = 1; $l < 5; $l++) 
        if($l % 2 === 1){ ?>
          <p><?php echo $l."奇数" ?></p>
    <?php }else{ ?>
          <p><?php echo $l."偶数" ?></p>
  <?php } ?>