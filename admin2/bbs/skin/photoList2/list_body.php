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

if($bbs_info[recom] == "Y"){

	if(!check_point($wiz_session[id], $bbs_info[recom_point])) {
		$recom_btn = "<img src='$skin_dir/image/btn_recom.gif' border='0' onClick=\"alert('$bbs_info[point_msg]');\" style='cursor:pointer'>";
	} else {
		$recom_btn = "<a href='/admin2/bbs/save.php?mode=recom&prev=$PHP_SELF&$param'><image src='$skin_dir/image/btn_recom.gif' border=0></a>";
	}

} else {
	$recom_btn = "";
}
?>
	<tr>
		<td width="1"><?=$checkbox_body?></td>
		<? if(!strcmp($bbs_idx, $row[idx]) || (empty($bbs_idx) && $total == $no)) { ?>
	  <td align="left" class="l02">
	  	<img src="<?=$skin_dir?>/image/ic_arrow.gif" valign="middle">
	  	<b><a href="<?=$PHP_SELF?>?code=<?=$code?>&bbs_idx=<?=$row[idx]?>"><?=$row[subject]?></a> <?=$comment?></b>
	  </td>
		<? } else { ?>
		<td align="left"><a href="<?=$PHP_SELF?>?code=<?=$code?>&bbs_idx=<?=$row[idx]?>"><?=$row[subject]?></a></td>
		<? } ?>
		<td align="right"><?=$modify_btn?> <?=$delete_btn?> <?=$recom_btn?></td>
	</tr>

