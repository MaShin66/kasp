<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 6;
if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>
?>

<link href="<?=$board_skin_path?>/style.css" rel="stylesheet" type="text/css" />

<!-- 게시판 목록 시작 -->
<table border="0" width="<?=$width?>" align="center" cellpadding="0" cellspacing="0">
    <tr>
	    <td>
<!-- 분류 셀렉트 박스, 게시물 몇건, 관리자화면 링크 -->
<div style="float:left;height:22px;">
<? if ($is_category) { ?> 
<? if (!$wr_id) {  ?> 
<?   
    $cnt_bo_1 = $bo_1[0] ? $bo_1[0] : 10; // 한줄당 분류 갯수(현재:10) 
    $cnt = 1; 
    $cnt0 = 0; 
    $bb_s=""; $bb_e=""; 
    $b_s=""; $b_e=""; 
    $arr = explode("|", $board[bo_category_list]); // 구분자가 , 로 되어 있음 
    $str = "&nbsp;<span style='font-family: Tahoma; font-size:10px; color:#D2D2D2;'>|</span>&nbsp;"; 
    for ($i=0; $i<count($arr); $i++) 
        if (trim($arr[$i]))  { 
        if ($sca == $arr[$i]) { $cnt0++; $b_s="<b>"; $b_e="</b>"; } else {$b_s=""; $b_e="";} 
            $str .= " <a href='./board.php?bo_table=$bo_table&sca=".urlencode($arr[$i])."'>$b_s$arr[$i]$b_e</a>&nbsp;&nbsp;<span style='font-family: Tahoma; font-size:10px; color:#D2D2D2;'>|</span>&nbsp;"; 

if ($cnt == $cnt_bo_1) { $cnt = 0; $str .= "<br>"; } 
    $cnt++; 
    } 
    if ($cnt0 == 0 ) { $bb_s="<b>"; $bb_e="</b>"; } 
?> 
<?echo "  ";echo $bb_s;?><a href='./board.php?bo_table=<?=$bo_table?>&page=<?=$page?>'>전체</a><?=$bb_e?> <span style="font-size:8pt; color=#AEAEAE;">(<?=number_format($total_count)?>)</span>
<?=$str?>
<? } ?> 
<? } ?>
</div>
<div class='bbs_count'>
    TOTAL <?=number_format($total_count)?> 
    <? if ($rss_href) { ?><a href='<?=$rss_href?>'><img src='<?=$board_skin_path?>/img/btn_rss.gif' border='0' align='absmiddle'></a><?}?>
    <? if ($admin_href) { ?><a href="<?=$admin_href?>"><img src="<?=$board_skin_path?>/img/admin_button.gif" title="관리자" border="0" align="absmiddle"></a><?}?>
</div>


<!-- 제목 -->
<form name="fboardlist" method="post" style="margin:0px;">
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<input type="hidden" name="sfl"  value="<?=$sfl?>">
<input type="hidden" name="stx"  value="<?=$stx?>">
<input type="hidden" name="spt"  value="<?=$spt?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="sw"   value="">

<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
	    <td colspan=<?=$colspan?> class="bbs_line1"></td></tr>
    <tr height="30" class="bbs_top_title">
        <td width="50">번호</td>
        <? if ($is_category) { ?><td class="ca" width="34">분류</td><?}?>
        <? if ($is_checkbox) { ?><td><INPUT onclick="if (this.checked) all_checked(true); else all_checked(false);" type=checkbox></td><?}?>
        <td>제목</td>
        <td class="na" align="right">작성자</td>
        <td width="50" align="center"><?=subject_sort_link('wr_datetime', $qstr2, 1)?>등록일</a></td>	
	    <td width="50" align="center"><?=subject_sort_link('wr_hit', $qstr2, 1)?>조회수</a></td>
        <? if ($is_good) { ?><td width='40' align='center'><?=subject_sort_link('wr_good', $qstr2, 1)?>추천</a></td><?}?>
        <? if ($is_nogood) { ?><td width='40' align='center'><?=subject_sort_link('wr_nogood', $qstr2, 1)?>비추천</a></td><?}?>
    </tr>
    <tr>
	    <td colspan=<?=$colspan?> class="bbs_line2"></td>
	</tr>
