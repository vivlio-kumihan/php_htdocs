<?php
$dsn = "mysql:dbname=sample;host=localhost;charset=utf8";
$user = "root";
$password = "root";
$sqls = array(
  0 => array(
    'club_id' => '5',
    'club_name' => '茶道愛好会',
    'count' => '2',
    'overview' => '裏千家流でお茶を楽しみます。'
  ),
  1 => array(
    'club_id' => '6',
    'club_name' => '陶芸教室',
    'count' => '2',
    'overview' => '市立市民会館の釜の施設を使って焼きまで制作します。'
  ),
  2 => array(
    'club_id' => '7',
    'club_name' => '民謡研究会',
    'count' => '8',
    'overview' => '60〜80年代のロックについてレコード鑑賞をします。'
  )
);

try {
  $db_ins = new PDO($dsn, $user, $password);
  $db_ins->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO `club`(`club_id`, `club_name`, `count`, `overview`) VALUES (:club_id, :club_name, :count, :overview)";
  $stmt = $db_ins->prepare($sql);
  foreach($sqls as $arr) {
    foreach($arr as $key => $val) {
      if ($key === 'club_id') {
        $stmt->bindValue(':club_id', $val, PDO::PARAM_INT);
      } elseif ($key === 'club_name') {
        $stmt->bindValue(':club_name', $val, PDO::PARAM_STR);
      } elseif ($key === 'count') {
        $stmt->bindValue(':count', $val, PDO::PARAM_INT);
      } elseif ($key === 'overview') {
        $stmt->bindValue(':overview', $val, PDO::PARAM_STR);
      };
    };
    $stmt->execute();
    echo "{$arr['club_name']}のデータを追加しました。";
  };
  
} catch (PDOException $e) {
  print("接続に失敗しました。".$e->getMessage());
  die();
}



