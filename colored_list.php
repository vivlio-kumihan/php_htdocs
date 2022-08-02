<!-- た互い違いに処理を変える元コード -->
<!-- ややこしい、これは書いてられない。 -->
<!-- 関数にしてhtmlに埋め込むような形で値を呼び出すようにしないと煩雑になる印象。 -->
<!-- 何か良い対策があるのか調べておく。 -->
<!-- というか一発でコメントアウトもできない。 -->
<?php for ($l = 1; $l < 5; $l++)
  if ($l % 2 === 1) { ?>
  <p><?php echo $l . "奇数" ?></p>
<?php } else { ?>
  <p><?php echo $l . "偶数" ?></p>
<?php } ?>

<!-- 上記コードをリストにあてはめて完成させる。 -->
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
    <?php for ($l = 1; $l < 9; $l++)
      if ($l % 2 === 1) { ?>
      <li class="color-red"><?php echo $l ?></li>
    <?php } else { ?>
      <li><?php echo $l ?></li>
    <?php } ?>
  </ul>
</body>
</html>