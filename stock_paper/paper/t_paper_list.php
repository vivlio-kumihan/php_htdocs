<?php
  session_start();
  session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja" id="Top">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" href="../common/css/common.css" media="screen,print">
<title>用紙管理</title>
</head>
<body>

<div id="container">

<?php
  if(isset($_SESSION['login'])==false){
#    print '<p>ログインされていません。</p>';
#    print '<a href="../staff_login/staff_login.html" class="btn-shadow"><p>ログイン画面へ</p></a>';
#    print '<form method="post" action="../staff_login/staff_login.html"><input type="submit" value="ログイン" class="btn-shadow"></form>';
    print '<form method="post" action="../staff_login/staff_login_check.php"><p><input type="submit" value="ログイン" class="btn-shadow">　ID：<input type="text" name="staff_code">　パスワード：<input type="password" name="staff_pass"><p/>';
    print '　<p><a href="./t_paper_list.php" class="btn-simple">用紙管理【色上質】</a>';
    print '　<a href="./t_paper_list_r.php" class="btn-simple">用紙管理【レザック】</a>';
    print '　<a href="../paper_ond/t_paper_list_ond.php" class="btn-simple">用紙管理【色上質（オンデマンド）】</a></p></form>';
#    exit();
  } else {
    print '<p><form method="post" action="../staff_login/staff_logout.php" class="f_left"><input type="submit" value="ログアウト" class="btn-shadow">　'.$_SESSION['staff_name'].'さんログイン中</form></p>';
    if($_SESSION['staff_kengen']=='管理'){
      print '<br>';
      print '　<p><a href="../staff/staff_list.php" class="btn-simple">スタッフ管理</a>';
      print '　<a href="./t_paper_list.php" class="btn-simple">用紙管理【色上質】</a>';
      print '　<a href="./t_paper_list_r.php" class="btn-simple">用紙管理【レザック】</a>';
      print '　<a href="../paper_ond/t_paper_list_ond.php" class="btn-simple">用紙管理【色上質（オンデマンド）】</a></p>';
    } else {
      print '<br>';
      print '　<p><a href="./t_paper_list.php" class="btn-simple">用紙管理【色上質】</a>';
      print '　<a href="./t_paper_list_r.php" class="btn-simple">用紙管理【レザック】</a>';
      print '　<a href="../paper_ond/t_paper_list_ond.php" class="btn-simple">用紙管理【色上質（オンデマンド）】</a></p>';
    }
  }
?>

<h1 class="f_clear">用紙管理【色上質】</h1>

<!--a href=#paper_text>本文紙</a>｜<a href=#paper_sp>特殊紙</a>｜<a href=#paper_fuuto>封筒</a>-->

