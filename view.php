<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View</title>
  <style type="text/css">
    table,
    th,
    td {
      border: 1px solid #333;
      border-collapse: collapse;
    }

    th {
      background-color: orange;
    }
  </style>
</head>

<body>
  <h1>ひとこと掲示板</h1>
  <table>
    <tr>
      <th>名前</th>
      <th>コメント</th>
      <th>時刻</th>
    </tr>
    <?php if (count($data)):
    foreach ($data as $row): ?>
      <tr>
        <td><?php echo html_escape($row['name']); ?></td>
        <td><?php echo nl2br(html_escape($row['comment'])); ?></td>
        <td><?php echo $row['created']; ?></td>
      </tr>
    <?php endforeach;
    endif; ?>
  </table>
  <?php if (count($errs)) {
    foreach ($errs as $err) {
      echo '<p style="color: red">'.$err.'</p>';
    }
  } ?>
  <form action="board.php" method="POST">
    <p>お名前 <input type="text" name="name">（50文字まで）</p>
    <p>ひとこと<textarea name="comment" rows="4" cols="40"></textarea>（200文字まで）</p>
    <input type="submit" value="書き込み">
  </form>
</body>

</html>