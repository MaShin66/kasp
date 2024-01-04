<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin2/inc/bbs_info.php";

echo "<link href=\"".$skin_dir."/style.css\" rel=\"stylesheet\" type=\"text/css\">";

// �˻� �Ķ����
$param = "code=$code";
if($idx != "") $param .= "&idx=$idx";
if($page != "") $param .= "&page=$page";
if($category != "") $param .= "&category=$category";
if($searchkey != "") $param .= "&searchopt=$searchopt&searchkey=$searchkey";

if(empty($bbs_info[datetype_view])) $bbs_info[datetype_view] = "%Y-%m-%d";

// �Խù� ��ȣ ($no)
$no = get_bbs_no($_GET);

// �Խù� ����
$sql = "select wb.*,from_unixtime(wb.wdate, '".$bbs_info[datetype_view]."') as wdate, wc.catname, wc.caticon
			from wiz_bbs as wb left join wiz_bbscat as wc on wb.category = wc.idx
			where wb.idx = '$idx'";
			
$result = mysql_query($sql) or error(mysql_error());
$total = mysql_num_rows($result);
if($total <= 0) error("�ش� �Խù��� �����ϴ�.");
$bbs_row = mysql_fetch_array($result);

$memid 		= $bbs_row[memid];
$name 		= $bbs_row[name];
$nick			= $bbs_row[nick];
$email 		= $bbs_row[email];
$tphone 	= $bbs_row[tphone];
$hphone 	= $bbs_row[hphone];
$zipcode 	= $bbs_row[zipcode];
$address 	= $bbs_row[address];
$subject 	= $bbs_row[subject];
$content 	= $bbs_row[content];
$status		= $bbs_row[status];
$reply	 	= $bbs_row[reply];
$wdate 		= $bbs_row[wdate];
$count 		= $bbs_row[count];
$recom 		= $bbs_row[recom];
$ip 			= $bbs_row[ip];

$addinfo1 = $bbs_row[addinfo1];
$addinfo2 = $bbs_row[addinfo2];
$addinfo3 = $bbs_row[addinfo3];
$addinfo4 = $bbs_row[addinfo4];
$addinfo5 = $bbs_row[addinfo5];
$addinfo6 = $bbs_row[addinfo6];
$addinfo9 = $bbs_row[addinfo9];

$name = xss_check($name);
$email = xss_check($email);
$tphone = xss_check($tphone);
$hphone = xss_check($hphone);
$zipcode = xss_check($zipcode);
$address = xss_check($address);
$subject = xss_check($subject);
$content = xss_check($content);
$reply = xss_check($reply);

$addinfo1 = xss_check($addinfo1);
$addinfo2 = xss_check($addinfo2);
$addinfo3 = xss_check($addinfo3);
$addinfo4 = xss_check($addinfo4);
$addinfo5 = xss_check($addinfo5);
$addinfo6 = xss_check($addinfo6);
$addinfo9 = xss_check($addinfo9);

if(img_type(WIZHOME_PATH."/data/member/".$memid."_icon.gif")) $icon = "<img src='/admin2/data/member/".$memid."_icon.gif' align='absmiddle'>";
else if(img_type(WIZHOME_PATH."/data/member/".$memid."_icon.jpg")) $icon = "<img src='/admin2/data/member/".$memid."_icon.jpg' align='absmiddle'>";
else $icon = "";

if(!strcmp($bbs_info[name_type], "name")) $name = $name;
else if(!strcmp($bbs_info[name_type], "nick") && !empty($nick)) $name = $nick;
else if(!strcmp($bbs_info[name_type], "icon") && !empty($icon)) $name = $icon;
else if(!strcmp($bbs_info[name_type], "iname")) $name = $icon." ".$name;
else if(!strcmp($bbs_info[name_type], "inick")) {
	if(!empty($nick)) $name = $icon." ".$nick;
	else $name = $icon." ".$name;
}

if($bbs_row[caticon] != "") $catname = "<img src='/admin2/data/category/".$code."/".$bbs_row[caticon]."' align='absmiddle'> ";		// category
else if($bbs_row[catname] != "") $catname = "[".$bbs_row[catname]."] ";

if($bbs_row[ctype] != "H"){
	$content = htmlspecialchars($content);
	$content = str_replace("\n", "<br>", $content);

	$reply = htmlspecialchars($reply);
	$reply = str_replace("\n", "<br>", $reply);
}

