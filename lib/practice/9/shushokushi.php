<?php

$str = 'Hi, I am Taro.';
$result = preg_match('/taro/i', $str);

var_dump($result);
$str = 'ab cd';
$result = preg_match('/ab cd/x', $str);

var_dump($result);