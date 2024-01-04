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
?>
<tr>
	<td align="center" height="28"><?=$no?></td>
	<td align="left" style="padding-left:0px;word-break:break-all;"><?=$title?> <?=$catname?> <?=$re_space?><?=$re_icon?><?=$subject?> <?=$lock_icon?> <?=$new_icon?> <?=$hot_icon?> <?=$file_icon?></td>
	<td align="center"><?=$name?></td>
	<td align="center"><?=$wdate?></td>
</tr>
<tr>
  <td colspan="4">
  	<table width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td><table cellspacing="1" cellpadding="0" border="0" width="100%" bgcolor="e2e2e2">
        <tr>
          <td bgcolor="f9f9f9">
          <table cellspacing="3" cellpadding="2" border="0" width="100%">
            <tr>
              <td width="1"></td>
              <td style="word-break:break-all;" align="left"><?=$content?></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
  </table></td>
</tr>