$_ResizeCheck = false;
// ÷������ �̹����ΰ�� �����ֱ�
if(strcmp($bbs_info[imgview], "N")) {

	for($ii = 1; $ii <= 12; $ii++) {
		if(img_type(WIZHOME_PATH."/data/bbs/$code/M".$bbs_row[upfile.$ii])) {
//			${upimg.$ii} = "<div align='".$bbs_info[img_align]."'><a href=javascript:viewImg('".$bbs_row[upfile.$ii]."');><img src='/admin2/data/bbs/$code/M".$bbs_row[upfile.$ii]."' border='0' //			name='wiz_target_resize'></a></div>";
			${upimg.$ii} = "<div align='".$bbs_info[img_align]."'><img src='/admin/data/bbs/$code/M".$bbs_row[upfile.$ii]."' border='0' name='wiz_target_resize'></div>";
			$_ResizeCheck = true;
		}
	}
}

// �̹��� ������� ���ؼ� ó���ϴ� �κ�
if(strpos(strtolower($content), "<img") !== false || $_ResizeCheck == true) {
//	$content = preg_replace("/(\<img)(.*)(\>?)/i","\\1 name=wiz_target_resize style=\"cursor:pointer\" onclick=window.open(this.src) \\2 \\3", $content);
	$content = preg_replace("/(\<img)(.*)(\>?)/i","\\1 name=wiz_target_resize \\2 \\3", $content);
	$content = "<table border=0 cellspacing=0 cellpadding=0 style='width:".$bbs_info[mimgsize]."px;height:0px;' id='wiz_get_table_width'>
							<col width=100%></col>
							<tr>
								<td><img src='' border='0' name='wiz_target_resize' width='0' height='0'></td>
							</tr>
						</table>
						<table border=0 cellspacing=0 cellpadding=0 width=100%>
							<col width=100%></col>
							<tr><td valign=top>".$content."</td></tr>
						</table>";
	$_ResizeCheck = true;
}

// �ۺ��� ����üũ
if($rpermi < $mem_level) error($bbs_info[permsg],$bbs_info[perurl]);

// ��б��ΰ�� üũ
if($bbs_row[privacy] == "Y"){

	$sql = "select idx from wiz_bbs where code='$code' and grpno='$bbs_row[grpno]' and passwd='$passwd'";
	$result = mysql_query($sql) or error(mysql_error());
	$grp_passwd = mysql_num_rows($result);

	if(
	$mem_level == 0 ||																																				// ��ü������
	($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)  ||	// �Խ��ǰ�����
	($bbs_row[memid] != "" && $bbs_row[memid] == $wiz_session[id]) || 												// �ڽ��Ǳ�
	($bbs_row[passwd] != "" && $bbs_row[passwd] == $passwd) ||																// ��й�ȣ��ġ
	($wiz_session[id] != "" && strpos($bbs_row[memgrp],$wiz_session[id]) !== false) ||				// �׷��Ǳ�
	($grp_passwd > 0)																																					// �׷���
	){
	}else{
		if($passwd) error("��й�ȣ�� ��ġ���� �ʽ��ϴ�.","?ptype=passwd&mode=view&$param");
		else  error("������ �����ϴ�.","?ptype=passwd&mode=view&$param");
	}

}

save_point("BBS", $wiz_session[id], "view", $idx);

// ��ȸ�� ����
$count_id = "bbs_view_".$code."_".$idx;
if(!$_SESSION[$count_id]) {
	$sql = "update wiz_bbs set count = count+1 where idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$_SESSION[$count_id] = true;
	$count++;
}

