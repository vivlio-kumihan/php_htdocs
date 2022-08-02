<?php
// DB操作を目的としているので、配列というより連想配列の作法を覚える。
$arrs = array(
  0 => array(
    'name' => '高広',
    'hobby' => 'バイクツーリング',
    'email' => 'vivlio@kumihan.com'
  ),
  1 => array(
    'name' => '木田',
    'hobby' => 'ドラム演奏',
    'email' => 'kida@gmail.com'
  ),
  2 => array(
    'name' => '竹中',
    'hobby' => 'フィギア収集',
    'email' => 'takenaka@gmail.com'
  )
);

// 任意の値を吐き出。
// echo $arrs[2]['email'];

// 全ての値を吐き出す。
// foreach($arrs as $key => $arr) {
//   foreach($arr as $key => $val) {
//     echo $val."<br>";
//   }
// }