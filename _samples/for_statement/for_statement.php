<?php
  // for文
  // 合計を求めたり。。。
  $sum = 0;
  for ($i=0; $i <= 3; $i++) { 
    $sum += $i;
  }

  // foreach文
  // 以下のhtml内で展開してみる。
  $member = [
    ["name" => "Nobuyuki", "age" => 59, "gender" => "male"],
    ["name" => "Kazue", "age" => 53, "gender" => "female"],
    ["name" => "Mari", "age" => 27, "gender" => "female"]
  ];
?>

<?php 
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://unpkg.com/destyle.css@4.0.0/destyle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="./style.css">
  <script src="./behavior.js" defer></script>
</head>

<body>
  <div class="container">
    <p>
      <?php echo '合計は'.$sum.'です。' ?>
    </p>
        <?php 
        foreach ($member as $key => $person) {
        ?>
    <dl>
      <div>
        <dt>氏名：</dt>
        <dd><?php echo $person["name"] ?></dd>
      </div>
      <div>
        <dt>年齢：</dt>
        <dd><?php echo $person["age"] ?></dd>
      </div>
      <div>
        <dt>性別：</dt>
        <dd><?php echo $person["gender"] ?></dd>
      </div>
    </dl>
        <?php 
        }
        ?>
  </div>
</body>

</html>