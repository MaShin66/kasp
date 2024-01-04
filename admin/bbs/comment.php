<? if($bbs_info[comment] == "Y"){ ?>
<?php

// 검색 파라미터
$c_param = "code=$code";
if($page != "") $c_param .= "&page=$page";
if($category != "") $c_param .= "&category=$category";
if($searchkey != "") $c_param .= "&searchopt=$searchopt&searchkey=$searchkey";

?>
<? get_spam_check(); // 자동등록글체크 ?>
<script language="javascript">
<!--

function delComment(idx){
	var url = "save.php?mode=delco&code=<?=$code?>&bbs_idx=<?=$idx?>&idx=" + idx;
	window.open(url, "delComment", "height=175, width=300, menubar=no, scrollbars=no, resizable=no, toolbar=no, status=no, left=250, top=250");
}

function memberCheck(){
<?
	if($cpermi < $mem_level){
		echo "alert('작성권한이 없습니다.');";
		if(empty($hide_passwd_start)) {
			echo "document.comment.name.value=''; comment.name.blur(); if(comment.passwd != undefined) comment.passwd.blur();";
		}
		echo "comment.content.blur(); return false;";
	}else {

		if(!check_point($wiz_session[id], $bbs_info[comment_point])) {
			echo "alert('$bbs_info[point_msg]'); document.comment.name.value=''; comment.name.blur(); if(comment.passwd != undefined) comment.passwd.blur(); comment.content.blur(); return false;";
		}

		echo "return true;";
	}
?>
}

function commentCheck(frm){

	if(memberCheck()){
	   if(frm.name != null && frm.name.value == ""){
	      alert("이름을 입력하세요");
	      frm.name.focus();
	      return false;
	   }
	   if(frm.passwd != null && frm.passwd.value == ""){
	      alert("비밀번호를 입력하세요");
	      frm.passwd.focus();
	      return false;
	   }
		if(frm.content.value == ""){
	      alert("내용을 입력하세요");
	      frm.content.focus();
	      return false;
	   }

	  if (frm.vcode != undefined && (hex_md5(frm.vcode.value) != md5_norobot_key)) {
	  	alert("자동등록방지코드를 정확히 입력해주세요.");
	    frm.vcode.focus();
	    return false;
		}

	}else{
		return false;
	}
}
-->
</script>
<?

	$writer = $wiz_session[name];

	$sql = "select nick from wiz_member where id = '$wiz_session[id]'";
	$result = mysql_query($sql) or error(mysql_error());
	$mem_info = mysql_fetch_array($result);

	$nick = $mem_info[nick];

	if(!strcmp($bbs_info[name_type], "NICK") && !empty($nick)) $writer = $nick;

	$sql = "SELECT * FROM wiz_comment WHERE cidx='$idx' order by idx asc";
	$result = mysql_query($sql) or error(mysql_error());
	$total = mysql_num_rows($result);

	if($rows == "") $rows = "12";
	if($lists == "") $lists = "5";

	$page_count = ceil($total/$rows);
	if(!$cpage || $cpage > $page_count) $cpage = 1;
	$start = ($cpage-1)*$rows;
	$no = $total-$start;

	$sql = "SELECT * FROM wiz_comment WHERE cidx='$idx' order by idx asc limit $start, $rows";
	$result = mysql_query($sql) or error(mysql_error());

	while($com_row = mysql_fetch_array($result)){

		$name = $com_row[name];
		$nick = $com_row[nick];
		$memid = $com_row[memid];

		if(img_type(WIZHOME_PATH."/data/member/".$memid."_icon.gif")) $icon = "<img src='/admin/data/member/".$memid."_icon.gif' align='absmiddle' width='20' height='20'>";
		else if(img_type(WIZHOME_PATH."/data/member/".$memid."_icon.jpg")) $icon = "<img src='/admin/data/member/".$memid."_icon.jpg' align='absmiddle' width='20' height='20'>";
		else $icon = "";

		if(!strcmp($bbs_info[name_type], "name")) $name = $name;
		else if(!strcmp($bbs_info[name_type], "nick") && !empty($nick)) $name = $nick;
		else if(!strcmp($bbs_info[name_type], "icon") && !empty($icon)) $name = $icon;
		else if(!strcmp($bbs_info[name_type], "iname")) $name = $icon." ".$name;
		else if(!strcmp($bbs_info[name_type], "inick")) {
			if(!empty($nick)) $name = $icon." ".$nick;
			else $name = $icon." ".$name;
		}

		$ip = $com_row[ip];
		$wdate = $com_row[wdate];
		$content = str_replace("\n", "<br>", $com_row[content]);

		// 버튼설정
		$codel_btn = "<a href='$PHP_SELF?ptype=passwd&mode=delco&cidx=$idx&idx=$com_row[idx]&$c_param'><image src='$skin_dir/image/ic_del.gif' border='0'></a>";

		include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/com_body.php";

	}

	include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/com_foot.php";

}
?>
