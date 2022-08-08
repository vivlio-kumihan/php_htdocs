<?php

require_once('config.php');
require_once('./helpers/db_helper.php');
require_once('./helpers/extra_helper.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = get_post('name');
    $email = get_post('email');
    $password = get_post('password');

    $dbh = get_db_connect();
    $errs = array();
    //入力値のバリデーション
    if (!check_words($name, 50)) {
        $errs['name'] = 'お名前欄は必須、50文字以内です';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errs['email'] = 'メールアドレスの形式が正しくないです';
    } elseif (email_exists($dbh, $email)) {
        $errs['email'] = 'このメールアドレスは既に登録されています';
    } elseif (!check_words($email, 100)) {
        $errs['email'] = 'メールアドレスは必須、100文字以内です';
    }

    if (!check_words($password, 50)) {
        $errs['password'] = 'パスワードは必須、50文字以内です';
    }
    //エラーが無ければデータを挿入
    if (empty($errs)) {
        if(insert_member_data($dbh, $name, $email, $password)){
        header('Location: '.SITE_URL.'login.php');
        exit;
        }
        $errs['password'] = '登録に失敗しました。';
    }
}

include_once('./views/signup_view.php');

