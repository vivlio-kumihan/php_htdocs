<?php

$time = date('H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
$data = "{$time}\t{$ip}\r\n";

$file = @fopen('access.log','a') or die(',ファイルを開けませんでした。');
flock($file, LOCK_EX);
fwrite($file, $data);
flock($file, LOCK_UN);
fclose($file);

echo 'アクセスログを記録しました。';