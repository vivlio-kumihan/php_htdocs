<?php

// クライアントからフォームへ入力値を出力する場合、『記号として意味のある』HTMLのタグを『ただの文字』として出力する。
// それによってセキュリティを担保する。

function html_escape($word) {
  return htmlspecialchars($word, ENT_QUOTES, 'UTF-8');
}

$str = "<h1>Hello!<h1>";
echo $str."<br>";
echo html_escape($str);