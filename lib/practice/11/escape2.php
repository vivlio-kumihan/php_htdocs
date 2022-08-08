<?php

function html_escape($word){
  return htmlspecialchars($word, ENT_QUOTES, 'UTF-8');
}

$word = '<h1>こんにちは</h1>';
echo $word;
echo html_escape($word);
