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
$content = cut_str(strip_tags($content),150);
?>
	<tr valign="top">
		<td align="center" width="120" style="padding:5px;"><img src="<?=$upimg_s?>" width="101" height="75" border="0" /></td>
		<td style="padding:5px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="1"><?=$checkbox_body?></td>
								<td align="left"><strong><?=$catname?> <?=$subject?> <?=$comment?> <?=$lock_icon?> <?=$new_icon?> <?=$hot_icon?></strong></td>
								<td align="right">작성일:<?=$wdate?>   보기:<?=$count?> <?=$hide_recom_start?>추천:<?=$recom?><?=$hide_recom_end?></td>   
							</tr>
						</table>
					</td>
					</tr>
					<td align="left"><?=$content?></td>                                   
				</tr>
			</table>
		</td>
	</tr>
	<tr><td colspan="2" height="1" bgcolor="#d7d7d7"></td></tr>
