<?php

$str1 = '今日はくもりです。';
$str2 = '明日は快晴でしょう。';

$result1 = preg_match('/でしょう。$/u', $str1);
$result2 = preg_match('/でしょう。$/u', $str2);
//別解：$result1 = preg_match('/でしょう。\z/u', $str1);
//別解：$result2 = preg_match('/でしょう。\z/u', $str2);

var_dump($result1);
var_dump($result2);