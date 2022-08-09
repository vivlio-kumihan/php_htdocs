<?php
require_once('function.php');
$errs = [];
$data = [];
$db_ins = get_db_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = get_post('name');
  $comment = get_post('comment');

  if (!check_words($name, 50)) {
    $errs[] = '氏名欄を修正してください。';
  }
  
  if (!check_words($comment, 200)) {
    $errs[] = 'コメント欄を修正してください。';
  }

  if (count($errs) === 0) {
    $result = insert_comment($db_ins, $name, $comment);
  }
}

$data = select_comments($db_ins);

include_once('view.php');

