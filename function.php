<?php
function html_escape($word) {
  return htmlspecialchars($word, ENT_QUOTES, 'UTF-8');
}

function get_post($key) {
  if (isset($_POST[$key])) {
    $var = trim($_POST[$key]);
    return $var;
  }
}

function check_words($word, $length) {
  if (mb_strlen($word) === 0) {
    return FALSE;
  } elseif (mb_strlen($word) > $length) {
    return FALSE;
  } else {
    return TRUE;
  }
}

function get_db_connect() {
  try{
    $dsn = "mysql:dbname=sample;host=localhost;charset=utf8";
    $user = "root";
    $password = "root";
    $db_ins = new PDO($dsn, $user, $password);

  } catch (PDOException $e) {
    echo("接続に失敗しました。".$e->getMessage());
    die();
  }
  $db_ins->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $db_ins;
}

function insert_comment($db_ins, $name, $comment) {
  $date = date('Y-m-d H:i:s');
  $sql = "INSERT INTO board (name, comment, created) VALUE (:name, :comment, '{$date}')";
  $stmt = $db_ins->prepare($sql);
  $stmt->bindValue(':name', $name, PDO::PARAM_STR);
  $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
  if (!$stmt->execute()) {
    return 'データの書き込みに失敗しました。';
  }
}

function select_comments($db_ins) {
  $data = [];
  $sql = "SELECT name, comment, created FROM board";
  $stmt = $db_ins->prepare($sql);
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
  }
  return $data;
}
?>