<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?php
$param = "&id=".$id."&name=".$name."&s_ptype=".$s_ptype."&searchkey=".$searchkey;
?>
<html>
<head>
<title>:: <?=$name?>(<?=$id?>) 님의 포인트내역 ::</title>
<link href="../wiz_style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="/js/valueCheck.js"></script>
<script language="JavaScript" src="/admin2/js/lib.js"></script>
<script language="JavaScript">
<!--
// 포인트내역 보기
function pointView(code, idx, cidx){
	
  var url = "../bbs/pop_view.php?code=" + code + "&idx=" + idx + "#" + cidx;
  window.open(url, "pointView", "height=400, width=700, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, left=0, top=0");
}

function inputCheck(frm){
	
	if(frm.point_gubun.value == ""){
		alert("포인트 +,- 를 선택하세요.");
		frm.point_gubun.focus();
		return false;
	}
	if(frm.point.value == ""){
		alert("포인트를 입력하세요.");
		frm.point.focus();
		return false;
	}else{
		if(!check_Num(frm.point.value)){
			alert("포인트는 숫자이어야 합니다.");
			frm.point.select();
			frm.point.focus();
			return false;
		}
	}
	if(frm.memo.value == ""){
		alert("포인트내용을 입력하세요.");
		frm.memo.focus();
		return false;
	}
}

function inputEmpty(obj,msg){
	if(obj.value == msg){
		obj.value = "";
	}
}

function deletePoint(idx,memid,name){
	if(confirm('해당 포인트내역을 삭제하시겠습니까?')){
		document.location = "member_save.php?mode=delpoint&idx=" + idx + "&memid=" + memid + "&name=" + name;
	}
}
//-->
</script>
</head>
<body>
<table width="100%"cellpadding=6 cellspacing=0>
<tr>
<td>
	
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td class="tit_sub"><img src="../image/ics_tit.gif"> <?=$name?>(<?=$id?>) 님의 포인트내역</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><td colspan=20 class="t_rd"></td></tr>
  <tr class="t_th">
    <th width="20%">적립일자</th>
    <th>포인트내역</th>
    <th width="15%">포인트</th>
    <th width="10%">삭제</th>
  </tr>
  <tr><td colspan=20 class="t_rd"></td></tr>
<?
	$sql = "select sum(point) as total_point from wiz_point where memid = '$id'";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_array($result);
	$total_point = $row[total_point];
	
	list($s_ptype, $s_mode) = explode("_", $s_ptype);
	
	if(!empty($s_ptype)) $ptype_sql = " and wp.ptype = '$s_ptype' ";
	if(!empty($s_mode) && !strcmp($s_ptype, "BBS")) $mode_sql = " and wp.mode = '$s_mode' ";
	else $s_mode = "";
	if(!empty($searchkey) && strcmp($searchkey, "포인트내용")) $search_sql = " and wp.memo like '%$searchkey%' ";
	  
	$sql = "select wp.idx
					from wiz_point as wp left join wiz_bbs as wb on wp.bidx = wb.idx 
					where wp.memid = '$id' $ptype_sql $mode_sql $search_sql 
					order by wp.wdate desc";
	$result = mysql_query($sql) or error(mysql_error());
	$total = mysql_num_rows($result);

	$rows = 15;
	$lists = 5;
	if(!$page) $page = 1;
	$page_count = ceil($total/$rows);
	$start = ($page-1)*$rows;
	$no = $total-$start;
	
	$sql = "select wp.*, wb.code, wb.subject 
					from wiz_point as wp left join wiz_bbs as wb on wp.bidx = wb.idx 
					where wp.memid = '$id' $ptype_sql $mode_sql $search_sql 
					order by wp.wdate desc limit $start, $rows";
	$result = mysql_query($sql) or error(mysql_error());
	 
	while(($row = mysql_fetch_array($result))){
		if(!empty($row[subject])) {
			$subject = "&nbsp;".cut_str($row[subject], 10);
		}
?>
  <tr bgcolor=ffffff align=center>
	<td height="30"><?=$row[wdate]?></td>
	<td><?=$row[memo]?><? if(!empty($row[bidx])) echo "<a href=\"javascript:pointView('$row[code]', '$row[bidx]', '$row[cidx]');\">(".$row[bidx].$subject.")</a>"; ?></td>
	<td><?=number_format($row[point])?></td>
	<td>
	  <? if(!empty($row[bidx])) echo "<a href=\"javascript:pointView('$row[code]', '$row[bidx]', '$row[cidx]');\">보기</a>"; ?>
	  <img src="../image/btn_delete_s.gif" style="cursor:hand" align="absmiddle" onClick="deletePoint('<?=$row[idx]?>','<?=$row[memid]?>','<?=$name?>');">
	</td>
  </tr>
  <tr><td colspan="20" class="t_line"></td></tr>
<?
		$rows--;
	}
	if($total <= 0){
?>
  <tr bgcolor=ffffff align=center>
    <td height="25" colspan="4">포인트내역이 없습니다.</td>
  </tr>
  <tr><td colspan="20" class="t_line"></td></tr>
<?
	}
