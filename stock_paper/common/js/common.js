//onload複数命令対策＆IE対策
function addEvent(elm, listener, fn){
  try{
    elm.addEventListener(listener, fn, false);
  } catch(e) {
    elm.attachEvent("on"+listener, fn);
  }
}

//仕上がりサイズ：ラジオボタン一部テキスト入力欄有効化／無効化
function changeDisabled() {
  if ( document.spec_form['size'][4].checked ) { // 「規格外サイズ」のラジオボタンをクリックしたとき
    document . spec_form['size_height'] . disabled = false; // 「規格外サイズ」のラジオボタンの横のテキスト入力欄を有効化
    document . spec_form['size_width'] . disabled = false; // 「規格外サイズ」のラジオボタンの横のテキスト入力欄を有効化
  } else { // 「規格外サイズ」のラジオボタン以外をクリックしたとき
    document . spec_form['size_width'] . disabled = true; // 「規格外サイズ」のラジオボタンの横のテキスト入力欄を有効化
    document . spec_form['size_height'] . disabled = true; // 「規格外サイズ」のラジオボタンの横のテキスト入力欄を無効化
  }
}
addEvent(window, "load", changeDisabled); //window.onload = changeDisabled; // ページを表示したとき、changeDisabled() を呼び出す

//表紙用紙：フォーム項目によって表示／非表示、色紙選択時に他色紙の色選択解除（同じ色名が存在し誤って送信しないように）
function selectChange1(){
  radio=document.getElementsByName('hyoushi_paper');
  if(radio[0].checked) {
    document . getElementById('hpaper_weight_0') . style . display="inline";
    document . getElementById('hpaper_weight_1') . style . display="inline";
    document . getElementById('hpaper_weight_2') . style . display="inline";
    document . getElementById('hpaper_weight_3') . style . display="inline";
    document . getElementById('hpaper_weight_4') . style . display="none";
    document . getElementById('hpaper_weight_5') . style . display="none";
    document . getElementById('hpaper_weight_6') . style . display="none";
    document . getElementById('hpaper_weight_7') . style . display="none";
    document . getElementById('hpaper_weight_8') . style . display="none";
    document . getElementById('hpaper_weight_9') . style . display="none";
    document . getElementById('hpaper_weight_10') . style . display="none";
    document . getElementById('hpaper_weight_11') . style . display="none";
    document . getElementById('hpaper_weight_12') . style . display="none";
    document . getElementById('hpaper_weight_13') . style . display="none";
    document . getElementById('hpaper_0_list') . style . display="block";
    document . getElementById('hpaper_1_list') . style . display="none";
    document . getElementById('hpaper_2_list') . style . display="none";
    document . getElementById('hpaper_3_list') . style . display="none";
    document . getElementById('hpaper_4_list') . style . display="none";
    document . getElementById('hpaper_5_list') . style . display="none";
    document . getElementById('hpaper_6_list') . style . display="none";
    for (i = 1; i <= 11; i++) {
        document.getElementById('irojo_' + i).checked = false;
    }
    for (i = 1; i <= 13; i++) {
        document.getElementById('r66_' + i).checked = false;
    }
    for (i = 1; i <= 10; i++) {
        document.getElementById('t80_' + i).checked = false;
    }
  } else if(radio[1].checked) {
    document . getElementById('hpaper_weight_0') . style . display="none";
    document . getElementById('hpaper_weight_1') . style . display="inline";
    document . getElementById('hpaper_weight_2') . style . display="inline";
    document . getElementById('hpaper_weight_3') . style . display="inline";
    document . getElementById('hpaper_weight_4') . style . display="none";
    document . getElementById('hpaper_weight_5') . style . display="none";
    document . getElementById('hpaper_weight_6') . style . display="none";
    document . getElementById('hpaper_weight_7') . style . display="none";
    document . getElementById('hpaper_weight_8') . style . display="none";
    document . getElementById('hpaper_weight_9') . style . display="none";
    document . getElementById('hpaper_weight_10') . style . display="none";
    document . getElementById('hpaper_weight_11') . style . display="none";
    document . getElementById('hpaper_weight_12') . style . display="none";
    document . getElementById('hpaper_weight_13') . style . display="none";
    document . getElementById('hpaper_0_list') . style . display="none";
    document . getElementById('hpaper_1_list') . style . display="block";
    document . getElementById('hpaper_2_list') . style . display="none";
    document . getElementById('hpaper_3_list') . style . display="none";
    document . getElementById('hpaper_4_list') . style . display="none";
    document . getElementById('hpaper_5_list') . style . display="none";
    document . getElementById('hpaper_6_list') . style . display="none";
    for (i = 1; i <= 11; i++) {
        document.getElementById('irojo_' + i).checked = false;
    }
    for (i = 1; i <= 13; i++) {
        document.getElementById('r66_' + i).checked = false;
    }
    for (i = 1; i <= 10; i++) {
        document.getElementById('t80_' + i).checked = false;
    }
  } else if(radio[2].checked) {
    document . getElementById('hpaper_weight_0') . style . display="none";
    document . getElementById('hpaper_weight_1') . style . display="inline";
    document . getElementById('hpaper_weight_2') . style . display="inline";
    document . getElementById('hpaper_weight_3') . style . display="inline";
    document . getElementById('hpaper_weight_4') . style . display="none";
    document . getElementById('hpaper_weight_5') . style . display="none";
    document . getElementById('hpaper_weight_6') . style . display="none";
    document . getElementById('hpaper_weight_7') . style . display="none";
    document . getElementById('hpaper_weight_8') . style . display="none";
    document . getElementById('hpaper_weight_9') . style . display="none";
    document . getElementById('hpaper_weight_10') . style . display="none";
    document . getElementById('hpaper_weight_11') . style . display="none";
    document . getElementById('hpaper_weight_12') . style . display="none";
    document . getElementById('hpaper_weight_13') . style . display="none";
    document . getElementById('hpaper_0_list') . style . display="none";
    document . getElementById('hpaper_1_list') . style . display="none";
    document . getElementById('hpaper_2_list') . style . display="block";
    document . getElementById('hpaper_3_list') . style . display="none";
    document . getElementById('hpaper_4_list') . style . display="none";
    document . getElementById('hpaper_5_list') . style . display="none";
    document . getElementById('hpaper_6_list') . style . display="none";
    for (i = 1; i <= 11; i++) {
        document.getElementById('irojo_' + i).checked = false;
    }
    for (i = 1; i <= 13; i++) {
        document.getElementById('r66_' + i).checked = false;
    }
    for (i = 1; i <= 10; i++) {
        document.getElementById('t80_' + i).checked = false;
    }
  } else if(radio[3].checked) {
    document . getElementById('hpaper_weight_0') . style . display="none";
    document . getElementById('hpaper_weight_1') . style . display="none";
    document . getElementById('hpaper_weight_2') . style . display="none";
    document . getElementById('hpaper_weight_3') . style . display="none";
    document . getElementById('hpaper_weight_4') . style . display="inline";
    document . getElementById('hpaper_weight_5') . style . display="inline";
    document . getElementById('hpaper_weight_6') . style . display="inline";
    document . getElementById('hpaper_weight_7') . style . display="none";
    document . getElementById('hpaper_weight_8') . style . display="none";
    document . getElementById('hpaper_weight_9') . style . display="none";
    document . getElementById('hpaper_weight_10') . style . display="none";
    document . getElementById('hpaper_weight_11') . style . display="none";
    document . getElementById('hpaper_weight_12') . style . display="none";
    document . getElementById('hpaper_weight_13') . style . display="none";
    document . getElementById('hpaper_0_list') . style . display="none";
    document . getElementById('hpaper_1_list') . style . display="none";
    document . getElementById('hpaper_2_list') . style . display="none";
    document . getElementById('hpaper_3_list') . style . display="block";
    document . getElementById('hpaper_4_list') . style . display="none";
    document . getElementById('hpaper_5_list') . style . display="none";
    document . getElementById('hpaper_6_list') . style . display="none";
    for (i = 1; i <= 13; i++) {
        document.getElementById('r66_' + i).checked = false;
    }
    for (i = 1; i <= 10; i++) {
        document.getElementById('t80_' + i).checked = false;
    }
  } else if(radio[4].checked) {
    document . getElementById('hpaper_weight_0') . style . display="none";
    document . getElementById('hpaper_weight_1') . style . display="none";
    document . getElementById('hpaper_weight_2') . style . display="none";
    document . getElementById('hpaper_weight_3') . style . display="none";
    document . getElementById('hpaper_weight_4') . style . display="none";
    document . getElementById('hpaper_weight_5') . style . display="none";
    document . getElementById('hpaper_weight_6') . style . display="none";
    document . getElementById('hpaper_weight_7') . style . display="inline";
    document . getElementById('hpaper_weight_8') . style . display="inline";
    document . getElementById('hpaper_weight_9') . style . display="inline";
    document . getElementById('hpaper_weight_10') . style . display="none";
    document . getElementById('hpaper_weight_11') . style . display="none";
    document . getElementById('hpaper_weight_12') . style . display="none";
    document . getElementById('hpaper_weight_13') . style . display="none";
    document . getElementById('hpaper_0_list') . style . display="none";
    document . getElementById('hpaper_1_list') . style . display="none";
    document . getElementById('hpaper_2_list') . style . display="none";
    document . getElementById('hpaper_3_list') . style . display="none";
    document . getElementById('hpaper_4_list') . style . display="block";
    document . getElementById('hpaper_5_list') . style . display="none";
    document . getElementById('hpaper_6_list') . style . display="none";
    for (i = 1; i <= 11; i++) {
        document.getElementById('irojo_' + i).checked = false;
    }
    for (i = 1; i <= 10; i++) {
        document.getElementById('t80_' + i).checked = false;
    }
  } else if(radio[5].checked) {
    document . getElementById('hpaper_weight_0') . style . display="none";
    document . getElementById('hpaper_weight_1') . style . display="none";
    document . getElementById('hpaper_weight_2') . style . display="none";
    document . getElementById('hpaper_weight_3') . style . display="none";
    document . getElementById('hpaper_weight_4') . style . display="none";
    document . getElementById('hpaper_weight_5') . style . display="none";
    document . getElementById('hpaper_weight_6') . style . display="none";
    document . getElementById('hpaper_weight_7') . style . display="none";
    document . getElementById('hpaper_weight_8') . style . display="none";
    document . getElementById('hpaper_weight_9') . style . display="none";
    document . getElementById('hpaper_weight_10') . style . display="inline";
    document . getElementById('hpaper_weight_11') . style . display="inline";
    document . getElementById('hpaper_weight_12') . style . display="inline";
    document . getElementById('hpaper_weight_13') . style . display="none";
    document . getElementById('hpaper_0_list') . style . display="none";
    document . getElementById('hpaper_1_list') . style . display="none";
    document . getElementById('hpaper_2_list') . style . display="none";
    document . getElementById('hpaper_3_list') . style . display="none";
    document . getElementById('hpaper_4_list') . style . display="none";
    document . getElementById('hpaper_5_list') . style . display="block";
    document . getElementById('hpaper_6_list') . style . display="none";
    for (i = 1; i <= 11; i++) {
        document.getElementById('irojo_' + i).checked = false;
    }
    for (i = 1; i <= 13; i++) {
        document.getElementById('r66_' + i).checked = false;
    }
  } else if(radio[6].checked) {
    document . getElementById('hpaper_weight_0') . style . display="none";
    document . getElementById('hpaper_weight_1') . style . display="none";
    document . getElementById('hpaper_weight_2') . style . display="none";
    document . getElementById('hpaper_weight_3') . style . display="none";
    document . getElementById('hpaper_weight_4') . style . display="none";
    document . getElementById('hpaper_weight_5') . style . display="none";
    document . getElementById('hpaper_weight_6') . style . display="none";
    document . getElementById('hpaper_weight_7') . style . display="none";
    document . getElementById('hpaper_weight_8') . style . display="none";
    document . getElementById('hpaper_weight_9') . style . display="none";
    document . getElementById('hpaper_weight_10') . style . display="none";
    document . getElementById('hpaper_weight_11') . style . display="none";
    document . getElementById('hpaper_weight_12') . style . display="none";
    document . getElementById('hpaper_weight_13') . style . display="inline";
    document . getElementById('hpaper_0_list') . style . display="none";
    document . getElementById('hpaper_1_list') . style . display="none";
    document . getElementById('hpaper_2_list') . style . display="none";
    document . getElementById('hpaper_3_list') . style . display="none";
    document . getElementById('hpaper_4_list') . style . display="none";
    document . getElementById('hpaper_5_list') . style . display="none";
    document . getElementById('hpaper_6_list') . style . display="block";
    for (i = 1; i <= 11; i++) {
        document.getElementById('irojo_' + i).checked = false;
    }
    for (i = 1; i <= 13; i++) {
        document.getElementById('r66_' + i).checked = false;
    }
    for (i = 1; i <= 10; i++) {
        document.getElementById('t80_' + i).checked = false;
    }
  }
}
addEvent(window, "load", selectChange1);  //オンロードさせ、リロード時に選択を保持

