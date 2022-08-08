<?php

function get_sum_and_diff($int1, $int2) {
	$sum = $int1 + $int2;
	$difference = $int1 - $int2;
	return array($sum, $difference);
}

$int1 = 8;
$int2 = 3;

list($sum, $difference) = get_sum_and_diff($int1, $int2);
echo $sum.'<br>';
echo $difference;