?>
</table>

<table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
	<tr><td height="5"></td></tr>
  <tr>
		<td width="20%"></td>
    <td width="60%"><? print_pagelist($page, $lists, $page_count, $param); ?></td>
    <td width="20%" align="right"><font color="red"><b>총 포인트 : <?=number_format($total_point)?></b></font></td>
  </tr>
</table>

<br>
<table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
<tr>
<td align="right">

<table height="10" border="0" cellpadding="0" cellspacing="0">
<form name="frm" action="member_save.php" method="post" onSubmit="return inputCheck(this)">
<input type="hidden" name="mode" value="point">
<input type="hidden" name="memid" value="<?=$id?>">
<input type="hidden" name="name" value="<?=$name?>">
  <tr><td height="5"></td></tr>
  <tr>
  	<td><FONT style="BACKGROUND-COLOR: #79c101" color=#ffffff>포인트부여</FONT> &nbsp;</td>
    <td>
    <select name="point_gubun">
    <option value="+">&nbsp; +&nbsp; 
    <option value="-">&nbsp; -&nbsp; 
    </select>
    </td>
    <td>&nbsp;<input type="text" name="point" value="포인트" size="12" class="input" onClick="inputEmpty(this,'포인트');"></td>
    <td>&nbsp;<input type="text" name="memo" value="포인트내용" size="35" class="input" onClick="inputEmpty(this,'포인트내용');"></td>
    <td>&nbsp;<input type="image" src="../image/btn_confirm_s.gif" align="absmiddle">&nbsp;&nbsp;</td>
  </tr>
  <tr><td height="5"></td></tr>
</form>
</table>

<?php
if(!empty($s_mode)) $s_ptype = $s_ptype .= "_".$s_mode;
?>

<form name="sfrm" action="<?=$PHP_SELF?>" method="post">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="name" value="<?=$name?>">
<table height="10" border="0" cellpadding="0" cellspacing="0">
  <tr><td height="5"></td></tr>
  <tr>
  	<td><FONT style="BACKGROUND-COLOR: #79c101" color=#ffffff>검색</FONT> &nbsp;</td>
    <td>
	    <select name="s_ptype">
	    <option value="">&nbsp; 전체</option>
	    <option value="JOIN">&nbsp; 회원가입</option>
	    <option value="LOGIN">&nbsp; 로그인</option>
	    <option value="BBS">&nbsp; 게시판 - 전체</option>
	    <option value="BBS_VIEW">&nbsp; 게시판 - 보기</option>
	    <option value="BBS_WRITE">&nbsp; 게시판 - 쓰기</option>
	    <option value="BBS_DOWN">&nbsp; 게시판 - 다운로드</option>
	    <option value="BBS_RECOM">&nbsp; 게시판 - 추천</option>
	    <option value="COMMENT">&nbsp; 코멘트</option>
	    <option value="MSG">&nbsp; 쪽지</option>
	    </select>
	    <script language="javascript">
	    <!--
	     s_ptype = document.sfrm.s_ptype;
	     for(ii=0; ii<s_ptype.length; ii++){
	        if(s_ptype.options[ii].value == "<?=$s_ptype?>")
	           s_ptype.options[ii].selected = true;
	     }
	    -->
	    </script>
    </td>
    <td>&nbsp;<input type="text" name="searchkey" value="<? if(empty($searchkey)) echo "포인트내용"; else echo $searchkey; ?>" size="27" class="input" onClick="inputEmpty(this,'포인트내용');"></td>
    <td>&nbsp;<input type="image" src="../image/btn_search.gif" align="absmiddle">&nbsp;&nbsp;</td>
  </tr>
  <tr><td height="5"></td></tr>
</table>
</form>

</td>
</tr>
</table>

</td>
</tr>
</table>
</body>
</html>
