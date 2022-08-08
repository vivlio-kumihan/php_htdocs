<?php

$str1 = 'KV: ﾌﾟﾛｸﾞﾗﾐﾝｸﾞ';
$str2 = 'as: 私はＭＯＶＩＥが　好きです。';

$result1 = mb_convert_kana($str1, 'KVas', 'UTF-8');
$result2 = mb_convert_kana($str2, 'KVas', 'UTF-8');

var_dump($result1);
var_dump($result2);