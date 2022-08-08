<?php 

$array = array(
  'name' => '佐藤',
  'age' => 27,
  'blood' => 'AB'
  );

echo $array['age'].'<br>';

foreach($array as $key => $var){
	echo $key.':'.$var.'<br>';
}