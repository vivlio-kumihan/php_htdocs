<?php

$str = ' プログラミングを、習いたい。';
$result = preg_replace('/\s|、|。/','',$str);

var_dump($result);