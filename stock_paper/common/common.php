<?php

  //配列用サニタイジング処理
  function sanitize($string) {
      if (is_array($string)) {
          return array_map("sanitize", $string);
      } else {
          return htmlspecialchars($string, ENT_QUOTES);
      }
  }
  /*function sanitize($before){
    foreach($before as $key=>$value){
      $after[$key]=htmlspecialchars($value,ENT_QUOTES,'UTF-8');
    }
    return $after;
  }*/

  //サニタイジング処理
  function hs($string)
  {
    return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
  }

  //年プルダウン
  function pulldown_year(){
    print '<select name="year">';
    print '<option value="2017">2017</option>';
    print '<option value="2018">2018</option>';
    print '<option value="2019">2019</option>';
    print '<option value="2020">2020</option>';
    print '</select>';
  }
  //月プルダウン
  function pulldown_month(){
    print '<select name="month">';
    $i=1;
    for($i;$i<=12;$i++){
      print '<option value="'.sprintf("%02d",$i).'">'.sprintf("%02d",$i).'</option>';
    }
    print '</select>';
  }
  //日プルダウン
  function pulldown_day(){
    print '<select name="day">';
    $i=1;
    for($i;$i<=31;$i++){
      print '<option value="'.sprintf("%02d",$i).'">'.sprintf("%02d",$i).'</option>';
    }
    print '</select>';
  }

  //概算金額シミュレーション
  function gaisan_calculate($spec){
    //サニタイジング処理
    $spec=sanitize($spec);
    //初期化
    $hyoushi_plate=0;
    $hyoushi_yobishi=0;
    $text_yobishi=0;
    $paper_size='';
    $paper_plrice_select='';
    $press_copies='';
    $press_copies_select=0;
    $ofs_syoukei=0;
    $ofs_goukei=0;
    $pod_syoukei=0;
    $pod_goukei=0;
    $ofs_tcheck=array();  //チェック用
    $pod_tcheck=array();  //チェック用

    try{
      // 別ファイルに記述しているDB設定情報ファイルを読み込む
      require_once('../../conf/dsn.php');
      // mySQLに接続
      $dbh = new PDO(DSN, DB_USER, DB_PWD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      //入稿原稿処理/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      switch ($spec['upload_type']) {
        case 'Office＆PDF':
          $prepress_type='Office系ソフト・PDF';

          $sql='SELECT prepress_price FROM t_prepress_check WHERE prepress_type=?';
          $stmt=$dbh->prepare($sql);
          $data[]=$prepress_type;
          $stmt->execute($data);
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          $price=$rec['prepress_price'];

          $ofs_syoukei=$price*($spec['pages']+$spec['hyoushi_press_page']);
          $ofs_goukei+=$ofs_syoukei;
          $ofs_tcheck+=array("ofs_genkousyori"=>$ofs_syoukei);  //確認用

          //オンデマンド処理
          $sql='SELECT kihon_price FROM t_ondemand_kihon WHERE 1';
          $stmt=$dbh->prepare($sql);
          $stmt->execute();
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          $price=$rec['kihon_price'];

          $pod_syoukei=$price;
          $pod_goukei+=$pod_syoukei;
          $pod_tcheck+=array("pod_genkousyori"=>$pod_syoukei);  //確認用
          break;
        case 'Adobe系ソフト':
          $prepress_type='DTP系ソフト';

          $sql='SELECT prepress_price FROM t_prepress_check WHERE prepress_type=?';
          $stmt=$dbh->prepare($sql);
          $data[]=$prepress_type;
          $stmt->execute($data);
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          $price=$rec['prepress_price'];

          $ofs_syoukei=$price*($spec['pages']+$spec['hyoushi_press_page']);
          $ofs_goukei+=$ofs_syoukei;
          $ofs_tcheck+=array("ofs_genkousyori"=>$ofs_syoukei);  //確認用

          //オンデマンド処理
          $sql='SELECT kihon_price FROM t_ondemand_kihon WHERE 1';
          $stmt=$dbh->prepare($sql);
          $stmt->execute();
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          $price=$rec['kihon_price'];

          $pod_syoukei=$price;
          $pod_goukei+=$pod_syoukei;
          $pod_tcheck+=array("pod_genkousyori"=>$pod_syoukei);  //確認用
          break;
        case '紙版':
          $prepress_type='版下入稿';

          $sql='SELECT prepress_price FROM t_prepress_kanri WHERE prepress_type=?';
          $stmt=$dbh->prepare($sql);
          $data[]=$prepress_type;
          $stmt->execute($data);
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          $price=$rec['prepress_price'];

          $ofs_syoukei=$price*$spec['pages'];
          $ofs_goukei+=$ofs_syoukei;

          $sql='SELECT prepress_price FROM t_prepress_nonburu WHERE 1';
          $stmt=$dbh->prepare($sql);
          $stmt->execute();
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          $price=$rec['prepress_price'];

          $ofs_syoukei+=$price*$spec['pages'];
          $ofs_goukei+=$ofs_syoukei;
          $ofs_tcheck+=array("ofs_genkousyori"=>$ofs_syoukei);  //確認用

          //オンデマンド処理
          $sql='SELECT kihon_price FROM t_ondemand_kihon WHERE 1';
          $stmt=$dbh->prepare($sql);
          $stmt->execute();
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          $price=$rec['kihon_price'];

          $pod_syoukei=$price;
          $pod_goukei+=$pod_syoukei;
          $pod_tcheck+=array("pod_genkousyori"=>$pod_syoukei);  //確認用
          break;
        default:
          $ofs_goukei='別途担当者からのお見積りになります。';
          $pod_goukei='別途担当者からのお見積りになります。';
          break;
      }

      //物件管理////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      if($spec['upload_type']!='紙版'){
        if($spec['press_type']=='ページ物') {
          $kanri_pages_4c=0;
          $kanri_pages_k=0;
          if($spec['hyoushi1_4']=='カラー') {
            $kanri_pages_4c+=2;
          } else if($spec['hyoushi1_4']=='モノクロ') {
            $kanri_pages_k+=2;
          }
          if($spec['hyoushi2_3']=='カラー') {
            $kanri_pages_4c+=2;
          } else if($spec['hyoushi2_3']=='モノクロ') {
            $kanri_pages_k+=2;
          }
          if($spec['text_color']=='全ページカラー') {
            $kanri_pages_4c+=$spec['pages'];
          } else {
            $kanri_pages_k+=$spec['pages'];
          }
          $prepress_type='頁物データ入稿カラー（校正有り）';
          $data=array();
          $sql='SELECT prepress_price FROM t_prepress_kanri WHERE prepress_type=?';
          $stmt=$dbh->prepare($sql);
          $data[]=$prepress_type;
          $stmt->execute($data);
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          $price=$rec['prepress_price'];
          $ofs_syoukei=$price*$kanri_pages_4c;

          $prepress_type='頁物データ入稿モノクロ（校正有り）';
          $data=array();
          $sql='SELECT prepress_price FROM t_prepress_kanri WHERE prepress_type=?';
          $stmt=$dbh->prepare($sql);
          $data[]=$prepress_type;
          $stmt->execute($data);
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          $price=$rec['prepress_price'];
          $ofs_syoukei+=$price*$kanri_pages_k;

          $ofs_goukei+=$ofs_syoukei;
          $ofs_tcheck+=array("ofs_kanri"=>$ofs_syoukei);  //確認用

        } elseif($spec['press_type']=='ペラ物') {

        }
      }

      //面付け処理//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      switch ($spec['press_type']) {
        case 'ページ物':
          $prepress_type='ページ物／１頁';
          $data=array();
          $sql='SELECT prepress_price FROM t_prepress_mentsuke WHERE prepress_type=?';
          $stmt=$dbh->prepare($sql);
          $data[]=$prepress_type;
          $stmt->execute($data);
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          $price=$rec['prepress_price'];

          $ofs_syoukei=$price*$spec['pages'];
          $ofs_goukei+=$ofs_syoukei;
          $ofs_tcheck+=array("ofs_mentsuke"=>$ofs_syoukei); //確認用

          //オンデマンド処理
          $ondemand_type='ページ物／１頁';
          $data=array();
          $sql='SELECT ondemand_price FROM t_ondemand_mentsuke WHERE ondemand_type=?';
          $stmt=$dbh->prepare($sql);
          $data[]=$ondemand_type;
          $stmt->execute($data);
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          $price=$rec['ondemand_price'];

          $pod_syoukei=$price*$spec['pages'];
          $pod_goukei+=$pod_syoukei;
          $pod_tcheck+=array("pod_mentsuke"=>$pod_syoukei); //確認用
          break;
        case 'ペラ物':
          $prepress_type='小物／片面';
          $data=array();
          $sql='SELECT prepress_price FROM t_prepress_mentsuke WHERE prepress_type=?';
          $stmt=$dbh->prepare($sql);
          $data[]=$prepress_type;
          $stmt->execute($data);
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          $price=$rec['prepress_price'];

          if($spec['text_press']=='全ページ片面印刷'){
            $ofs_syoukei=$price;
          } else {
            $ofs_syoukei=$price*2;
          }
          $ofs_goukei+=$ofs_syoukei;
          $ofs_tcheck+=array("ofs_mentsuke"=>$ofs_syoukei); //確認用

          //オンデマンド処理
          $ondemand_type='小物／片面';
          $data=array();
          $sql='SELECT ondemand_price FROM t_ondemand_mentsuke WHERE ondemand_type=?';
          $stmt=$dbh->prepare($sql);
          $data[]=$ondemand_type;
          $stmt->execute($data);
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          $price=$rec['ondemand_price'];

          if($spec['text_press']=='全ページ片面印刷'){
            $pod_syoukei=$price;
          } else {
            $pod_syoukei=$price*2;
          }
          $pod_goukei+=$pod_syoukei;
          $pod_tcheck+=array("pod_mentsuke"=>$pod_syoukei); //確認用
          break;
        default:
          $ofs_goukei='別途担当者からのお見積りになります。';
          $pod_goukei='別途担当者からのお見積りになります。';
          break;
      }

      //表紙/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      //表紙CTP//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      if($spec['hyoushi1_4']=='カラー' || $spec['hyoushi2_3']=='カラー' || $spec['hyoushi_paper']=='コート' || $spec['hyoushi_paper']=='マットコート'){
        $prepress_type='ＣＴＰ';
        //表紙CTP＞刷版
        $data=array();
        $sql='SELECT prepress_price FROM t_prepress_plate WHERE prepress_type=?';
        $stmt=$dbh->prepare($sql);
        $data[]=$prepress_type;
        $stmt->execute($data);
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        $price=$rec['prepress_price'];

        switch ($spec['hyoushi1_4']) {
          case 'カラー':
            $ofs_syoukei=$price*4;
            $hyoushi_plate=4;
            $hyoushi_yobishi+=50*4;
            break;
          case 'モノクロ':
            $ofs_syoukei=$price;
            $hyoushi_plate=1;
            $hyoushi_yobishi+=50;
            break;
          default:
            $ofs_syoukei=0;
            break;
        }
        switch ($spec['hyoushi2_3']) {
          case 'カラー':
            $ofs_syoukei+=$price*4;
            $hyoushi_plate+=4;
            $hyoushi_yobishi+=50*4;
            break;
          case 'モノクロ':
            $ofs_syoukei+=$price;
            $hyoushi_plate+=1;
            $hyoushi_yobishi+=50;
            break;
          default:
            $ofs_syoukei+=0;
            break;
        }
        $ofs_goukei+=$ofs_syoukei;
        $ofs_tcheck+=array("ofs_hplate"=>$ofs_syoukei); //確認用

        //表紙CTP＞用紙
        switch ($spec['hyoushi_paper']) {
          case '上質':
          case 'コート':
          case 'マットコート':
            $paper_size='菊判４切';
            switch ($spec['hpaper_atsusa']) {
              case '70':
                $hpaper_atsusa='48.5';
                break;
              case '90':
                $hpaper_atsusa='62.5';
                break;
              case '110':
                $hpaper_atsusa='76.5';
                break;
              case '135':
                $hpaper_atsusa='93.5';
                break;
              default:
                $ofs_goukei='別途担当者からのお見積りになります。';
                $pod_goukei='別途担当者からのお見積りになります。';
                break;
            }
            $data=array();
            $sql='SELECT paper_price FROM t_paper_text WHERE paper_name=? AND paper_size=? AND paper_atsusa=?';
            $stmt=$dbh->prepare($sql);
            $data[]=$spec['hyoushi_paper'];
            $data[]=$paper_size;
            $data[]=$hpaper_atsusa;
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['paper_price'];

            if($spec['size']=='A4' || $spec['size']=='B5'){
              $ofs_syoukei=($price*2)*($spec['copies']/2+$hyoushi_yobishi);
            } else {
              $ofs_syoukei=($price*2)*($spec['copies']/4+$hyoushi_yobishi);
            }
            break;
          case '色上質':
            if($spec['hpaper_atsusa']=='厚口' || $spec['hpaper_atsusa']=='特厚'){
              $hyoushi_paper='日本の色上質';
            } else {
              $hyoushi_paper='紀州の色上質';
            }
            $paper_size='Ａ判４切';
            $data=array();
            $sql='SELECT paper_price FROM t_paper_text WHERE paper_name=? AND paper_size=? AND paper_atsusa=?';
            $stmt=$dbh->prepare($sql);
            $data[]=$hyoushi_paper;
            $data[]=$paper_size;
            $data[]=$spec['hpaper_atsusa'];
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['paper_price'];

            if($spec['size']=='A4' || $spec['size']=='B5'){
              $ofs_syoukei=($price*2)*($spec['copies']/2+$hyoushi_yobishi);
            } else {
              $ofs_syoukei=($price*2)*($spec['copies']/4+$hyoushi_yobishi);
            }
            break;
          case 'レザック６６':
          case 'レザック８０つむぎ':
            if($spec['size']=='A5' || $spec['size']=='B6'){
              $press_copies=$spec['copies']/2+$hyoushi_yobishi;
            } else {
              $press_copies=$spec['copies']+$hyoushi_yobishi;
            }
            $paper_size='四六判４切';
            $paper_color='Ａ色';
            switch ($press_copies) {
              case $press_copies<=100:
                $paper_plrice_select='paper_price200';
                break;
              case $press_copies<=200:
                $paper_plrice_select='paper_price400';
                break;
              case $press_copies<=300:
                $paper_plrice_select='paper_price600';
                break;
              case $press_copies<=400:
                $paper_plrice_select='paper_price800';
                break;
              default:
                $paper_plrice_select='paper_price801';
                break;
            }
            $data=array();
            $sql="SELECT {$paper_plrice_select} FROM t_paper_sp WHERE paper_name=? AND paper_size=? AND paper_atsusa=? AND paper_color=?";
            $stmt=$dbh->prepare($sql);
            $data[]=$spec['hyoushi_paper'];
            $data[]=$paper_size;
            $data[]=$spec['hpaper_atsusa'];
            $data[]=$paper_color;
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec[$paper_plrice_select];

            $ofs_syoukei=$price*$press_copies;
            break;
          default:
            $ofs_goukei='別途担当者からのお見積りになります。';
            $pod_goukei='別途担当者からのお見積りになります。';
            break;
        }
        $ofs_goukei+=$ofs_syoukei;
        $ofs_tcheck+=array("ofs_hpaper"=>$ofs_syoukei); //確認用

        //表紙CTP＞印刷
        $press_copies=0;
        $ofs_syoukei=0;
        if($spec['hyoushi_paper']!='レザック６６' || $spec['hyoushi_paper']!='レザック８０つむぎ'){
          if($spec['size']=='A5' || $spec['size']=='B6'){
            $press_copies=$spec['copies']/4;
          } else {
            $press_copies=$spec['copies']/2;
          }
        } else {
          if($spec['size']=='A5' || $spec['size']=='B6'){
            $press_copies=$spec['copies']/2;
          } else {
            $press_copies=$spec['copies'];
          }
        }
        if($spec['hyoushi1_4']=='カラー' || $spec['hyoushi2_3']=='カラー'){
          $press_copies_select=0;
          $data=array();
          if($press_copies>10000) {
            $press_copies_select=10000;
            $sql="SELECT A2_1c FROM t_press_4c WHERE copies>{$press_copies_select} ORDER BY copies ASC LIMIT 1";
            $stmt=$dbh->prepare($sql);
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['A2_1c'];
            $ofs_syoukei=($price*($press_copies-$press_copies_select))*$hyoushi_plate;

            $sql='SELECT A2_1c FROM t_press_4c WHERE copies=? ORDER BY copies ASC LIMIT 1';
            $stmt=$dbh->prepare($sql);
            $data[]=$press_copies_select;
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['A2_1c'];
            $ofs_syoukei+=$price*$hyoushi_plate;
          } else {
            $sql="SELECT A2_1c FROM t_press_4c WHERE copies>={$press_copies} ORDER BY copies ASC LIMIT 1";
            $stmt=$dbh->prepare($sql);
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['A2_1c'];
            $ofs_syoukei=$price*$hyoushi_plate;
          }
        } else if($spec['hyoushi1_4']=='モノクロ' && $spec['hyoushi2_3']=='モノクロ'){
          switch ($press_copies) {
            case $press_copies>=1000 && $press_copies<=2000:
              $press_copies_select=1000;
              $data=array();
              $sql="SELECT A2 FROM t_press_k WHERE copies>{$press_copies_select} ORDER BY copies ASC LIMIT 1";
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['A2'];
              $ofs_syoukei=($price*($press_copies-1000))*$hyoushi_plate;

              $data=array();
              $sql='SELECT A2 FROM t_press_k WHERE copies=1000';
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['A2'];
              $ofs_syoukei+=$price*$hyoushi_plate;
              break;
            case $press_copies>2000:
              $press_copies_select=2000;
              $data=array();
              $sql="SELECT A2 FROM t_press_k WHERE copies>{$press_copies_select} ORDER BY copies ASC LIMIT 1";
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['A2'];
              $ofs_syoukei=($price*($press_copies-1000))*$hyoushi_plate;

              $data=array();
              $sql='SELECT A2 FROM t_press_k WHERE copies=1000';
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['A2'];
              $ofs_syoukei+=$price*$hyoushi_plate;
              break;
            default:
              $data=array();
              $sql="SELECT A2 FROM t_press_k WHERE copies>={$press_copies} ORDER BY copies ASC LIMIT 1";
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['A2'];
              $ofs_syoukei=$price*$hyoushi_plate;
              break;
          }
        }
        $ofs_goukei+=$ofs_syoukei;
        $ofs_tcheck+=array("ofs_hpress"=>$ofs_syoukei); //確認用

      } else {
      //表紙BM & PCTP/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $prepress_type='ＢＭ、ピンクマスター';
        //表紙BM & PCTP＞刷版
        $data=array();
        $sql='SELECT prepress_price FROM t_prepress_plate WHERE prepress_type=?';
        $stmt=$dbh->prepare($sql);
        $data[]=$prepress_type;
        $stmt->execute($data);
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        $price=$rec['prepress_price'];

        if($spec['hyoushi1_4']=='なし' && $spec['hyoushi2_3']=='なし'){
          $ofs_syoukei=0;
        } else if($spec['hyoushi1_4']=='なし' || $spec['hyoushi2_3']=='なし') {
          $ofs_syoukei=$price;
          $hyoushi_plate=1;
          $hyoushi_yobishi+=20;
        } else {
          $ofs_syoukei=$price*2;
          $hyoushi_plate=2;
          $hyoushi_yobishi+=20*2;
        }
        $ofs_goukei+=$ofs_syoukei;
        $ofs_tcheck+=array("ofs_hplate"=>$ofs_syoukei); //確認用

        //表紙BM & PCTP＞用紙
        switch ($spec['hyoushi_paper']) {
          case '上質':
          case 'コート':
          case 'マットコート':
            if(($spec['size']=='A4' && $spec['hyoushi_cut_off']=='なし') || ($spec['size']=='A5' && $spec['hyoushi_cut_off']=='なし') || ($spec['size']=='B5' && $spec['hyoushi_cut_off']=='有り') || ($spec['size']=='B6' && $spec['hyoushi_cut_off']=='有り')){
              $paper_size='Ａ判４切';
              switch ($spec['hpaper_atsusa']) {
                case '70':
                  $hpaper_atsusa='44.5';
                  break;
                case '90':
                  $hpaper_atsusa='57.5';
                  break;
                case '110':
                  $hpaper_atsusa='70.5';
                  break;
                default:
                  $hpaper_atsusa='86.5';
                  break;
              }
            } else if(($spec['size']=='A4' && $spec['hyoushi_cut_off']=='有り') || ($spec['size']=='A5' && $spec['hyoushi_cut_off']=='有り')){
              $paper_size='菊判４切';
              switch ($spec['hpaper_atsusa']) {
                case '70':
                  $hpaper_atsusa='48.5';
                  break;
                case '90':
                  $hpaper_atsusa='62.5';
                  break;
                case '110':
                  $hpaper_atsusa='76.5';
                  break;
                default:
                  $hpaper_atsusa='93.5';
                  break;
              }
            } else {
              $paper_size='四六判８切';
              $hpaper_atsusa=$spec['hpaper_atsusa'];
            }
            $data=array();
            $sql='SELECT paper_price FROM t_paper_text WHERE paper_name=? AND paper_size=? AND paper_atsusa=?';
            $stmt=$dbh->prepare($sql);
            $data[]=$spec['hyoushi_paper'];
            $data[]=$paper_size;
            $data[]=$hpaper_atsusa;
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['paper_price'];

            if($spec['size']=='A4' || $spec['size']=='B5'){
              $ofs_syoukei=$price*($spec['copies']+$hyoushi_yobishi);
            } else {
              $ofs_syoukei=$price*($spec['copies']/2+$hyoushi_yobishi);
            }
            break;
          case '色上質':
            if($spec['hpaper_atsusa']=='厚口' || $spec['hpaper_atsusa']=='特厚'){
              $hyoushi_paper='日本の色上質';
            } else {
              $hyoushi_paper='紀州の色上質';
            }
            if(($spec['size']=='B5' && $spec['hyoushi_cut_off']=='なし') || ($spec['size']=='B6' && $spec['hyoushi_cut_off']=='なし')){
              $paper_size='四六判８切';
            } else {
              $paper_size='Ａ判４切';
            }
            $data=array();
            $sql='SELECT paper_price FROM t_paper_text WHERE paper_name=? AND paper_size=? AND paper_atsusa=?';
            $stmt=$dbh->prepare($sql);
            $data[]=$hyoushi_paper;
            $data[]=$paper_size;
            $data[]=$spec['hpaper_atsusa'];
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['paper_price'];

            if($spec['size']=='A4' || $spec['size']=='B5'){
              $ofs_syoukei=$price*($spec['copies']+$hyoushi_yobishi);
            } else {
              $ofs_syoukei=$price*($spec['copies']/2+$hyoushi_yobishi);
            }
            break;
          case 'レザック６６':
          case 'レザック８０つむぎ':
            if($spec['size']=='A5' || $spec['size']=='B6'){
              $press_copies=$spec['copies']/2+$hyoushi_yobishi;
            } else {
              $press_copies=$spec['copies']+$hyoushi_yobishi;
            }
            if(($spec['size']=='B5' && $spec['hyoushi_cut_off']=='なし') || ($spec['size']=='B6' && $spec['hyoushi_cut_off']=='なし')){
              $paper_size='四六判８切';
            } else {
              $paper_size='四六判４切';
            }
            $paper_color='Ａ色';
            if($paper_size=='四六判８切'){
              switch ($press_copies) {
                case $press_copies<=200:
                  $paper_plrice_select='paper_price200';
                  break;
                case $press_copies<=400:
                  $paper_plrice_select='paper_price400';
                  break;
                case $press_copies<=600:
                  $paper_plrice_select='paper_price600';
                  break;
                case $press_copies<=800:
                  $paper_plrice_select='paper_price800';
                  break;
                default:
                  $paper_plrice_select='paper_price801';
                  break;
              }
            } else {
              switch ($press_copies) {
                case $press_copies<=100:
                  $paper_plrice_select='paper_price200';
                  break;
                case $press_copies<=200:
                  $paper_plrice_select='paper_price400';
                  break;
                case $press_copies<=300:
                  $paper_plrice_select='paper_price600';
                  break;
                case $press_copies<=400:
                  $paper_plrice_select='paper_price800';
                  break;
                default:
                  $paper_plrice_select='paper_price801';
                  break;
              }
            }
            $data=array();
            $sql="SELECT {$paper_plrice_select} FROM t_paper_sp WHERE paper_name=? AND paper_size=? AND paper_atsusa=? AND paper_color=?";
            $stmt=$dbh->prepare($sql);
            $data[]=$spec['hyoushi_paper'];
            $data[]=$paper_size;
            $data[]=$spec['hpaper_atsusa'];
            $data[]=$paper_color;
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec[$paper_plrice_select];

            $ofs_syoukei=$price*$press_copies;
            break;
          default:
            $ofs_goukei='別途担当者からのお見積りになります。';
            $pod_goukei='別途担当者からのお見積りになります。';
            break;
        }
        $ofs_goukei+=$ofs_syoukei;
        $ofs_tcheck+=array("ofs_hpaper"=>$ofs_syoukei); //確認用

        //表紙BM & PCTP＞印刷
        $press_copies=0;
        $press_copies_select=0;
        $ofs_syoukei=0;
        if($spec['size']=='A5' || $spec['size']=='B6'){
          $press_copies=$spec['copies']/2;
        } else {
          $press_copies=$spec['copies'];
        }
        if($spec['size']=='A4' || $spec['size']=='A5'){
          switch ($press_copies) {
            case $press_copies>=1000 && $press_copies<=2000:
              $press_copies_select=1000;
              $data=array();
              $sql="SELECT A3 FROM t_press_k WHERE copies>{$press_copies_select} ORDER BY copies ASC LIMIT 1";
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['A3'];
              $ofs_syoukei=($price*($press_copies-1000))*$hyoushi_plate;

              $data=array();
              $sql='SELECT A3 FROM t_press_k WHERE copies=1000';
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['A3'];
              $ofs_syoukei+=$price*$hyoushi_plate;
              break;
            case $press_copies>2000:
              $press_copies_select=2000;
              $data=array();
              $sql="SELECT A3 FROM t_press_k WHERE copies>{$press_copies_select} ORDER BY copies ASC LIMIT 1";
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['A3'];
              $ofs_syoukei=($price*($press_copies-1000))*$hyoushi_plate;

              $data=array();
              $sql='SELECT A3 FROM t_press_k WHERE copies=1000';
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['A3'];
              $ofs_syoukei+=$price*$hyoushi_plate;
              break;
            default:
              $data=array();
              $sql="SELECT A3 FROM t_press_k WHERE copies>={$press_copies} ORDER BY copies ASC LIMIT 1";
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['A3'];
              $ofs_syoukei=$price*$hyoushi_plate;
              break;
          }
        } else {
          switch ($press_copies) {
            case $press_copies>=1000 && $press_copies<=2000:
              $press_copies_select=1000;
              $data=array();
              $sql="SELECT B4 FROM t_press_k WHERE copies>{$press_copies_select} ORDER BY copies ASC LIMIT 1";
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['B4'];
              $ofs_syoukei=($price*($press_copies-1000))*$hyoushi_plate;

              $data=array();
              $sql='SELECT B4 FROM t_press_k WHERE copies=1000';
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['B4'];
              $ofs_syoukei+=$price*$hyoushi_plate;
              break;
            case $press_copies>2000:
              $press_copies_select=2000;
              $data=array();
              $sql="SELECT B4 FROM t_press_k WHERE copies>{$press_copies_select} ORDER BY copies ASC LIMIT 1";
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['B4'];
              $ofs_syoukei=($price*($press_copies-1000))*$hyoushi_plate;

              $data=array();
              $sql='SELECT B4 FROM t_press_k WHERE copies=1000';
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['B4'];
              $ofs_syoukei+=$price*$hyoushi_plate;
              break;
            default:
              $data=array();
              $sql="SELECT B4 FROM t_press_k WHERE copies>={$press_copies} ORDER BY copies ASC LIMIT 1";
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['B4'];
              $ofs_syoukei=$price*$hyoushi_plate;
              break;
          }
        }
        $ofs_goukei+=$ofs_syoukei;
        $ofs_tcheck+=array("ofs_hpress"=>$ofs_syoukei); //確認用

      }
      //表紙END

      //本文/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      //本文CTP//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      if($spec['text_color']=='全ページカラー' || $spec['text_paper']=='コート' || $spec['text_paper']=='マットコート') {
        $prepress_type='ＣＴＰ';
        //本文CTP＞刷版
        $data=array();
        $sql='SELECT prepress_price FROM t_prepress_plate WHERE prepress_type=?';
        $stmt=$dbh->prepare($sql);
        $data[]=$prepress_type;
        $stmt->execute($data);
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        $price=$rec['prepress_price'];

        if($spec['size']=='A4' || $spec['size']=='B5'){
          $text_daisu=ceil($spec['pages']/8);    //本文CTP＞8頁立て台数
        } else {
          $text_daisu=ceil($spec['pages']/16);    //本文CTP＞16頁立て台数
        }
        if($spec['text_color']=='全ページカラー') {
          $ofs_syoukei=$text_daisu*2*4*$price;    //本文CTP＞カラー版数
          $text_yobishi=50*($text_daisu*2*4);
        } else {
          $ofs_syoukei=$text_daisu*2*$price;    //本文CTP＞モノクロ版数
          $text_yobishi=0;
        }
        $ofs_goukei+=$ofs_syoukei;
        $ofs_tcheck+=array("ofs_tplate"=>$ofs_syoukei); //確認用

        //本文CTP＞用紙
        switch ($spec['text_paper']) {
          case '上質':
          case 'コート':
          case 'マットコート':
            $paper_size='菊判４切';
            $press_paper_size='Ａ２';
            switch ($spec['tpaper_atsusa']) {
              case '70':
                $tpaper_atsusa='48.5';
                break;
              case '90':
                $tpaper_atsusa='62.5';
                break;
              case '110':
                $tpaper_atsusa='76.5';
                break;
              case '135':
                $tpaper_atsusa='93.5';
                break;
              default:
                $ofs_goukei='別途担当者からのお見積りになります。';
                $pod_goukei='別途担当者からのお見積りになります。';
                break;
            }
            $data=array();
            $sql='SELECT paper_price FROM t_paper_text WHERE paper_name=? AND paper_size=? AND paper_atsusa=?';
            $stmt=$dbh->prepare($sql);
            $data[]=$spec['text_paper'];
            $data[]=$paper_size;
            $data[]=$tpaper_atsusa;
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['paper_price'];

            if($spec['size']=='A4' || $spec['size']=='B5'){
              $ofs_syoukei=($price*2)*($spec['pages']/8*$spec['copies']); //本文CTP＞8頁立て用紙
            } else {
              $ofs_syoukei=($price*2)*($spec['pages']/16*$spec['copies']);  //本文CTP＞16頁立て用紙
            }
            break;
          case '色上質':
            $text_paper='日本の色上質';
            $paper_size='Ａ判４切';
            $press_paper_size='Ａ２';
            $data=array();
            $sql='SELECT paper_price FROM t_paper_text WHERE paper_name=? AND paper_size=? AND paper_atsusa=?';
            $stmt=$dbh->prepare($sql);
            $data[]=$text_paper;
            $data[]=$paper_size;
            $data[]=$spec['tpaper_atsusa'];
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['paper_price'];

            if($spec['size']=='A4' || $spec['size']=='B5'){
              $ofs_syoukei=($price*2)*($spec['pages']/8*$spec['copies']); //本文CTP＞8頁立て用紙
            } else {
              $ofs_syoukei=($price*2)*($spec['pages']/16*$spec['copies']);  //本文CTP＞16頁立て用紙
            }
            break;
          case '書籍（淡クリームキンマリ）':
            $paper_size='Ａ判４切';
            $press_paper_size='Ａ２';
            if($spec['tpaper_atsusa']=='72.5'){
              $tpaper_atsusa='46.5';
            }
            $data=array();
            $sql='SELECT paper_price FROM t_paper_text WHERE paper_name=? AND paper_size=? AND paper_atsusa=?';
            $stmt=$dbh->prepare($sql);
            $data[]=$spec['text_paper'];
            $data[]=$paper_size;
            $data[]=$tpaper_atsusa;
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['paper_price'];

            if($spec['size']=='A4' || $spec['size']=='B5'){
              $ofs_syoukei=($price*2)*($spec['pages']/8*$spec['copies']); //本文CTP＞8頁立て用紙
            } else {
              $ofs_syoukei=($price*2)*($spec['pages']/16*$spec['copies']);  //本文CTP＞16頁立て用紙
            }
            break;
          default:
            $ofs_goukei='別途担当者からのお見積りになります。';
            $pod_goukei='別途担当者からのお見積りになります。';
            break;
        }
        $ofs_goukei+=$ofs_syoukei;
        $ofs_tcheck+=array("ofs_tpaper"=>$ofs_syoukei); //確認用

        //本文CTP＞印刷
        $ofs_syoukei=0;

        if($spec['text_color']=='全ページカラー'){
          if($spec['copies']>10000) {
            $press_copies_select=10000;
            $data=array();
            $sql="SELECT A2_1c FROM t_press_4c WHERE copies>{$press_copies_select} ORDER BY copies ASC LIMIT 1";
            $stmt=$dbh->prepare($sql);
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['A2_1c'];
            $ofs_syoukei=($price*($spec['copies']-$press_copies_select))*$text_daisu*2*4;

            $data=array();
            $sql='SELECT A2_1c FROM t_press_4c WHERE copies=? ORDER BY copies ASC LIMIT 1';
            $stmt=$dbh->prepare($sql);
            $data[]=$press_copies_select;
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['A2_1c'];
            $ofs_syoukei+=$price*$text_daisu*2*4;
          } else {
            $data=array();
            $sql="SELECT A2_1c FROM t_press_4c WHERE copies>={$spec['copies']} ORDER BY copies ASC LIMIT 1";
            $stmt=$dbh->prepare($sql);
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['A2_1c'];
            $ofs_syoukei=$price*$text_daisu*2*4;
          }
        } else if($spec['text_color']=='全ページモノクロ'){
          if($spec['copies']>10000) {
            $press_copies_select=10000;
            $data=array();
            $sql="SELECT A2 FROM t_press_k WHERE copies>{$press_copies_select} ORDER BY copies ASC LIMIT 1";
            $stmt=$dbh->prepare($sql);
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['A2'];
            $ofs_syoukei=($price*($spec['copies']-$press_copies_select))*$text_daisu*2;

            $data=array();
            $sql='SELECT A2 FROM t_press_k WHERE copies=? ORDER BY copies ASC LIMIT 1';
            $stmt=$dbh->prepare($sql);
            $data[]=$press_copies_select;
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['A2'];
            $ofs_syoukei+=$price*$text_daisu*2;
          } else {
            $data=array();
            $sql="SELECT A2 FROM t_press_k WHERE copies>={$spec['copies']} ORDER BY copies ASC LIMIT 1";
            $stmt=$dbh->prepare($sql);
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['A2'];
            $ofs_syoukei=$price*$text_daisu*2;
          }
        }
        $ofs_goukei+=$ofs_syoukei;
        $ofs_tcheck+=array("ofs_tpress"=>$ofs_syoukei); //確認用

      } else {
      //本文BM & PCTP/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $prepress_type='ＢＭ、ピンクマスター';
        //本文BM & PCTP＞刷版
        $data=array();
        $sql='SELECT prepress_price FROM t_prepress_plate WHERE prepress_type=?';
        $stmt=$dbh->prepare($sql);
        $data[]=$prepress_type;
        $stmt->execute($data);
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        $price=$rec['prepress_price'];

        if($spec['size']=='A4' || $spec['size']=='B6'){
          $text_daisu=ceil($spec['pages']/4);    //本文BM & PCTP＞4頁立て台数
        } else {
          $text_daisu=ceil($spec['pages']/8);    //本文BM & PCTP＞8頁立て台数
        }
        $ofs_syoukei=$text_daisu*2*$price;    //本文BM & PCTP＞モノクロ版数

        $ofs_goukei+=$ofs_syoukei;
        $ofs_tcheck+=array("ofs_tplate"=>$ofs_syoukei); //確認用

        //本文BM & PCTP＞用紙
        switch ($spec['text_paper']) {
          case '上質':
            if(($spec['size']=='A4' && $spec['text_cut_off']=='なし') || ($spec['size']=='A5' && $spec['text_cut_off']=='なし') || ($spec['size']=='B5' && $spec['text_cut_off']=='有り') || ($spec['size']=='B6' && $spec['text_cut_off']=='有り')){
              $paper_size='Ａ判４切';
              $press_paper_size='Ａ３';
              switch ($spec['tpaper_atsusa']) {
                case '70':
                  $tpaper_atsusa='44.5';
                  break;
                case '90':
                  $tpaper_atsusa='57.5';
                  break;
                case '110':
                  $tpaper_atsusa='70.5';
                  break;
                default:
                  $tpaper_atsusa='86.5';
                  break;
              }
            } else if(($spec['size']=='A4' && $spec['text_cut_off']=='有り') || ($spec['size']=='A5' && $spec['text_cut_off']=='有り')){
              $paper_size='菊判４切';
              $press_paper_size='Ａ３';
              switch ($spec['tpaper_atsusa']) {
                case '70':
                  $tpaper_atsusa='48.5';
                  break;
                case '90':
                  $tpaper_atsusa='62.5';
                  break;
                case '110':
                  $tpaper_atsusa='76.5';
                  break;
                default:
                  $tpaper_atsusa='93.5';
                  break;
              }
            } else {
              $paper_size='四六判８切';
              $press_paper_size='Ｂ４';
              $tpaper_atsusa=$spec['tpaper_atsusa'];
            }
            $data=array();
            $sql='SELECT paper_price FROM t_paper_text WHERE paper_name=? AND paper_size=? AND paper_atsusa=?';
            $stmt=$dbh->prepare($sql);
            $data[]=$spec['text_paper'];
            $data[]=$paper_size;
            $data[]=$tpaper_atsusa;
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['paper_price'];

            if($spec['size']=='A4' || $spec['size']=='B5'){
              $ofs_syoukei=$price*($spec['pages']/4*$spec['copies']); //本文BM & PCTP＞4頁立て用紙
            } else {
              $ofs_syoukei=$price*($spec['pages']/8*$spec['copies']);  //本文BM & PCTP＞8頁立て用紙
            }
            break;
          case '色上質':
            $text_paper='日本の色上質';
            if(($spec['size']=='B5' && $spec['text_cut_off']=='なし') || ($spec['size']=='B6' && $spec['text_cut_off']=='なし')){
              $paper_size='四六判８切';
              $press_paper_size='Ｂ４';
            } else {
              $paper_size='Ａ判４切';
              $press_paper_size='Ａ３';
            }
            $data=array();
            $sql='SELECT paper_price FROM t_paper_text WHERE paper_name=? AND paper_size=? AND paper_atsusa=?';
            $stmt=$dbh->prepare($sql);
            $data[]=$text_paper;
            $data[]=$paper_size;
            $data[]=$spec['tpaper_atsusa'];
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['paper_price'];

            if($spec['size']=='A4' || $spec['size']=='B5'){
              $ofs_syoukei=$price*($spec['pages']/4*$spec['copies']); //本文BM & PCTP＞4頁立て用紙
            } else {
              $ofs_syoukei=$price*($spec['pages']/8*$spec['copies']);  //本文BM & PCTP＞8頁立て用紙
            }
            break;
          case '書籍（淡クリームキンマリ）':
            $paper_size='Ａ判４切';
            $press_paper_size='Ａ３';
            if($spec['tpaper_atsusa']=='72.5'){
              $tpaper_atsusa='46.5';
            }
            $data=array();
            $sql='SELECT paper_price FROM t_paper_text WHERE paper_name=? AND paper_size=? AND paper_atsusa=?';
            $stmt=$dbh->prepare($sql);
            $data[]=$spec['text_paper'];
            $data[]=$paper_size;
            $data[]=$tpaper_atsusa;
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['paper_price'];

            if($spec['size']=='A4' || $spec['size']=='B5'){
              $ofs_syoukei=$price*($spec['pages']/4*$spec['copies']); //本文BM & PCTP＞4頁立て用紙
            } else {
              $ofs_syoukei=$price*($spec['pages']/8*$spec['copies']);  //本文BM & PCTP＞8頁立て用紙
            }
            break;
          default:
            $ofs_goukei='別途担当者からのお見積りになります。';
            $pod_goukei='別途担当者からのお見積りになります。';
            break;
        }
        $ofs_goukei+=$ofs_syoukei;
        $ofs_tcheck+=array("ofs_tpaper"=>$ofs_syoukei); //確認用

        //本文BM & PCTP＞印刷
        $press_copies=0;
        $press_copies_select=0;
        $ofs_syoukei=0;
        $press_copies=$spec['copies'];
        if($spec['size']=='A4' || $spec['size']=='A5'){
          switch ($press_copies) {
            case $press_copies>=1000 && $press_copies<=2000:
              $press_copies_select=1000;
              $data=array();
              $sql="SELECT A3 FROM t_press_k WHERE copies>{$press_copies_select} ORDER BY copies ASC LIMIT 1";
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['A3'];
              $ofs_syoukei=($price*($press_copies-1000))*$text_daisu*2;

              $data=array();
              $sql='SELECT A3 FROM t_press_k WHERE copies=1000';
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['A3'];
              $ofs_syoukei+=$price*$text_daisu*2;
              break;
            case $press_copies>2000:
              $press_copies_select=2000;
              $data=array();
              $sql="SELECT A3 FROM t_press_k WHERE copies>{$press_copies_select} ORDER BY copies ASC LIMIT 1";
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['A3'];
              $ofs_syoukei=($price*($press_copies-1000))*$text_daisu*2;

              $data=array();
              $sql='SELECT A3 FROM t_press_k WHERE copies=1000';
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['A3'];
              $ofs_syoukei+=$price*$text_daisu*2;
              break;
            default:
              $data=array();
              $sql="SELECT A3 FROM t_press_k WHERE copies>={$press_copies} ORDER BY copies ASC LIMIT 1";
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['A3'];
              $ofs_syoukei=$price*$text_daisu*2;
              break;
          }
        } else {
          switch ($press_copies) {
            case $press_copies>=1000 && $press_copies<=2000:
              $press_copies_select=1000;
              $data=array();
              $sql="SELECT B4 FROM t_press_k WHERE copies>{$press_copies_select} ORDER BY copies ASC LIMIT 1";
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['B4'];
              $ofs_syoukei=($price*($press_copies-1000))*$text_daisu*2;

              $data=array();
              $sql='SELECT B4 FROM t_press_k WHERE copies=1000';
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['B4'];
              $ofs_syoukei+=$price*$text_daisu*2;
              break;
            case $press_copies>2000:
              $press_copies_select=2000;
              $data=array();
              $sql="SELECT B4 FROM t_press_k WHERE copies>{$press_copies_select} ORDER BY copies ASC LIMIT 1";
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['B4'];
              $ofs_syoukei=($price*($press_copies-1000))*$text_daisu*2;

              $data=array();
              $sql='SELECT B4 FROM t_press_k WHERE copies=1000';
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['B4'];
              $ofs_syoukei+=$price*$text_daisu*2;
              break;
            default:
              $data=array();
              $sql="SELECT B4 FROM t_press_k WHERE copies>={$press_copies} ORDER BY copies ASC LIMIT 1";
              $stmt=$dbh->prepare($sql);
              $stmt->execute($data);
              $rec=$stmt->fetch(PDO::FETCH_ASSOC);
              $price=$rec['B4'];
              $ofs_syoukei=$price*$text_daisu*2;
              break;
          }
        }
        $ofs_goukei+=$ofs_syoukei;
        $ofs_tcheck+=array("ofs_tpress"=>$ofs_syoukei); //確認用
      }
      //本文END

      //製本処理/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      $ofs_syoukei=0;
      switch ($spec['bookb_type']) {
        case '無線とじ':
          if($prepress_type=='ＣＴＰ'){  //CTP本文印字
            if($spec['size']=='A4' || $spec['size']=='B5'){
              $postpress_pagegake='８頁がけ';
            } else {
              $postpress_pagegake='１６頁がけ';
            }
          } else {                      //BM & PCTP本文印字
            if($spec['size']=='A4' || $spec['size']=='B5'){
              $press_paper_size='Ａ３／Ｂ４';
              $postpress_pagegake='４頁がけ';
            } else {
              $postpress_pagegake='８頁がけ';
            }
          }
          $data=array();
          if($spec['copies']<300){
            $sql="SELECT postpress_price299 FROM t_postpress_choai WHERE postpress_size=? AND postpress_pagegake=?";
          } else {
            $sql="SELECT postpress_price300 FROM t_postpress_choai WHERE postpress_size=? AND postpress_pagegake=?";
          }
          $stmt=$dbh->prepare($sql);
          $data[]=$press_paper_size;
          $data[]=$postpress_pagegake;
          $stmt->execute($data);
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          if($spec['copies']<300){
            $price=$rec['postpress_price299'];
          } else {
            $price=$rec['postpress_price300'];
          }
          $ofs_syoukei=$price*$text_daisu*$spec['copies'];
          $ofs_tcheck+=array("ofs_choai"=>$ofs_syoukei); //確認用

          $data=array();
          if($spec['size']=='A4') {
            $sql="SELECT A4 FROM t_postpress_maki WHERE copies>={$spec['copies']} ORDER BY copies ASC LIMIT 1";
          } else if($spec['size']=='B5') {
            $sql="SELECT B5 FROM t_postpress_maki WHERE copies>={$spec['copies']} ORDER BY copies ASC LIMIT 1";
          } else {
            $sql="SELECT A5_B6 FROM t_postpress_maki WHERE copies>={$spec['copies']} ORDER BY copies ASC LIMIT 1";
          }
          $stmt=$dbh->prepare($sql);
          $stmt->execute($data);
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          if($spec['size']=='A4') {
            $price=$rec['A4'];
          } else if($spec['size']=='B5') {
            $price=$rec['B5'];
          } else {
            $price=$rec['A5_B6'];
          }
          $ofs_syoukei+=$price*$spec['copies'];
          $ofs_tcheck+=array("ofs_maki"=>$price*$spec['copies']); //確認用
          break;
        case '中とじ':
          if($prepress_type=='ＣＴＰ'){  //CTP本文印字
            if($spec['size']=='A4' || $spec['size']=='B5'){
              $postpress_pagegake='８頁がけ';
            } else {
              $postpress_pagegake='１６頁がけ';
            }
          } else {                      //BM & PCTP本文印字
            if($spec['size']=='A4' || $spec['size']=='B5'){
              $press_paper_size='Ａ３／Ｂ４';
              $postpress_pagegake='４頁がけ';
            } else {
              $postpress_pagegake='８頁がけ';
            }
          }
          $data=array();
          if($spec['copies']<300){
            $sql="SELECT postpress_price299 FROM t_postpress_choai WHERE postpress_size=? AND postpress_pagegake=?";
          } else {
            $sql="SELECT postpress_price300 FROM t_postpress_choai WHERE postpress_size=? AND postpress_pagegake=?";
          }
          $stmt=$dbh->prepare($sql);
          $data[]=$press_paper_size;
          $data[]=$postpress_pagegake;
          $stmt->execute($data);
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          if($spec['copies']<300){
            $price=$rec['postpress_price299'];
          } else {
            $price=$rec['postpress_price300'];
          }
          $ofs_syoukei=$price*$text_daisu*$spec['copies'];
          $ofs_tcheck+=array("ofs_choai"=>$ofs_syoukei); //確認用

          $data=array();
          $point='２箇所';
          $sql="SELECT postpress_price FROM t_postpress_tozi WHERE postpress_point=?";
          $stmt=$dbh->prepare($sql);
          $data[]=$point;
          $stmt->execute($data);
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          $price=$rec['postpress_price'];
          $ofs_syoukei+=$price*$spec['copies'];
          $ofs_tcheck+=array("ofs_tozi"=>$price*$spec['copies']); //確認用
          break;
        default:  //端物
          $data=array();
          if($spec['size']>'2000') {
            $tachi_copies='2000';
            $sql="SELECT postpress_price FROM t_postpress_tachi WHERE copies>{$tachi_copies} ORDER BY copies ASC LIMIT 1";
            $stmt=$dbh->prepare($sql);
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['postpress_price'];
            $ofs_syoukei=$price*($spec['copies']-$tachi_copies);

            $sql="SELECT postpress_price FROM t_postpress_tachi WHERE copies<={$tachi_copies} ORDER BY copies ASC LIMIT 1";
            $stmt=$dbh->prepare($sql);
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['postpress_price'];
            $ofs_syoukei+=$price;
            $ofs_tcheck+=array("ofs_tachi"=>$ofs_syoukei); //確認用
          } else {
            $sql="SELECT postpress_price FROM t_postpress_tachi WHERE copies<={$spec['size']} ORDER BY copies ASC LIMIT 1";
            $stmt=$dbh->prepare($sql);
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $price=$rec['postpress_price'];
            $ofs_syoukei=$price;
            $ofs_tcheck+=array("ofs_tachi"=>$ofs_syoukei); //確認用
          }
          break;
      }
      $ofs_goukei+=$ofs_syoukei;
      $ofs_tcheck+=array("ofs_tpostpress"=>$ofs_syoukei); //確認用

      // mySQLから切断
      $dbh=null;

    } catch(Exception $e) {

      print '<p>ただいま障がいにより大変ご迷惑をお掛けしております。</p>';
      exit();
    }

    $ofs_goukei=number_format($ofs_goukei).'円';
    $pod_goukei=number_format($pod_goukei).'円';
    return array($ofs_goukei, $pod_goukei, $ofs_tcheck, $pod_tcheck); //確認用
  }









  //テスト単価計算（値を直接埋め込み）
  function tanka_press_select($size,$cut_off,$copies){
    if($size=='A5' && $cut_off=='有り' || $size=='B5' && $cut_off=='なし'){
      $press_paper='B4';
    } else {
      $press_paper='A3';
    }

    if($press_paper=='B4'){
      switch (true) {
        case ($copies<=100):
          $tanka_press=350;
          break;
        case ($copies>100 && $copies<=200):
          $tanka_press=450;
          break;
        case ($copies>200 && $copies<=300);
          $tanka_press=550;
          break;
        case ($copies>300 && $copies<=400);
          $tanka_press=650;
          break;
        case ($copies>400 && $copies<=500);
          $tanka_press=750;
          break;
        case ($copies>500 && $copies<=600);
          $tanka_press=840;
          break;
        case ($copies>600 && $copies<=700);
          $tanka_press=930;
          break;
        case ($copies>700 && $copies<=800);
          $tanka_press=1020;
          break;
        case ($copies>800 && $copies<=900);
          $tanka_press=1110;
          break;
        case ($copies>900 && $copies<=1000);
          $tanka_press=1200;
          break;
        case ($copies>1000 && $copies<=2000);
          $tanka_press=1200;
          $tanka_press=$tanka_press+(($copies-1000)*0.7);
          break;
        default:
//        case ($copies>2000);
          $tanka_press=1200;
          $tanka_press=$tanka_press+(($copies-1000)*0.6);
          break;
      }
    } else {
      switch (true) {
        case ($copies<=100);
          $tanka_press=400;
          break;
        case ($copies>100 && $copies<=200);
          $tanka_press=500;
          break;
        case ($copies>200 && $copies<=300);
          $tanka_press=600;
          break;
        case ($copies>300 && $copies<=400);
          $tanka_press=7000;
          break;
        case ($copies>400 && $copies<=500);
          $tanka_press=800;
          break;
        case ($copies>500 && $copies<=600);
          $tanka_press=900;
          break;
        case ($copies>600 && $copies<=700);
          $tanka_press=1000;
          break;
        case ($copies>700 && $copies<=800);
          $tanka_press=1080;
          break;
        case ($copies>800 && $copies<=900);
          $tanka_press=1150;
          break;
        case ($copies>900 && $copies<=1000);
          $tanka_press=1230;
          break;
        case ($copies>1000 && $copies<=2000);
          $tanka_press=1200;
          $tanka_press=$tanka_press+(($copies-1000)*0.8);
          break;
        default:
//        case ($copies>2000);
          $tanka_press=1200;
          $tanka_press=$tanka_press+(($copies-1000)*0.7);
          break;
      }
    }
    return $tanka_press;
  }

?>
