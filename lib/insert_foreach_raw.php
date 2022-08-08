<?php
$dsn = "mysql:dbname=sample;host=localhost;charset=utf8";
$user = "root";
$password = "root";

try {
  $db_ins = new PDO($dsn, $user, $password);
  $db_ins->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = ["INSERT INTO `club`(`club_id`, `club_name`, `count`, `overview`) VALUES ('1', '球技同好会', '4', '毎週日曜日に市立体育館で各種球技をします。')",
          "INSERT INTO `club`(`club_id`, `club_name`, `count`, `overview`) VALUES ('2', 'ハイキング', '1', '市内の低山ハイキングをします。')",
          "INSERT INTO `club`(`club_id`, `club_name`, `count`, `overview`) VALUES ('3', 'ジャズ同好会', '2', '楽器を持ち寄ってスタジオセッションをします。')",
          "INSERT INTO `club`(`club_id`, `club_name`, `count`, `overview`) VALUES ('4', '料理愛好会', '4', '和食、中華、洋食とジャンルにとらわれず料理実習をします。')"];
  foreach($sql as $s) {
    $stmt = $db_ins->prepare($s);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':age', $age, PDO::PARAM_INT);
    $stmt->bindValue(':email', $age, PDO::PARAM_STR);
    $stmt->execute();
    echo 'データを追加しました。';
  }
} catch (PDOException $e) {
  print("接続に失敗しました。".$e->getMessage());
  die();
}