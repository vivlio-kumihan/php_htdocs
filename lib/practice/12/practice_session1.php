<?php

session_start();

$_SESSION['age'] = 36;
$_SESSION['email'] = 'sample@sample.com';

echo $_SESSION['age'].'<br>';
echo $_SESSION['email'];


/*別解
$_SESSION = array('age' => 36, 'email' => 'sample@sample.com');
var_dump($_SESSION);
*/