// ��ư����
$list_btn = "<a href='$PHP_SELF?ptype=list&$param' class='btn_txt btn_line_black'>목록으로</a>";
if($wpermi >= $mem_level){

	if(!check_point($wiz_session[id], $bbs_info[write_point])) {
		$write_btn = "<img src='$skin_dir/image/btn_write.gif' border='0' onClick=\"alert('$bbs_info[point_msg]');\" style='cursor:pointer'>";
	} else {
		$write_btn = "<a href='$PHP_SELF?ptype=input&mode=insert&$param'><image src='$skin_dir/image/btn_write.gif' border='0'></a>";
	}

	$modify_btn = "<a href='$PHP_SELF?ptype=input&mode=modify&$param'><image src='$skin_dir/image/btn_modify.gif' border='0'></a>";
	$delete_btn = "<a href='$PHP_SELF?ptype=passwd&mode=delete&$param'><image src='$skin_dir/image/btn_delete.gif' border='0'></a>";
} else {

	if(!strcmp($bbs_info[btn_view], "Y")) {
		if(!empty($bbs_info[perurl])) $perurl = " document.location='".$bbs_info[perurl]."'; ";
		$write_btn = "<img src='$skin_dir/image/btn_write.gif' border='0' onClick=\"alert('$bbs_info[permsg]'); $perurl \" style='cursor:pointer'>";
	}

}
if($apermi >= $mem_level){

	if(!check_point($wiz_session[id], $bbs_info[write_point])) {
		$reply_btn = "<img src='$skin_dir/image/btn_reply.gif' border='0' onClick=\"alert('$bbs_info[point_msg]');\" style='cursor:pointer'>";
	} else {
		$reply_btn = "<a href='$PHP_SELF?ptype=input&mode=reply&$param'><image src='$skin_dir/image/btn_reply.gif' border=0></a>";
	}

} else {

	if(!strcmp($bbs_info[btn_view], "Y")) {
		if(!empty($bbs_info[perurl])) $perurl = " document.location='".$bbs_info[perurl]."'; ";
		$reply_btn = "<img src='$skin_dir/image/btn_reply.gif' border='0' onClick=\"alert('$bbs_info[permsg]'); $perurl \" style='cursor:pointer'>";
	}

}

if($bbs_info[recom] == "Y"){

	if(!check_point($wiz_session[id], $bbs_info[recom_point])) {
		$recom_btn = "<img src='$skin_dir/image/btn_recom.gif' border='0' onClick=\"alert('$bbs_info[point_msg]');\" style='cursor:pointer'>";
	} else {
		$recom_btn = "<a href='/admin2/bbs/save.php?mode=recom&prev=$PHP_SELF&$param'><image src='$skin_dir/image/btn_recom.gif' border=0></a>";
	}

}

// ÷������
if(!check_point($wiz_session[id], $bbs_info[down_point])) {
	for($ii = 1; $ii <= 12; $ii++) {
		if($bbs_row[upfile.$ii] != "") ${upfile.$ii}  = "<a href=\"javascript:alert('$bbs_info[point_msg]')\">".$bbs_row[upfile.$ii._name]."</a>";
	}
} else {
	for($ii = 1; $ii <= 12; $ii++) {
		if($bbs_row[upfile.$ii] != "") ${upfile.$ii}  = "<a href='/admin/bbs/down.php?code=$code&idx=$idx&no=".$ii."'>".$bbs_row[upfile.$ii._name]."</a>";
	}
}

if($bbs_row[movie1] != "") $movie1 = "<embed src='/admin2/data/bbs/$code/".$bbs_row[movie1]."' autostart=false></embed><br>";
if($bbs_row[movie2] != "") $movie2 = "<embed src='".$bbs_row[movie2]."' autostart=false></embed><br>";
if($bbs_row[movie3] != "") $movie3 = "<embed src='".$bbs_row[movie3]."' autostart=false></embed><br>";

$prev = "";
$next = "";

// �ڽ��� �� �� �Ǵ� �ڽ��� �ۿ� �޸� �亯��
if($mybbs) $my_sql = " and (memid='$wiz_session[id]' or memgrp like '".$wiz_session[id].",%')";

// ������
$sql = "select idx,subject, privacy, memid from wiz_bbs where code = '$code' and prino > '$bbs_row[prino]' $my_sql order by prino asc limit 1";
$result = mysql_query($sql) or error(mysql_error());
$row[subject] = xss_check($row[subject]);
if($row = mysql_fetch_array($result)) {
	$prev = "<a href='$PHP_SELF?ptype=view&code=$code&idx=$row[idx]'>$row[subject]</a>";

	if($row[privacy] == "Y"){
		$lock_icon = "<img src='$skin_dir/image/lock.gif' border='0' align='absmiddle'>";																																	// privacy
		if(
			($mem_level == "0") ||																																		// ��ü������
			($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)  ||	// �Խ��ǰ�����
			($row[memid] != "" && $row[memid] == $wiz_session[id])																 ||	// �ڽ��Ǳ�
			($wiz_session[id] != "" && strpos($row[memgrp],$wiz_session[id]) !== false)								// �׷��Ǳ�
		){
		}else{
			$prev = "<a href='$PHP_SELF?ptype=passwd&mode=view&code=$code&idx=$row[idx]'>$row[subject]</a> ".$lock_icon;
		}
	}
}

