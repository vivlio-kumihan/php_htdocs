<?php

function get_add($int1, $int2) {
	$sum = $int1 + $int2;
	return $sum;
}

$int1 = 8;
$int2 = 3;

$result = get_add($int1, $int2);
echo $result;

