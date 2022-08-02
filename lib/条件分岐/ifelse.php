<!-- if構文 -->
<!-- <?php
$lang = 1;
if( $lang === 1 ){
  echo 'こんにちは';
}elseif( $lang === 2 ){
  echo 'Hello';
}else{
  echo 'Bonjour';
}
?> -->

<!-- 比較演算子 -->
<!-- 文字列中の変数展開は、変数を『{}』で囲むだけのお手軽設計。 -->
<!-- <?php
$time = date('G');
echo "{$time}<br>";
if($time < 12){
  echo 'AM';
}else{
  echo 'pm';
}
?> -->

<!-- 比較演算子から帰ってくる値は論理値（Boolean）かどうかを確かめる。 -->
<!-- 'var_dump'は、pythonの'type()' -->
<!-- <?php
$num = 5;
var_dump($num < 3)
?> -->

<!-- 課題　trueとfalseの違いを理解する。 -->
<?php
$var = 0;
if($var) echo 'この式が通るということは、オブジェクトが変数に格納されている状態はTRUEです。';
?>