//本文用紙：フォーム項目によって用紙の厚み、用紙色を表示／非表示
function selectChange2(){
  radio=document.getElementsByName('text_paper');
  if(radio[0].checked) {
    document . getElementById('tpaper_weight_0') . style . display="inline";
    document . getElementById('tpaper_weight_1') . style . display="none";
    document . getElementById('tpaper_weight_2') . style . display="inline";
    document . getElementById('tpaper_weight_3') . style . display="none";
    document . getElementById('tpaper_weight_4') . style . display="none";
    document . getElementById('tpaper_weight_5') . style . display="inline";
    document . getElementById('tpaper_weight_6') . style . display="none";
    document . getElementById('tpaper_weight_7') . style . display="none";
    document . getElementById('tpaper_weight_8') . style . display="none";
    document . getElementById('tpaper_weight_9') . style . display="none";
    document . getElementById('tpaper_3_list') . style . display="none";
    document . getElementById('tpaper_a2') . checked = true;
    for (i = 1; i <= 11; i++) {
        document.getElementById('tirojo_' + i).checked = false;
    }
  } else if(radio[1].checked) {
    document . getElementById('tpaper_weight_0') . style . display="none";
    document . getElementById('tpaper_weight_1') . style . display="none";
    document . getElementById('tpaper_weight_2') . style . display="none";
    document . getElementById('tpaper_weight_3') . style . display="none";
    document . getElementById('tpaper_weight_4') . style . display="inline";
    document . getElementById('tpaper_weight_5') . style . display="inline";
    document . getElementById('tpaper_weight_6') . style . display="inline";
    document . getElementById('tpaper_weight_7') . style . display="none";
    document . getElementById('tpaper_weight_8') . style . display="none";
    document . getElementById('tpaper_weight_9') . style . display="none";
    document . getElementById('tpaper_3_list') . style . display="none";
    document . getElementById('tpaper_a5') . checked = true;
    for (i = 1; i <= 11; i++) {
        document.getElementById('tirojo_' + i).checked = false;
    }
  } else if(radio[2].checked) {
    document . getElementById('tpaper_weight_0') . style . display="none";
    document . getElementById('tpaper_weight_1') . style . display="none";
    document . getElementById('tpaper_weight_2') . style . display="inline";
    document . getElementById('tpaper_weight_3') . style . display="none";
    document . getElementById('tpaper_weight_4') . style . display="none";
    document . getElementById('tpaper_weight_5') . style . display="inline";
    document . getElementById('tpaper_weight_6') . style . display="inline";
    document . getElementById('tpaper_weight_7') . style . display="none";
    document . getElementById('tpaper_weight_8') . style . display="none";
    document . getElementById('tpaper_weight_9') . style . display="none";
    document . getElementById('tpaper_3_list') . style . display="none";
    document . getElementById('tpaper_a2') . checked = true;
    for (i = 1; i <= 11; i++) {
        document.getElementById('tirojo_' + i).checked = false;
    }
  } else if(radio[3].checked) {
    document . getElementById('tpaper_weight_0') . style . display="none";
    document . getElementById('tpaper_weight_1') . style . display="none";
    document . getElementById('tpaper_weight_2') . style . display="none";
    document . getElementById('tpaper_weight_3') . style . display="none";
    document . getElementById('tpaper_weight_4') . style . display="none";
    document . getElementById('tpaper_weight_5') . style . display="none";
    document . getElementById('tpaper_weight_6') . style . display="none";
    document . getElementById('tpaper_weight_7') . style . display="inline";
    document . getElementById('tpaper_weight_8') . style . display="inline";
    document . getElementById('tpaper_weight_9') . style . display="none";
    document . getElementById('tpaper_3_list') . style . display="block";
    document . getElementById('tpaper_a7') . checked = true;
  } else if(radio[4].checked) {
    document . getElementById('tpaper_weight_0') . style . display="none";
    document . getElementById('tpaper_weight_1') . style . display="none";
    document . getElementById('tpaper_weight_2') . style . display="none";
    document . getElementById('tpaper_weight_3') . style . display="inline";
    document . getElementById('tpaper_weight_4') . style . display="none";
    document . getElementById('tpaper_weight_5') . style . display="none";
    document . getElementById('tpaper_weight_6') . style . display="none";
    document . getElementById('tpaper_weight_7') . style . display="none";
    document . getElementById('tpaper_weight_8') . style . display="none";
    document . getElementById('tpaper_weight_9') . style . display="none";
    document . getElementById('tpaper_3_list') . style . display="none";
    document . getElementById('tpaper_a3') . checked = true;
    for (i = 1; i <= 11; i++) {
        document.getElementById('tirojo_' + i).checked = false;
    }
  }
}
addEvent(window, "load", selectChange2);  //オンロードさせ、リロード時に選択を保持

