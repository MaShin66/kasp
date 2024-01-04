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
$file_icon	: 첨부파일 아이콘
$name				: 이름
$email			: 이메일
$wdate			: 작성일
$count			: 조회수
$comment		: 댓글수
$recom			: 추천
$content		: 글내용
*/

// 버튼설정
// 수정권한 체크
if($wpermi >= $mem_level){
	$modify_btn = "<a href='$PHP_SELF?ptype=input&mode=modify&idx=".$row[idx]."&$param'><image src='$skin_dir/image/btn_modify.gif' border='0'></a>";
	$delete_btn = "<a href='$PHP_SELF?ptype=passwd&mode=delete&idx=".$row[idx]."&$param'><image src='$skin_dir/image/btn_delete.gif' border='0'></a>";
} else {
	$modify_btn = "";
	$delete_btn = "";
}
?>
	<tr>
		<td align="center" width="1%"><?=$checkbox_body?></td>
	  <td align="center" width="3%" height="28"><img src="<?=$skin_dir?>/image/ic_q.gif" /></td>
	  <td align="left" style="padding-left:10px;"><?=$catname?> <?=$re_space?><?=$re_icon?><a href="javascript:faqShow('<?=$no?>');"><?=$row[subject]?></a> <?=$comment?> <?=$lock_icon?> <?=$new_icon?> <?=$hot_icon?></td>
	</tr>
	<tr>
		<td colspan="3">
			<table width="100%" cellspacing="0" cellpadding="0" id="faq<?=$no?>" style="display:none">
	      <tr>
	        <td height="5"></td>
	      </tr>
	      <tr>
	        <td><table cellspacing="1" cellpadding="0" border="0" width="100%" bgcolor="e2e2e2">
	          <tr>
	            <td bgcolor="f9f9f9" style="padding-top:6px;padding-bottom:6px;">
	            <table cellspacing="3" cellpadding="2" border="0" width="100%">
	              <tr>
	                <td width="1"></td>
	                <td width="15" valign="top" align="left"><img src="<?=$skin_dir?>/image/ic_a.gif" /></td>
	                <td align="left" style="word-break:break-all;"><?=$content?></td>
					        <td align="right" valign="top"><?=$modify_btn?>&nbsp;<?=$delete_btn?></td>
	              </tr>
	            </table></td>
	          </tr>
	        </table></td>
	      </tr>
	      <tr>
	        <td height="5"></td>
	      </tr>
	    </table>
		</td>
	</tr>
	<tr>
	  <td colspan="3" height="1" bgcolor="#d7d7d7"></td>
	</tr>
