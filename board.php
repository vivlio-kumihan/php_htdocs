<?php
require_once('function.php');

$errs = [];
$data = [];
// PHPでコントロール可にしてDB起動。
$db_ins = get_db_connect('sample');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = get_post('name');
  $comment = get_post('comment');
  // 値のvalidation
  if (!check_words($name, 50)) {
    $errs[] = '氏名欄を修正してください。';
  }
  // 値のvalidation
  if (!check_words($comment, 2000)) {
    $errs[] = 'コメント欄を修正してください。';
  }
  // DBにコメントを追加していく。
  if (count($errs) === 0) {
    insert_comment($db_ins, $name, $comment);
  }
}

// HTMLへ渡すために、
// DBにスプールされた全データを連想配列に変換して格納する関数。
$data = all_select_comments($db_ins);

// ここで生成されて$data、
// つまり、現状のDBの状態を連想配列に変換した変数が
// 『view.php』を含める・組み込む（include）と命令することで、
// インスタンが該当ファイルへ渡っていく。素敵だ。
include_once('view.php');

