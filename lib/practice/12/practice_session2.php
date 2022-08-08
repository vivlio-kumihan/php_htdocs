<?php

session_start();

$_SESSION['age'] = 40;
unset($_SESSION['email']);

echo $_SESSION['age'];

/*
この場合、下記コードを実行すると「Undefined」になる
echo $_SESSION['email'];
*/



