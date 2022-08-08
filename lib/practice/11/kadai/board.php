<?php
require_once('./functions.php');

//データベースへの接続
$dbh = get_db_connect();
$errs = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //POSTデータの取得
    $name = get_post('name');
    $comment = get_post('comment');
    //文字数のチェック
    if (!check_words($name, 50)) {
        $errs[] = 'お名前欄を修正してください';
    }
    if (!check_words($comment, 200)) {
        $errs[] = 'コメント欄を修正してください';
    }

    if(count($errs) === 0){
    //コメントの書き込み
    $result = insert_comment($dbh,$name,$comment);
    }
}

//全コメントデータの取得
$data = select_comments($dbh);

include_once('view.php');
