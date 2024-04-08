<!-- 
前提として、
`table: user`がある、`DB: member`に新たに`table: club`を作成してある。 
-->

<?php
require_once '../../tmp/conf_common_thyme_jp.php';

// 検索窓に`URL + id`を入力してDBに『GET』でアクセスしてみる。
// このファイルの場合だと、`http://localhost/DB_member_profile.php?id=1`

// 敢えて、idには空の文字列を入れて、わざわざ整数『0』に初期化しておいている。
$id = '';

if (isset($_GET['id'])) {
  $id = (int)$_GET['id'];
}

// 問い合わせる先は『DB』です。『テーブル』ではないです。
// なのでここでは、DB『member』へアクセスします。 

try {
  $dbh = new PDO(DSN, DB_USER, DB_PASSWORD);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ヒアドキュメントでSQLをわかりやすくする。
// この書き方は、以降参考にすべき。冗長かもしれんがわかりやすいと思う。
$sql = <<<SQL
SELECT user.name,
      user.age,
      club.club_name,
      club.count,
      club.overview
FROM user
JOIN club ON user.club_id = club.club_id
WHERE user.id = :id
LIMIT 1
SQL;

  // 仕込んだSQLを実行
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  // fetch => 取り出すという英語
  // FETCH_ASSOC => 帰ってきたデーターにカラム名で添字を付けた配列を返す。
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  // 抽出できるかを確認する。
  // var_dump($row);
} catch (PDOException $e) {
  echo('error conection: '.$e->getMessage());
  die();
}
?>

<!-- 会員IDから検索してメンバー情報を表組みにして表すアプリを作ってみる。 -->

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://unpkg.com/destyle.css@4.0.0/destyle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <div class="container">
    <h1>会員データ検索</h1>
    <div class="search">
      <p>会員IDを入力してください。</p>
      <form action="" method="GET">
        <input type="text" name="id" />
        <button type="submit">確認</button>
      </form>
    </div>
    <div class="result">
      <h1>会員データ</h1>
      <dl>
        <div>
          <dt>氏名</dt>
          <dd><?php echo $row['name'] ?></dd>
        </div>
        <div>
          <dt>年齢</dt>
          <dd><?php echo $row['age'] ?></dd>
        </div>
        <div>
          <dt>クラブ</dt>
          <dd><?php echo $row['club_name'] ?></dd>
        </div>
        <div>
          <dt>月の活動回数</dt>
          <dd><?php echo $row['count'] ?></dd>
        </div>
        <div>
          <dt>活動概要</dt>
          <dd class="overview"><?php echo nl2br(htmlspecialchars($row['overview'], ENT_QUOTES, 'UTF-8')); ?></dd>
        </div>
      </dl>
    </div>
  </div>
</body>

</html>