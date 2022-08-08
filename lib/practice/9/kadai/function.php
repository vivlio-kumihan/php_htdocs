<?php
/**
 * 迷惑メールでないか判定する。
 * リンク<a>やURL（httpなど）が書いてあるものはTRUE
 *
 * @param String $str
 * @return array|bool
 */
function is_spam($str){
	//検索しやすいように文字列を整える
	$target = mb_strtolower($str, 'UTF-8');
	$target = mb_convert_kana($target, 'KVas', 'UTF-8');
	$target = preg_replace('/\s|、|。/', '', $target);
	
	//禁止ワードをチェックする
	$ng_words = array('<a>','html','@');

	foreach($ng_words as $ng_word){
		if(mb_strpos($target, $ng_word) !== FALSE){
			return TRUE;
		}
	}
	return FALSE;
}


var_dump(is_spam('ごはんがほしい'));