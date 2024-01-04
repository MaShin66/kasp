<?
/*
$no					: 글 넘버
$catname		: 카테고리
$re_space		: 답글 깊이
$re_icon		: 답글 아이콘
$subject		: 제목
$lock_icon	: 비밀글 아이콘
$new_icon		: 새글 아이콘
$hot_icon		: 인기글 아이콘
$name				: 이름
$email			: 이메일
$wdate			: 작성일
$count			: 조회수
$comment		: 댓글수
$recom			: 추천
$content		: 글내용
*/
//$content = cut_str(strip_tags($content),250);

// 포토 리스트에서 사용될 파일부분
for($ii = 1;$ii <= $bbs_info[upfile];$ii++){
	if(file_exists(WIZHOME_PATH."/data/bbs/".$code."/M".$row[upfile.$ii])) ${upimg_m.$ii} = "/admin/data/bbs/$code/M".$row[upfile.$ii];							// img
	else ${upimg_m.$ii} = "$skin_dir/image/noimg.gif";
}

// 관리자만이 제목클릭 가능
if(($mem_level == "0") || ($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)){
	$subject = $subject;
} else {
	$subject = $row[subject];
}

// 버튼설정
// 수정권한 체크
if($wpermi >= $mem_level){
	$modify_btn = "<a href='$PHP_SELF?ptype=input&mode=modify&idx=".$row[idx]."&$param'><image src='$skin_dir/image/btn_modify.gif' border='0'></a>";
	$delete_btn = "<a href='$PHP_SELF?ptype=passwd&mode=delete&idx=".$row[idx]."&$param'><image src='$skin_dir/image/btn_delete.gif' border='0'></a>";
} else {
	$modify_btn = "";
	$delete_btn = "";
}

if($bbs_info[recom] == "Y"){

	if(!check_point($wiz_session[id], $bbs_info[recom_point])) {
		$recom_btn = "<img src='$skin_dir/image/btn_recom.gif' border='0' onClick=\"alert('$bbs_info[point_msg]');\" style='cursor:pointer'>";
	} else {
		$recom_btn = "<a href='/admin/bbs/save.php?mode=recom&prev=$PHP_SELF&$param'><image src='$skin_dir/image/btn_recom.gif' border=0></a>";
	}

} else {
	$recom_btn = "";
}
?>

<script language="javascript">
<!--

// 불러올 이미지
var cuimg<?=$row[idx]?> = "<?=$row[upfile1]?>";
function chgImage<?=$row[idx]?>(idx){
	<? for($ii = 1;$ii <= $bbs_info[upfile]; $ii++){ ?>
	if(idx == '<?=$ii?>'){
		cuimg<?=$row[idx]?> = '<?=$row[upfile.$ii]?>';
		document.cuimg<?=$row[idx]?>.src = '<?=${upimg_m.$ii}?>';
	}
	<? } ?>
}

// 이미지 팝업
function cuImg<?=$row[idx]?>(){
	if(cuimg<?=$row[idx]?> == ""){
		alert("이미지가 없습니다.");
	}else{
		var url = "/admin/bbs/view_img.php?code=<?=$code?>&img=" + cuimg<?=$row[idx]?>;
		window.open(url, "cuImg<?=$row[idx]?>", "height=100, width=100, menubar=no, scrollbars=no, resizable=yes, toolbar=no, status=no");
	}
}
//-->
</script>
  <tr>
    <td height="7" colspan="2"></td>
  </tr>
  <tr>
    <td align="center"  width="310" height="320" valign="top">
    	<table width="100%" border="0" cellpadding="0" cellspacing="2" bgcolor="f3f3ec">
        <tr>
          <td bgcolor="#FFFFFF" align="center"><img src="<?=$upimg_m1?>" width="300" height="310" name="cuimg<?=$row[idx]?>" onClick="cuImg<?=$row[idx]?>();" style="cursor:hand;" vspace="3"></td>
        </tr>
      </table>
    </td>
    <td align="left" valign="top">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="5"></td>
          <td valign="top" width="65">
          	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	            <?
	            for($ii = 1; $ii <= $bbs_info[upfile];$ii++){
	            ?>
	            <tr>
	              <td  width="60" height="60" bgcolor="#FFFFFF" align="left" valign="top">
	                <img src="<?=${upimg_m.$ii}?>" width="60" height="60" vspace="0" <? if($row[upfile.$ii] != ""){ ?>onClick="chgImage<?=$row[idx]?>('<?=$ii?>');" style="cursor:hand;"<? } ?>>
	              </td>
	            </tr>
            	<? } ?>
            </table>
          </td>
          <td width="5"></td>
          <td valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td bgcolor="#efefef">
                	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                		<tr>
                			<td width="1"><?=$checkbox_body?></td>
                			<td><b><?=$subject?> <?=$comment?></b> <?=$new_icon?> <?=$hot_icon?></td>
                		</tr>
                	</table>
                </td>
              </tr>
              <tr>
                <td align="right"><?=$name?> <?=$wdate?></td>
              </tr>
              <tr>
                <td><?=$content?></td>
              </tr>
			        <tr>
			        	<td align="right"><?=$modify_btn?> <?=$delete_btn?> <?=$recom_btn?></td>
			        </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td height="7" colspan="2"></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="e1e1e1"></td>
  </tr>