// ������
$sql = "select idx,subject, privacy, memid from wiz_bbs where code = '$code' and prino < '$bbs_row[prino]' $my_sql order by prino desc limit 1";
$result = mysql_query($sql) or error(mysql_error());
$row[subject] = xss_check($row[subject]);
if($row = mysql_fetch_array($result)) {
	$next = "<a href='$PHP_SELF?ptype=view&code=$code&idx=$row[idx]'>$row[subject]</a>";

	if($row[privacy] == "Y"){
		$lock_icon = "<img src='$skin_dir/image/lock.gif' border='0' align='absmiddle'>";																																	// privacy
		if(
			($mem_level == "0") ||																																		// ��ü������
			($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)  ||	// �Խ��ǰ�����
			($row[memid] != "" && $row[memid] == $wiz_session[id])																 ||	// �ڽ��Ǳ�
			($wiz_session[id] != "" && strpos($row[memgrp],$wiz_session[id]) !== false)								// �׷��Ǳ�
		){
		}else{
			$next = "<a href='$PHP_SELF?ptype=passwd&mode=view&code=$code&idx=$row[idx]'>$row[subject]</a> ".$lock_icon;
		}
	}
}

// ��� �ۼ� ��й�ȣ ����
if($wiz_session[id] != ""){
	$hide_passwd_start = "<!--"; $hide_passwd_end = "-->";
}

// ÷������ ��뿩��
if($bbs_info[upfile] < 1){
	$hide_upfile_start = "<!--"; $hide_upfile_end = "-->";
}

// ��õ��� ��뿩��
if($bbs_info[recom] != "Y"){
	$hide_recom_start = "<!--"; $hide_recom_end = "-->";
}

// ���Ա�üũ��� ��뿩��
if($mem_level == "0" || !strcmp($bbs_info[spam_check], "N")){
	$hide_spam_check_start = "<!--"; $hide_spam_check_end = "-->";
}

// �亯������ ���� ��� ����
if(empty($reply) || strcmp($status, "Y")) {
	$hide_reply_start = "<!--"; $hide_reply_end = "-->";
}

// �������� ��쿡�� �����ִ� ������ ����
if(
$mem_level == "0" || 																																			// ��ü������
($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)			// �Խ��ǰ�����
){
} else {
	$hide_admin_start = "<!--"; $hide_admin_end = "-->";
}

//���� �Խ����Ͻ� addinfo �����ڷ� ����� view �����������!
if($code=="googic"){
	list($content1,$content2) = explode("/+googic+/",$content);
	//[0] ������� [1] ���� [2] ���
	list($birth,$gender, $career) = explode("/+googic+/",$addinfo1);
	//[0] �����о� [1] �ٹ����� [2] �������
	list($w_field,$w_type, $h_salary) = explode("/+googic+/",$addinfo2);
	//���бⰣ1 ���бⰣ1_1 �б���1 ������1 ����1 ����1 ����1_1
	$addinfo6 = explode("/+edu+googic+edu+/",$addinfo6);
} else if($code=="gooin"){
	//[0]�����[1]�����⵵[2]�����
	//list($c_name,$c_est,$c_sales) = explode("/+gooin+/",$addinfo1);
	$addinfo1 = explode("/+gooin+/",$addinfo1);
	//[0]�������[1]�����[2]Ȩ������
	$addinfo2 = explode("/+gooin+/",$addinfo2);
	//[0]���[1]�з�[2~3]�����Ⱓ
	$addinfo3 = explode("/+gooin+/",$addinfo3);
	//[0]��������[1]�������[2]�ٹ��о�
	$addinfo4 = explode("/+gooin+/",$addinfo4);
}

// �佺Ų ��Ŭ���
@include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/view_head.php";
@include "$_SERVER[DOCUMENT_ROOT]/admin2/bbs/comment.php";
@include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/view_foot.php";

view_img_resize();

if(!strcmp($bbs_info[view_list], "Y")) {
	$view_idx = $idx;
	echo "<table width='100%' height='10'><tr><td></td></tr></table>";
	include "$_SERVER[DOCUMENT_ROOT]/admin2/bbs/list.php";
}
?>