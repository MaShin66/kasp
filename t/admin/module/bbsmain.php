<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/inc/bbsmain_info.php";

// 게시판정보
$sql = "select newc,hotc,skin,datetype_list from wiz_bbsinfo where code = '$code'";
$result = mysql_query($sql) or error(mysql_error());
$total = mysql_num_rows($result);
$bbs_info = mysql_fetch_array($result);

// 생성되지 않은 게시판인경우
if($total <= 0){
	$msg = "<font color=red><b>".$code."</b></font> 게시판은 아직 생성되지 않았습니다.";
	echo "<table align=center><tr><td height=25>  ".$msg."  </td></tr></table>";
}

// 헤더,바디,풋터 자르기
$skin = str_replace("[/LOOP]","[LOOP]",$skin);
list($header,$body,$footer) = explode("[LOOP]",$skin);

echo $header;

$idx = 0;
$ttime = mktime(0,0,0,date('m'),date('d'),date('Y'));

if(empty($bbs_info[datetype_list])) $bbs_info[datetype_list] = "%Y.%m.%d";

$category_sql = "";
if($category != "") $category_sql = " and wb.category = '$category' ";

$sql = "select wb.idx,wb.subject,wb.content,wb.upfile1,wb.wdate as wtime,from_unixtime(wb.wdate, '".$bbs_info[datetype_list]."') as wdate,wb.privacy,wb.content,wb.depno,wc.catname, wc.caticon, wb.memid, wb.memgrp
				from wiz_bbs as wb left join wiz_bbscat as wc on wb.category = wc.idx
				where wb.code = '$code' $category_sql order by wb.prino desc limit $cnt";
echo $sql;
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){

	if($line!=0 && ($idx%$line)==0) echo "<tr>";

	$row[content] = strip_tags($row[content]);

	$main_subject = cut_str($row[subject],$subject_len);
	$main_content = cut_str($row[content],$content_len);
	$main_name = $row[name];
	//$main_wdate = str_replace("-",".",$row[wdate]);
	$main_wdate = $row[wdate];
	$main_count = $row[count];

	$main_category=""; $main_lock_icon=""; $main_re_icon=""; $main_new_icon=""; $main_hot_icon=""; $main_re_space=""; $main_photo="";

	if($row[caticon] != "") $main_category = "<img src='/admin/data/category/".$code."/".$row[caticon]."' align='absmiddle'>";		// category
	else if($row[catname] != "") $main_category = "[".$row[catname]."]";

	$main_link= "$purl?ptype=view&idx=$row[idx]";

	if($row[privacy] == "Y"){																																					// privacy
		if(
			($wiz_session[level] == "0") ||																																		// 전체관리자
			($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)  ||	// 게시판관리자
			($row[memid] != "" && $row[memid] == $wiz_session[id])																 ||	// 자신의글
			($wiz_session[id] != "" && strpos($row[memgrp],$wiz_session[id]) !== false)								// 그룹의글
		){
		}else{
			$main_link = "$purl?ptype=passwd&mode=view&idx=$row[idx]";
		}
		$main_lock_icon = "<img src='$skin_dir/image/lock.gif' border='0' align='absmiddle'>";
	}

	//$main_link = "style=\"cursor:hand\" onClick=\"document.location='$purl?ptype=view&idx=$row[idx]'\"";
	//$main_link = "$purl?ptype=view&idx=$row[idx]";
	//$wtime = mktime(0,0,0,substr($row[wtime],5,2),substr($row[wtime],8,2),substr($row[wtime],0,4));
	$wtime = $row[wtime];

	if(($ttime-$wtime)/86400 <= $bbs_info[newc]) $main_new_icon = "<img src='/admin/bbsmain/image/new.gif' border='0' align='absmiddle'>";	// new
	if($row[count] > $bbs_info[hotc]) $main_hot_icon = "<img src='/admin/bbsmain/image/hot.gif' border='0' align='absmiddle'>";				// hot
	if($row[depno] != 0) $main_re_icon = "<img src='/admin/bbsmain/image/re.gif' border='0' align='absmiddle'>";												// re
	//for($ii=0; $ii < $row[depno]; $ii++) $main_re_space .= " ";																											// respace
	$main_subject = $main_re_space.$main_re_icon.$main_subject;

	if(file_exists(WIZHOME_PATH."/data/bbs/".$code."/S".$row[upfile1])) $main_photo = "/admin/data/bbs/$code/S".$row[upfile1];		// img
	else $main_photo = "/admin/bbs/skin/".$bbs_info[skin]."/image/noimg.gif";

	$bbsmain = $body;
	$bbsmain = str_replace("{SUBJECT}",$main_subject,$bbsmain);
	$bbsmain = str_replace("{DATE}",$main_wdate,$bbsmain);
	$bbsmain = str_replace("{CATEGORY}",$main_category,$bbsmain);
	$bbsmain = str_replace("{CONTENT}",$main_content,$bbsmain);
	$bbsmain = str_replace("{PHOTO}",$main_photo,$bbsmain);
	$bbsmain = str_replace("{NEW}",$main_new_icon,$bbsmain);
	$bbsmain = str_replace("{LINK}",$main_link,$bbsmain);

	echo $bbsmain;

	$idx++;
}

echo $footer;

$bidx = "";
?>
