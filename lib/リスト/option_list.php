<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>option_list</title>
</head>

<?php
$now = date("Y");
?>

<!-- 問題点
月に連動して日数を変更したい場合はJavaScriptを使わなければならない。
PHPでは、月が選択されたことを感知して日数を変更する処理はサーバー -->
<body>
  <h1>生年月日を入力するフォーム</h1>
  <!-- optionで選択肢の後につく文字はこんな風に書くんだ。 -->
  <label for="year">西暦</label>
  <select name="year">
    <?php for($y = 1965; $y <= $now; $y++) { ?>
      <option value=<?php echo $y; ?>><?php echo $y; ?></option>
    <?php } ?>
  </select>年
  <br>
  <select name="month">
    <?php for($m = 1; $m <= 12; $m++) { ?>
      <option value=<?php echo $m; ?>><?php echo $m; ?></option>
    <?php } ?>
  </select>月
  <br>
  <select name="day">
    <?php for($d = 1; $d <= 31; $d++) { ?>
      <option value=<?php echo $d; ?>><?php echo $d; ?></option>
    <?php } ?>
  </select>日
</body>
</html>