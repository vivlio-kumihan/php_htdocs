<?php
// 【要注意】ディレクトリを任意に作成するのはいいが、権限の変更を忘れずに行わないとコードが機能しない。
// 【必須】chmod -R 777 img
$err = array();
$pict = $_FILES['pict'];
// var_dump($pict);

// DBへのアクセスもある関係上、画像にヴァリデーションをかけるのが慣例。
// ファイル・タイプとファイル・サイズについて
$type = exif_imagetype($pict['tmp_name']);

// ファイルタイプで選り分ける
if ($type !== IMAGETYPE_JPEG && $type !== IMAGETYPE_PNG) {
  $err['pic'] = '対象ファイルは、『JPEG』または『PNG』のみとなってます。';
// ファイルサイズで選り分ける。
} elseif ($pict['size'] >= 1024 * 1024) {
  $err['pic'] = 'ファイルサイズは、1MB以下にリサイズしてください。';
// 全ての条件を経たファイルに対してファイル名を暗号化してDBを守る。
} else {
  $extension = pathinfo($pict['name'], PATHINFO_EXTENSION);
  $new_img = md5(uniqid(mt_rand(), true)).'.'.$extention;

  // 引数は、('from_path', 'to_path')
  // 'from_path'は慣用的に　$pict['tmp_name']　
  // 'XAMMP/xamppfiles/temp'に一時的に置くディレクトリを指す。ただし、本当に置かれるわけではない。
  var_dump($new_img);
  move_uploaded_file($pict['tmp_name'], './img/'.$new_img);
}

// 【メモ1】
// 計算（暗算）できないのでメモしておく。
// 1KB   = 1024バイト
// 1MB   = 1024 * 1024バイト
// 10MB  = 10 * 1024 * 1024バイト
// 100MB = 100 * 1024 * 1024バイト
// 1GB   = 1024 * 1024 * 1024バイト

// 【メモ2】
// ファイルのアップロードの許可、
// デフォルトのアップロード先、
// ファイルサイズ、
// 一度に送れるファイル数は、以下で指定している。
// /Applications/XAMPP/xamppfiles/etc/php.ini
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://unpkg.com/destyle.css@4.0.0/destyle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="./style.css">
</head>
<body>
  <div class="container">
    <h1>受信ページ</h1>
    <?php  
    if (count($err) > 0) {
      foreach ($err as $row) {
        echo '<p>'.$row.'</p>';
      }
      echo '<a href="pic_send.php">戻る</a>';
    } else {
    ?>
    <div>
      <img src="http://localhost/img/<?php echo $new_img; ?>" alt="">
    </div>
    <?php 
    }
    ?>
  </div>
</body>
</html>


<?php

// $upload_dir = 'img/'; // 画像を保存するディレクトリ

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['pict'])) {
//     $pict = $_FILES['pict'];

//     // アップロードされたファイルのエラーチェック
//     if ($pict['error'] !== UPLOAD_ERR_OK) {
//         echo '画像のアップロードに失敗しました。';
//     } else {
//         // アップロードされたファイルを移動
//         $file_path = $upload_dir . basename($pict['name']);
//         if (move_uploaded_file($pict['tmp_name'], $file_path)) {
//             echo '画像が正常にアップロードされました。';
//         } else {
//             echo '画像のアップロードに失敗しました。';
//         }
//     }
// } else {
//     echo '画像が送信されていません。';
// }
?>