<?php /* <div id=paper_text>
  <p>◎本文紙</p>
  <table>
    <tr>
      <td>用紙名</td><td>サイズ</td><td>紙目</td><td>紙厚</td><td>単価</td><td>登録／更新日時</td>
    </tr>

    <?php
      try{
        // 別ファイルに記述しているDB設定情報ファイルを読み込む
        require_once('../../conf/dsn.php');
        // mySQLに接続
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//      $sql='SELECT code,paper_name,paper_size,paper_me,paper_atsusa,paper_price,entry FROM t_paper_text WHERE 1'; //登録code順
        $sql='SELECT code,paper_name,paper_size,paper_me,paper_atsusa,paper_price,entry FROM t_paper_text ORDER BY paper_name,paper_size,paper_price ASC'; //部数昇順
        $stmt=$dbh->prepare($sql);
        $stmt->execute();

        $dbh=null;

        while(true){
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          if($rec==false){
            break;
          }
          print '<form method="post" action="t_paper_branch.php">';
            print '<tr>';
            print '<input type="hidden" name="tanka_code" value="'.$rec['code'].'">';
            print '<td><input type="text" name="paper_name" style="width:14em" value="'.$rec['paper_name'].'"></td>';
            print '<td><input type="text" name="paper_size" style="width:100px" value="'.$rec['paper_size'].'"></td>';
            print '<td><input type="text" name="paper_me" style="width:100px" value="'.$rec['paper_me'].'"></td>';
            print '<td><input type="text" name="paper_atsusa" style="width:70px" value="'.$rec['paper_atsusa'].'"></td>';
            print '<td><input type="text" name="paper_price" style="width:70px" value="'.$rec['paper_price'].'"></td>';
            print '<td>'.$rec['entry'].'</td>';
            if(isset($_SESSION['login'])==true){
              print '<td><input type="submit" name="t_paper_text_edit" value="修正" class="btn-simple">';
              print '<input type="submit" name="t_paper_text_delete" value="削除" class="btn-simple"></td>';
            }
            print '</tr>';
          print '</form>';
        }

      } catch(Exception $e) {

        print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
        exit();
      }
    ?>

    <tr>
      <form method="post" action="t_paper_text_check.php">
        <td><select name="paper_name" style="width:14em">
          <option value="上質" selected>上質</option>
          <option value="日本の色上質">日本の色上質</option>
          <option value="紀州の色上質">紀州の色上質</option>
          <option value="書籍（淡クリームキンマリ）">書籍（淡クリームキンマリ）</option>
          <option value="コート">コート</option>
          <option value="マットコート">マットコート</option>
          </select></td>
        <td><select name="paper_size" style="width:100px">
          <option value="四六判８切">四六判８切</option>
          <option value="Ａ判４切">Ａ判４切</option>
          <option value="菊判４切">菊判４切</option>
          </select></td>
        <td><select name="paper_me" style="width:100px">
          <option value="Ｔ・Ｙ目">Ｔ・Ｙ目</option>
          <option value="Ｔ目">Ｔ目</option>
          <option value="Ｙ目">Ｙ目</option></select></td>
        <td><input type="text" name="paper_atsusa" list="atsusa" style="width:70px">
          <datalist id="atsusa">
            <option value="薄口">薄口</option>
            <option value="中厚">中厚</option>
            <option value="厚口">厚口</option>
            <option value="特厚">特厚</option>
            <option value="最厚">最厚</option>
            <option value="超厚">超厚</option>
          </datalist></td>
        <td><input type="text" name="paper_price" style="width:70px"></td>
        <td><input type="submit" name="t_paper_text_add" value="追加" class="btn-simple"></td>
      </form>
    </tr>
  </table>
  <br />
  <form style="clear:both;"><input type="button" onclick="history.back()" value="戻る"></form>
</div> */ ?>