<!-- 목록 -->
<? for ($i=0; $i<count($list); $i++) { ?>
    <tr height="33" align="center" <?  if ($list[$i][is_notice])  { echo " bgcolor=#f8f9fa "; } ?>> 
        <td>
        <? 
        if ($list[$i][is_notice]) // 공지사항 
            echo "<img src=\"$board_skin_path/img/notice_icon.gif\">";
        else if ($wr_id == $list[$i][wr_id]) // 현재위치
            echo "<span class='text8'>{$list[$i][num]}</span>";
        else
            echo "<span class='text8'>{$list[$i][num]}</span>";
        ?></td>
        <? if ($is_category) { ?><td><a href="<?=$list[$i][ca_name_href]?>"><strong><font color=gray><span class=small><?=$list[$i][ca_name]?></strong></span></font></a></td><? } ?>
        <? if ($is_checkbox) { ?><td><input type=checkbox name=chk_wr_id[] value="<?=$list[$i][wr_id]?>"></td><? } ?>
        <td align=left style='word-break:break-all;'>
        <? 
        echo $nobr_begin;
        echo $list[$i][reply];
        echo $list[$i][icon_reply];
        echo "<a href='{$list[$i][href]}'>";
	    if ($list[$i][is_notice])
            echo "<span class='list_not_text'>{$list[$i][subject]}</span>";
        else
        {
            $style1 = $style2 = "";
            if ($list[$i][icon_new])
                $style1 = "color:#;"; // 최신글 컬러
            if (!$list[$i][comment_cnt]) // 코멘트 없는것만 굵게
                $style2 = "";
            echo "<span style='$style1 $style2'>{$list[$i][subject]}</span>";
        }
        echo "</a>";

        if ($list[$i][comment_cnt]) 
            echo " <a href=\"{$list[$i][comment_href]}\"><span class='text_comment'>{$list[$i][comment_cnt]}</span></a>";
        echo " " . $list[$i][icon_new];
        echo " " . $list[$i][icon_file];
        echo " " . $list[$i][icon_link];
        echo " " . $list[$i][icon_hot];
        echo " " . $list[$i][icon_secret];
        echo $nobr_end;
        ?></td>
        <td align="right" class="na"><?=$list[$i][name]?></td>
        <td class="text8" align="center"><?=date("m-d", strtotime($list[$i][wr_datetime]))?></td>
        <td class="text8" align="center"><?=$list[$i][wr_hit]?></td>
        <? if ($is_good) { ?><td align="center" class="text8"><?=$list[$i][wr_good]?></td><? } ?>
        <? if ($is_nogood) { ?><td align="center" class="text8"><?=$list[$i][wr_nogood]?></td><? } ?>
    </tr>
    <tr>
	    <td colspan=<?=$colspan?> class='bbs_line'></td>
	</tr>
<?}?>
    <? if (count($list) == 0) { echo "<tr><td colspan='$colspan' height='400' align='center'>게시물이 없습니다.</td></tr>"; } ?>
    <tr><td colspan=<?=$colspan?> class='bbs_line'></td>
	</tr>
</table>
</form>

