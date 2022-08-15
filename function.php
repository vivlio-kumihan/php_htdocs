<?php
// エスケープ処理
// エスケープ処理を行うと「キーボードから入力できない文字を出力させる」ことや
// 「PC側の解釈が異なって文字の効果を実行してしまう」ことを防ぐなどの効果があります。
// これをしないと、クロスサイトスクリプティング（XSS）が行われてしまいますので
// 思ってないところでプログラムが勝手に実行されたりなどシステムに色々問題が発生してしまいます。
// そのような処理を防ぐためにエスケープ処理を行います。

use Symfony\Component\DependencyInjection\Dumper\PhpDumper;

function html_escape($word) {
  return htmlspecialchars($word, ENT_QUOTES, 'UTF-8');
}

// POSTで渡ってきたインスタンスをこちら側で変数に格納する。
function get_post($key) {
  if (isset($_POST[$key])) {
    $var = trim($_POST[$key]);
    return $var;
  }
}

// 渡す変数に文字は入っているかどうかの判定と、
// オプションで、指定した文字数より多いとfalseを返す。
function check_words($word, $length) {
  if (mb_strlen($word) === 0) {
    return FALSE;
  } elseif (mb_strlen($word) > $length) {
    return FALSE;
  } else {
    return TRUE;
  }
}

// 汎用的に使える関数。
// PHPでDBを使えるようにする。
// オプションでDB名を入れてDBのインスタンスを生成させる。
function get_db_connect($db_name) {
  try{
    $dsn = "mysql:dbname=$db_name;host=localhost;charset=utf8";
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

// オプション名とインスタンスを定着させるのに都度変更を加える必要はある。
// DBにデータを追記していくフォーマットとしては使える。
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

function all_select_comments($db_ins) {
  $data = [];
  $sql = "SELECT name, comment, created FROM board";
  $stmt = $db_ins->prepare($sql);
  $stmt->execute();
  // 凄いよね、fetch()。
  // $stmt（ステートメント->命令？）に行がある間は、最初から1行ごとに
  // 変数に値を格納し続けないさい。
  // というのをこの1行でやっている。
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
  }
  return $data;
}
?>