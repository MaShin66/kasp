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
$content = cut_str(strip_tags($content),80);
?>
<? if($idx%2 == 0) echo "<tr><td height=2></td><tr><tr>"; ?>

<td align="center" width="50%" style="padding:5px">
	<table width="100%" border="0" cellpadding="6" cellspacing="1" bgcolor="efefef">
    <tr>
      <td bgcolor="#FFFFFF" style="padding:5px">
      	<table width="100%" border="0" cellspacing="3" cellpadding="5">
        <tr>
          <td colspan="2" align="left" valign="top" style="word-break:break-all;">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="1%" align="center"><?=$checkbox_body?></td>
								<td align="left"><b><?=$catname?> <?=$subject?> <?=$comment?> <?=$lock_icon?> <?=$new_icon?> <?=$hot_icon?></b></td>
							</tr>
						</table>
          </td>
          <td align="right"></td>
        </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td width="120" height="28" align="center" valign="top" bgcolor="f7f7f7">
          	<table border="0" cellpadding="0" cellspacing="5" bgcolor="ffffff">
              <tr>
                <td bgcolor="#FFFFFF" align="center" valign="center"><img src="<?=$upimg_s?>" width="90" height="90"></td>
              </tr>
            </table>
          </td>
          <td align="left" valign="top" bgcolor="f7f7f7" style="word-break:break-all;"><?=$content?></td>
        </tr>
      </table></td>
    </tr>
  </table>
</td>
