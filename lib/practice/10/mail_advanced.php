<?php

mb_language("Japanese");
mb_internal_encoding("UTF-8");

$user_name = 'taro';
$to      = 'sample@sample.com';
$subject = 'メールテスト2';
$message =<<<EOM
{$user_name}さん、

このメールはテスト送信です。
http://{$_SERVER['SERVER_NAME']}
EOM;

$from = "ONLINE-TUTOR事務局 ";
$from_mail = "sender@sender.com";


$headers = '';
$headers .= "Cc: another@another.com \r\n";
$headers .= "Content-Type: text/plain \r\n";
$headers .= "Return-Path: " . $from_mail . " \r\n";
$headers .= "From: " . $from ." \r\n";
$headers .= "Sender: " . $from ." \r\n";
$headers .= "Reply-To: " . $from_mail . " \r\n";
$headers .= "Organization: " . $from . " \r\n";


if(mb_send_mail($to, $subject, $message, $headers) === FALSE){
	echo 'メール送信に失敗しました。';
}else{
	echo 'メールを送信しました。';
}