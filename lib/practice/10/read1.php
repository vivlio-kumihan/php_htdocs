<?php

$file = @fopen('access.log','r') or die(',ファイルを開けませんでした。');

flock($file, LOCK_SH);
$count = 0;
while (!feof($file)) {
  $line = fgets($file);
  echo '<p>'.$line.'</p>';
  $count++;
}
flock($file, LOCK_UN);
fclose($file);

echo ($count-1).'回の訪問がありました。';