<div id=paper_sp>
  <h2>◎特殊紙</h2>
  <hr />
  <table>
    <thead>
      <tr class="alignCenter">
        <th>用紙色</th>
        <th>紙　厚</th>
        <th>サイズ</th>
        <th>用紙名（メーカー）</th>
        <th>紙　目</th>
        <th>枚　数</th>
        <th style="width: 7em;">更新者名</th>
        <th>登録／更新日時</th>
      </tr>
    </thead>
    <tbody>
      <?php if(isset($_SESSION['login'])==true){ ?>
        <tr>
          <form method="post" action="t_paper_sp_check.php">
            <td><input type="text" name="paper_color" style="width:10em;"></td>
            <td><input type="text" name="paper_atsusa" list="atsusa" placeholder="入力またはダブルクリック" style="width:6em;">
              <datalist id="atsusa">
                <option value="薄口">薄口</option>
                <option value="中厚口">中厚口</option>
                <option value="厚口">厚口</option>
                <option value="特厚口">特厚口</option>
                <option value="最厚口">最厚口</option>
                <option value="超厚口">超厚口</option>
              </datalist></td>
            <!--td><select name="paper_size" style="width:6em;"-->
            <td><input type="text" name="paper_size" list="psize" placeholder="入力またはダブルクリック" style="width:6em;">
              <datalist id="psize">
                <option value="Ａ判８切">Ａ判８切</option>
                <option value="Ａ判４切">Ａ判４切</option>
                <option value="四六判８切">四六判８切</option>
                <option value="四六判４切">四六判４切</option>
                <option value="菊判４切">菊判４切</option>
              </datalist>
              <!--/select--></td>
            <td><select name="paper_name" style="width:10em;">
            <!--td><input type="text" name="paper_name" list="pname" placeholder="入力またはダブルクリック" style="width:10em;">
              <datalist id="pname"-->
                <option value="日本の色上質">日本の色上質</option>
                <option value="紀州の色上質">紀州の色上質</option>
                <!--option value="レザック６６">レザック６６</option>
                <option value="レザック７５">レザック７５</option>
                <option value="レザック８０つむぎ">レザック８０つむぎ</option>
                <option value="レザック８２ろうけつ">レザック８２ろうけつ</option>
                <option value="その他">その他</option-->
              <!--/datalist-->
              </select></td>
            <td><select name="paper_me" style="width:6em;">
              <option value="T・Y">Ｔ・Ｙ</option>
              <option value="T">Ｔ</option>
              <option value="Y">Ｙ</option></select></td>
            <td><input type="text" name="paper_number" style="width:6em;"></td>
            <!--td><input type="text" name="paper_price400" style="width:8em"></td>
            <td><input type="text" name="paper_price600" style="width:12em"></td>
            <td><input type="text" name="paper_price800"></td>
            <td><input type="text" name="paper_price801"></td-->
            <td><input type="submit" name="t_paper_sp_add" value="追加" class="btn-simple"></td>
          </form>
        </tr>
      <?php } ?>

      <?php
        try{
          // 別ファイルに記述しているDB設定情報ファイルを読み込む
          require_once('../../conf/stock_paper_dsn.php');
          // mySQLに接続
          $dbh = new PDO(DSN, DB_USER, DB_PWD);
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //      $sql='SELECT code,paper_name,paper_size,paper_me,paper_atsusa,paper_price,entry FROM t_paper_sp WHERE 1'; //登録code順
          $sql='SELECT p_code,p_color,p_atsusa,p_size,p_name,p_me,p_number,p_entryuser,p_entry FROM mst_paper WHERE p_name="日本の色上質" OR p_name="紀州の色上質" ORDER BY p_color,p_name,p_atsusa,p_size,p_me ASC'; //用紙名昇順
          $stmt=$dbh->prepare($sql);
          $stmt->execute();

          $dbh=null;

          while(true){
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            if($rec==false){
              break;
            }
            print '<tr>';
            print '<form method="post" action="t_paper_branch.php">';
            print '<input type="hidden" name="paper_code" value="'.$rec['p_code'].'">';
            print '<td><input type="text" name="paper_color" style="width:10em;" value="'.$rec['p_color'].'"></td>';
            print '<td><input type="text" name="paper_atsusa" style="width:6em;" value="'.$rec['p_atsusa'].'"></td>';
            print '<td><input type="text" name="paper_size" style="width:6em;" value="'.$rec['p_size'].'"></td>';
            print '<td><input type="text" name="paper_name" style="width:10em;" value="'.$rec['p_name'].'"></td>';
            print '<td><input type="text" name="paper_me" style="width:6em;" value="'.$rec['p_me'].'"></td>';
            print '<td><input type="text" name="paper_number" style="width:6em; text-align:right;" value="'.$rec['p_number'].'"></td>';
            print '<td style="text-align:center;">'.$rec['p_entryuser'].'</td>';
  #           print '<td><input type="text" name="paper_price600" value="'.$rec['paper_price600'].'"></td>';
  #           print '<td><input type="text" name="paper_price800" value="'.$rec['paper_price800'].'"></td>';
  #           print '<td><input type="text" name="paper_price801" value="'.$rec['paper_price801'].'"></td>';
            print '<td>'.$rec['p_entry'].'</td>';
            if(isset($_SESSION['login'])==true){
              print '<td><input type="submit" name="t_paper_sp_edit" value="修正" class="btn-simple">';
              print '<input type="submit" name="t_paper_sp_delete" value="削除" class="btn-simple"></td>';
            }
            print '</form>';
            print '</tr>';
          }

        } catch(Exception $e) {

          print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
          exit();
        }
      ?>
    </tbody>
  </table>
  <br />
  <!--form style="clear:both;"><input type="button" onclick="history.back()" value="戻る"></form-->
