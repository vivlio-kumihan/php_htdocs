<?php
$id = '';
if (isset($_GET['id'])) {
  $id = (int)$_GET['id'];
}

$dsn = "mysql:dbname=sample;host=localhost;charset=utf8";
$user = "root";
$password = "root";
$data = [];

try {
  $db_ins = new PDO($dsn, $user, $password);
  $db_ins->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql =
    <<<SQL
SELECT
    `name`,
    `age`,
    club.club_name,
    club.count,
    club.overview
FROM
    user
JOIN club ON user.club_id = club.club_id
WHERE user.id = :id
LIMIT 1
SQL;

  $stmt = $db_ins->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  // var_dump($row);
} catch (PDOException $e) {
  print("接続に失敗しました。" . $e->getMessage());
  die();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メンバープロフィール</title>
  <style>
    .search {
      float: right;
    }
    table,
    th,
    td {
      border: 1px solid #333;
      border-collapse: collapse;
    }
  </style>
</head>

<body>
  <div class="search">
    <p>会員IDを入力してください。</p>
    <form action="" method="GET">
      <input type="text" name="id">
      <input type="submit" value="確認する">
    </form>
  </div>
  <h1>会員データ</h1>
  <?php if ($row === FALSE): ?>
    <p><?php echo $_GET['id'] ?>の番号の会員はいらっしゃいません。</p>
  <?php else: ?>
  <table>
    <tr>
      <th>お名前</th>
      <th>年齢</th>
      <th>所属クラブ</th>
      <th>月の活動数</th>
      <th>概要</th>
    </tr>
    <tr>
      <td><?php echo $row["name"] ?></td>
      <td><?php echo $row["age"] ?></td>
      <td><?php echo $row["club_name"] ?></td>
      <td><?php echo $row["count"] ?></td>
      <td>
        <?php echo nl2br(htmlspecialchars($row["overview"], ENT_QUOTES, 'UTF-8')); ?>
      </td>
    </tr>
  </table>
  <?php endif; ?>
</body>
</html>