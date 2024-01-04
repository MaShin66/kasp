<? include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php"; ?>
<? include_once "$_SERVER[DOCUMENT_ROOT]/admin2/inc/bbs_info.php"; ?>
<?

echo "<link href=\"".$skin_dir."/style.css\" rel=\"stylesheet\" type=\"text/css\">";

if(
	($mem_level == "0") ||																																		// 전체관리자
	($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)	||	// 게시판관리자
	(!empty($wiz_admin[id]))																																	// 관리자
) {
} else {
	echo "<script>alert('관리자만 접근가능합니다.'); self.close();</script>";
	exit;
}
if($move == ""){
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>게시물이동</title>
<link href="../manage/wiz_style.css" rel="stylesheet" type="text/css">
<script language="javascript">
<!--
function inputCheck(frm){
	if(!frm.chg_code.value) {
		alert("이동할 게시판을 선택해주세요.");
		return false;
	} else {
		if(!confirm("게시물을 이동하시겠습니까?")){
			return false;
		}
	}
}
-->
</script>
<body>
<table align="center" width="100%" border="0" cellspacing="10" cellpadding="0">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<form name="frm" action="<?=$PHP_SELF?>" method="post" onSubmit="return inputCheck(this)">
			<input type="hidden" name="move" value="true">
			<input type="hidden" name="code" value="<?=$code?>">
			<input type="hidden" name="selbbs" value="<?=$selbbs?>">
			  <tr>
			    <td>
			      <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
			        <tr>
			          <td width="100" height="10" align="center" class="t_name">이동할 게시판</td>
			          <td class="t_value">

			          <select name="chg_code">
								<?
								if($mem_level != "0") $admin_sql = " and bbsadmin like '%".$wiz_session[id]."%' ";
								$sql = "select code,title from wiz_bbsinfo where code!='$code' and type = 'BBS' $admin_sql order by grp asc, prior asc";
								$result = mysql_query($sql) or error(mysql_error());
								$total = mysql_num_rows($result);
								while($row = mysql_fetch_array($result)){
								?>
								<option value="<?=$row[code]?>"><?=$row[title]?></option>
								<?
								}
								if($total <= 0) {
								?>
								<option value="">이동할 게시판이 없습니다.</option>
								<?php
								}
								?>
								</select>

			          </td>
			        </tr>
			      </table>
			    </td>
			  </tr>
			</table><br>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td align="center"><input type="submit" value=" 게시물이동 " class="sbtn"></td></tr>
			</form>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
<?
}else{

	$upfile_path = WIZHOME_PATH."/data/bbs/".$code;
	$chg_path = WIZHOME_PATH."/data/bbs/".$chg_code;

	if(!is_dir($chg_path)) mkdir($chg_path, 0707);

	$sql = "select max(prino) as prino from wiz_bbs where code='$chg_code'";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_array($result);
	$prino = $row[prino];

	$tmppri = "";
	$selarr = explode("|",$selbbs);

	for($ii=count($selarr); $ii>=0; $ii--){

		if($selarr[$ii]!=""){

			$sql = "select * from wiz_bbs where idx='$selarr[$ii]'";
			$result = mysql_query($sql) or error(mysql_error());
			$row = mysql_fetch_array($result);

			if($tmppri != $row[prino]) $prino++;

			for($jj = 1; $jj <= 12; $jj++) {

				@copy($upfile_path."/".$row["upfile".$jj], $chg_path."/".$row["upfile".$jj]);
				@copy($upfile_path."/M".$row["upfile".$jj], $chg_path."/M".$row["upfile".$jj]);
				@copy($upfile_path."/S".$row["upfile".$jj], $chg_path."/S".$row["upfile".$jj]);

			}

			for($jj = 1; $jj <= 12; $jj++) {

				@unlink($upfile_path."/".$row["upfile".$jj]);
				@unlink($upfile_path."/M".$row["upfile".$jj]);
				@unlink($upfile_path."/S".$row["upfile".$jj]);

			}

			$sql = "update wiz_bbs set code='$chg_code', prino='$prino' where idx='$selarr[$ii]'";
			mysql_query($sql);

			$tmppri = $row[prino];

		}
	}

	echo "<script>alert('이동되었습니다.');opener.document.location=window.opener.document.URL;self.close();</script>";
}
?>
