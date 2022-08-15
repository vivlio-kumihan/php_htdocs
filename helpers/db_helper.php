<?php

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

function email_exists($db_ins, $email) {
  $sql = "SELECT COUNT(id) FROM `members` WHERE `email` = :email";
  $stmt = $db_ins->prepare($sql);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  $count = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($count['COUNT[id'] > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}