<?php

function show_members($member1, $member2, $leader = '田中'){
	echo '今回のメンバーは'.$member1.'さんと'.$member2.'さんです。<br>';
	echo $leader.'さんが現場を管理します。';
}

show_members('高橋', '小林');