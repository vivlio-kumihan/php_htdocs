<?php

require_once('config.php');
require_once('./helpers/db_helper.php');
require_once('./helpers/extra_helper.php');

session_start();

if (empty($_SESSION['member'])) {
    header('Location: '.SITE_URL.'login.php');
    exit;
}

$member = $_SESSION['member'];
$dbh = get_db_connect();
$members = array();
//全会員データを取得する
$members = select_members($dbh);

include_once('./views/member_view.php');