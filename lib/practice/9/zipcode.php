<?php

$zipcode1 = '115-0002';
$zipcode2 = '220-601';

$result1 = preg_match('/\A([0-9]{3})-([0-9]{4})\z/',$zipcode1);
$result2 = preg_match('/\A([0-9]{3})-([0-9]{4})\z/',$zipcode2);

var_dump($result1);
var_dump($result2);