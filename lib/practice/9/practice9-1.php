<?php

$str1 = '0120';
$str2 = '090';

$result1 = preg_match('/\d{4}/u', $str1);
$result2 = preg_match('/\d{4}/u', $str2);
//別解：$result1 = preg_match('/[0-9]{4}/u', $str1);
//別解：$result2 = preg_match('/[0-9]{4}/u', $str2);

var_dump($result1);
var_dump($result2);