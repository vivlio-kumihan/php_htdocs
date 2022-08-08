<?php

$date1 = '2017/11/04';
$date2 = '2017/3/8';
$date3 = '2017年11月4日';
$pattern = '/^(\d{4})\/(\d{1,2})\/(\d{1,2})$/u';

$result1 = preg_match($pattern, $date1);
$result2 = preg_match($pattern, $date2);
$result3 = preg_match($pattern, $date3);

var_dump($result1);
var_dump($result2);
var_dump($result3);