//本文印刷色：フォーム項目によってページ数入力部分を表示／非表示
function selectChange3(){
  radio=document.getElementsByName('text_color');
  if(radio[0].checked) {
    document . getElementById('text_color_0') . style . display="inline";
    document . getElementById('text_color_1') . style . display="none";
    document . getElementById('text_color_2') . style . display="none";
    document . getElementById('text_color_4c') . value="";
  } else if(radio[1].checked) {
    document . getElementById('text_color_0') . style . display="none";
    document . getElementById('text_color_1') . style . display="inline";
    document . getElementById('text_color_2') . style . display="none";
    document . getElementById('text_color_k') . value="";
  } else if(radio[2].checked) {
    document . getElementById('text_color_0') . style . display="inline";
    document . getElementById('text_color_1') . style . display="inline";
    document . getElementById('text_color_2') . style . display="block";
  }
}
addEvent(window, "load", selectChange3);  //オンロードさせ、リロード時に選択を保持

//会員登録：フォーム項目によって入力部分を追加表示／非表示
function selectChange_mf(){
  radio=document.getElementsByName('chumon');
  if(radio[0].checked) {
    document . getElementById('member_form') . style . display="none";
  } else if(radio[1].checked) {
    document . getElementById('member_form') . style . display="block";
  }
}
addEvent(window, "load", selectChange_mf);  //オンロードさせ、リロード時に選択を保持