</div>

<?php /*
<div id=paper_fuuto>
  <hr />
  <p>◎封筒</p>
  <table>
    <tr>
      <td>封筒名</td><td>サイズ</td><td>紙厚</td><td>100枚迄単価</td><td>1000枚迄単価</td><td>5000枚迄単価</td><td>登録／更新日時</td>
    </tr>

    <?php
      try{
        // 別ファイルに記述しているDB設定情報ファイルを読み込む
        require_once('../../conf/dsn.php');
        // mySQLに接続
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//      $sql='SELECT code,copies,B4,A3,B3,A2,entry FROM t_press_k WHERE 1'; //登録code順
        $sql='SELECT code,paper_name,paper_size,paper_atsusa,paper_price100,paper_price1000,paper_price5000,entry FROM t_paper_fuuto ORDER BY paper_name ASC,paper_size DESC,paper_price1000 ASC'; //部数昇順
        $stmt=$dbh->prepare($sql);
        $stmt->execute();

        $dbh=null;

        while(true){
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          if($rec==false){
            break;
          }
          print '<form method="post" action="t_paper_branch.php">';
            print '<tr>';
            print '<input type="hidden" name="tanka_code" value="'.$rec['code'].'">';
            print '<td><input type="text" name="paper_name" style="width:14em;" value="'.$rec['paper_name'].'"></td>';
            print '<td><input type="text" name="paper_size" style="width:100px;" value="'.$rec['paper_size'].'"></td>';
            print '<td><input type="text" name="paper_atsusa" style="width:70px;" value="'.$rec['paper_atsusa'].'"></td>';
            print '<td><input type="text" name="paper_price100" style="width:100px;" value="'.$rec['paper_price100'].'"></td>';
            print '<td><input type="text" name="paper_price1000" style="width:100px;" value="'.$rec['paper_price1000'].'"></td>';
            print '<td><input type="text" name="paper_price5000" style="width:100px;" value="'.$rec['paper_price5000'].'"></td>';
            print '<td>'.$rec['entry'].'</td>';
            if(isset($_SESSION['login'])==true){
              print '<td><input type="submit" name="t_paper_fuuto_edit" value="修正" class="btn-simple">';
              print '<input type="submit" name="t_paper_fuuto_delete" value="削除" class="btn-simple"></td>';
            }
            print '</tr>';
          print '</form>';
        }

      } catch(Exception $e) {

        print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
        exit();
      }
    ?>

    <tr>
      <form method="post" action="t_paper_fuuto_check.php">
        <td><select name="paper_name" style="width:14em;">
          <option value="クラフト" selected>クラフト</option>
          <option value="ホワイト">ホワイト</option>
          <option value="コニーカラー">コニーカラー</option>
          <option value="フレッシュトーン">フレッシュトーン</option>
          <option value="洋２ホワイト">洋２ホワイト</option>
          </select></td>
        <td><select name="paper_size" style="width:100px">
          <option value="長４">長４</option>
          <option value="長３">長３</option>
          <option value="角３">角３</option>
          <option value="角２">角２</option>
          <option value="洋形">洋形</option>
          </select></td>
        <td><select name="paper_atsusa" style="width:70px">
          <option value="70">70</option>
          <option value="80">80</option>
          <option value="85">85</option>
          <option value="100">100</option>
          </select></td>
        <td><input type="text" name="paper_price100" style="width:100px"></td>
        <td><input type="text" name="paper_price1000" style="width:100px"></td>
        <td><input type="text" name="paper_price5000" style="width:100px"></td>
        <td><input type="submit" name="t_paper_fuuto_add" value="追加" class="btn-simple"></td>
      </form>
    </tr>
  </table>
  <br />
  <form style="clear:both;"><input type="button" onclick="history.back()" value="戻る"></form>
</div> */ ?>

</div>
<a class="pagetop" href="#"><div class="pagetop__arrow"></div></a>
</body>
</html>
