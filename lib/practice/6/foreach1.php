<?php

$array = array(
  'name' => '鈴木',
  'hobby' => 'テニス',
  'email' => 'sample@sample.com'
  );
 
foreach($array as $key => $var){
  echo $key.':'.$var.'<br>';
}