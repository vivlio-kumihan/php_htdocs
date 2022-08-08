<?php
$dsn = "mysql:dbname=sample;host=localhost;charset=utf8";
$user = "root";
$password = "root";

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo '接続に成功しました。';
} catch(PDOException $e) {
    print("接続に失敗しました。".$e -> getMessage());
    die();
}