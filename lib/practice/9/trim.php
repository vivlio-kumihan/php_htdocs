<?php
$str1 = ' AB C '; //文字列前後に半角スペース
$str2 = "\t\tこんにちは　"; //文字列前にタブ２つ、後ろに全角スペース

$result1 = trim($str1);
$result2 = trim($str2);

var_dump($result1);
var_dump($result2);
