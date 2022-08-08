<?php

$str = 'ここにフライパンなどのワード';
//検索しやすいように文字列を整える
$target = mb_strtolower($str, 'UTF-8');
$target = mb_convert_kana($target, 'KVas', 'UTF-8');
$target = preg_replace('/\s|、|。/', '', $target);

$flag = 0;

//許可ワードを検索対象から外す
$ok_words = array('フライパン','コーヒーゼリー');

foreach($ok_words as $ok_word){
	if(mb_strpos($target, $ok_word) !== FALSE){
	$target = str_replace($ok_word, '*', $target);
	}
}

//禁止ワードをチェックする
$ng_words = array('パン','コーヒー');

foreach($ng_words as $ng_word){
	if(mb_strpos($target, $ng_word) !== FALSE){
		$flag = 1;
		break;
	}
}

if($flag === 0){
	echo '禁止ワードは含まれていません。';
}else{
	echo '禁止ワードが含まれています。';
}

echo "{$str}->{$target}";