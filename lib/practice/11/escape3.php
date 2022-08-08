<?php

$word = '<h1>こんにちは</h1>';
echo html_escape($word);

function html_escape($str){
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
