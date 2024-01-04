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
		<td><?=$checkbox_body?></td>
		<td class="number"><?=$no?></td>
		<td class="tit"><?=$catname?> <?=$re_space?><?=$re_icon?><?=$subject?> <?=$comment?> <?=$lock_icon?> <?=$new_icon?> <?=$hot_icon?> <?=$file_icon?></td>
		<td><?=$name?></td>
		<td><?=$wdate?></td>
		<td class="number"><?=$count?></td>
		<?=$hide_recom_start?>
		<td><?=$recom?></td>
		<?=$hide_recom_end?>
    </tr>