<!-- 페이징 -->
<div class="paginate_complex">
    <? if ($prev_part_href) { echo "<a href='$prev_part_href' class=\"direction prev\">	<span> </span><span> </span> 이전검색</a>"; } ?>
    <?
    // 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
    /*
    $write_pages = str_replace("처음", "<img src='$board_skin_path/img/page_begin.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
    $write_pages = str_replace("이전", "<img src='$board_skin_path/img/page_prev.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
    $write_pages = str_replace("다음", "<img src='$board_skin_path/img/page_next.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
    $write_pages = str_replace("맨끝", "<img src='$board_skin_path/img/page_end.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
    $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><span style=\"color:#4D6185; font-size:12px; text-decoration:underline;\">$1</span></b>", $write_pages);
    */
    $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<strong>$1</strong>", $write_pages);
    $write_pages = str_replace(">처음", " class=\"direction prev\">	<span> </span><span> </span> ", $write_pages);
    $write_pages = str_replace(">이전", " class=\"direction prev\"><span> </span> ", $write_pages);
    $write_pages = str_replace(">다음", " class=\"direction next\" > <span> </span> ", $write_pages);
    $write_pages = str_replace(">맨끝", " class=\"direction next\" ><span> </span><span> </span> ", $write_pages);
    $write_pages = str_replace("&nbsp;", "", $write_pages);
    ?>
    <?=$write_pages?>
    <? if ($next_part_href) { echo "<a href='$next_part_href'> class=\"direction next\">다음검색 <span> </span><span> </span></a>"; } ?>
</div>

<!-- 검색&버튼 -->
<div style="float:left;">
<table cellpadding="0" cellspacing="0">
    <tr>
        <td align="left">
        <form name="fsearch" method="get">
        <input type="hidden" name="bo_table" value="<?=$bo_table?>">
        <input type="hidden" name="sca" value="<?=$sca?>">
        <select name="sfl" class="sel">
            <option value="wr_subject">제목</option>
            <option value="wr_content">내용</option>
            <option value="wr_subject||wr_content">제목+내용</option>
            <option value="mb_id,1">아이디</option>
            <option value="mb_id,0">아이디(코)</option>
            <option value="wr_name,1">글쓴이</option>
            <option value="wr_name,0">글쓴이(코)</option>
        </select>		
		</td>
        <td align="left"><input name="stx" class="bbs_search" maxlength="33" itemname="검색어" required value='<?=stripslashes($stx)?>'></td>
        <td><input type=image src="<?=$board_skin_path?>/img/btn_search.gif" border="0" align="absmiddle"></td>
    </tr>
</table>	
</form>
</div>

<div style="float:right;">
    <? if ($is_checkbox) { ?>
    <a href="javascript:select_delete();"><img src="<?=$board_skin_path?>/img/btn_select_delete.gif" border='0'></a><a href="javascript:select_copy('copy');"><img src="<?=$board_skin_path?>/img/btn_select_copy.gif" border='0'></a><a href="javascript:select_copy('move');"><img src="<?=$board_skin_path?>/img/btn_select_move.gif" border='0'></a>
    <? } ?>	
    <? if ($list_href) { ?><a href="<?=$list_href?>"><img src="<?=$board_skin_path?>/img/btn_list.gif" border='0'></a><? } ?>
    <? if ($write_href) { ?><a href="<?=$write_href?>"><img src="<?=$board_skin_path?>/img/btn_write.gif" border='0'></a><? } ?>
</div>

    </td>
    </tr>
</table>


<script language="JavaScript">
if ("<?=$sca?>") document.fcategory.sca.value = "<?=$sca?>";
if ("<?=$stx?>") {
    document.fsearch.sfl.value = "<?=$sfl?>";
}
</script>

<? if ($is_checkbox) { ?>
<script language="JavaScript">
function all_checked(sw)
{
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function check_confirm(str)
{
    var f = document.fboardlist;
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(str + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }
    return true;
}

// 선택한 게시물 삭제
function select_delete()
{
    var f = document.fboardlist;

    str = "삭제";
    if (!check_confirm(str))
        return;

    if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
        return;

    f.action = "./delete_all.php";
    f.submit();
}

// 선택한 게시물 복사 및 이동
function select_copy(sw)
{
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";
                       
    if (!check_confirm(str))
        return;

    var sub_win = window.open("", "move", "left=50, top=50, width=396, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<? } ?>
<!-- 게시판 목록 끝 -->