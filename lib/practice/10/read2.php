<?php

$file = file('access.log');
var_dump($file);
foreach($file as $line){
	echo '<p>'.$line.'</p>';
}