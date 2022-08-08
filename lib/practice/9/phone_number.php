<?php

$num1 = '090-1234-5678';
$num2 = '08012345678';
$num3 = '070-1234-567';
$pattern = '/^0[7-9]0-?\d{4}-?\d{4}$/u';

$result1 = preg_match($pattern, $num1);
$result2 = preg_match($pattern, $num2);
$result3 = preg_match($pattern, $num3);

var_dump($result1);
var_dump($result2);
var_dump($result3);