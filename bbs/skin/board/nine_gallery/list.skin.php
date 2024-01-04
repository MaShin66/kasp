<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

include_once("$board_skin_path/skin.lib.php");

if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 이상 버전이 설치되어 있어야 사용할 수 있는 갤러리 게시판 입니다.");

if (!$board[bo_1]) {
    $board[bo_1] = "140";
    $sql = " update $g4[board_table] set bo_1 = '$board[bo_1]', bo_1_subj = '목록 가로 픽셀' where bo_table = '$bo_table' ";
    sql_query($sql);
}

if (!$board[bo_2]) {
    $board[bo_2] = "100";
    $sql = " update $g4[board_table] set bo_2 = '$board[bo_2]', bo_2_subj = '목록 세로 픽셀' where bo_table = '$bo_table' ";
    sql_query($sql);
}

$mod = $board[bo_gallery_cols];
$td_width = (int)(100 / $mod);

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>
?>

<style>
<!--
.board_line {background-color:#d9e5f2;}
.board_top { clear:both; display:inline-block; width:100%; }

.board_page { clear:both; text-align:center; margin:3px 0 0 0; }
.board_page a:link { color:#777; }

.board_list .notice { font-weight:normal; font:bold 11px tahoma; color:#2C88B9; }
.board_list .current { font:bold 11px tahoma; color:#E15916; }
.board_list .comment { font-family:Tahoma; font-size:10px; color:#EE5A00; }

.board_search { text-align:center; margin:10px 0 0 0; }
.board_search .stx { height:21px; border:1px solid #9A9A9A; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; }
-->
</style>


<!-- 게시판 목록 시작 -->
<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0"><tr><td>
<!-- 분류 셀렉트 박스, 게시물 몇건, 관리자화면 링크 -->
    <div class="board_top">
        <div style="float:left;">
            <form name="fcategory" method="get" style="margin:0px;">
            <? if ($is_category) { ?>
            <select name=sca onchange="location='<?=$category_location?>'+<?=strtolower($g4[charset])=='utf-8' ? "encodeURIComponent(this.value)" : "this.value"?>;">
            <option value=''>전체</option>
            <?=$category_option?>
            </select>
            <? } ?>
            <?=subject_sort_link('wr_good', $qstr2, 1)?>추천순</a>&nbsp;<span style='font-size:11px; color:#D2D2D2;'>|</span>&nbsp<?=subject_sort_link('wr_hit', $qstr2, 1)?>조회순</a>&nbsp;<span style='font-size:11px; color:#D2D2D2;'>|</span>&nbsp<?=subject_sort_link('wr_comment', $qstr2, 1)?>코멘트순</a> <? if ($is_checkbox) { ?> <input onclick="if (this.checked) all_checked(true); else all_checked(false);" type=checkbox><?}?>
            </form>
        </div>
        <div style="float:right;">
         <span style="font-size:8pt;"><font face="Tahoma" color="#999999">Total. <?=number_format($total_count)?></font></span> 
        <? if ($rss_href) { ?><a href='<?=$rss_href?>'><img src='<?=$board_skin_path?>/img/btn_rss.gif' border=0 align=absmiddle></a><?}?>
        <? if ($admin_href) { ?><a href="<?=$admin_href?>"><img src="<?=$board_skin_path?>/img/admin_button.gif" title="관리자" border="0" align="absmiddle"></a><?}?>
        </div>
    </div>


<!-- 목록 -->
    <form name="fboardlist" method="post">
    <input type='hidden' name='bo_table' value='<?=$bo_table?>'>
    <input type='hidden' name='sfl'  value='<?=$sfl?>'>
    <input type='hidden' name='stx'  value='<?=$stx?>'>
    <input type='hidden' name='spt'  value='<?=$spt?>'>
    <input type='hidden' name='page' value='<?=$page?>'>
    <input type='hidden' name='sw'   value=''>

    <table width=100% cellpadding=0 cellspacing=0>
    <tr><td colspan='<?=$mod?>' height=5></td></tr>
    <tr><td colspan='<?=$mod?>' height=1 bgcolor=#DEE3E7></td></tr>
    <tr> 
    <? 
    for ($i=0; $i<count($list); $i++) { 
        if ($i && $i%$mod==0)
            echo "</tr><tr>";

        $style = "";
        $subject = "<span $style>{$list[$i][subject]}</span>";

        $comment_cnt = "";
        if ($list[$i][comment_cnt]) 
           $comment_cnt = " <a href=\"{$list[$i][comment_href]}\"><span style='font-size:10px;'><font face='Tahoma' color='#EE5A00'>{$list[$i][comment_cnt]}</span></a>";

        $list[$i][name] = preg_replace("/<img /", "<img style='display:none;' ", $list[$i][name]);
        $list[$i][name] = preg_replace("/> <span/", "><span", $list[$i][name]);
        $list[$i][name] = preg_replace("/class='member'/", "", $list[$i][name]);

        echo "<td width='{$td_width}%' valign=top style='word-break:break-all; padding:0px;'>";
        echo "<table align=center>";
        echo "<tr><td height=15></td></tr>";
        echo "<tr><td align=center><div style='float:left; border:1px solid #ccc; background:#fff; padding:4px; font-size:0; line-height:0;'><a href='{$list[$i][href]}'>".makeThumbs($g4[path]."/data/file/$bo_table", $list[$i][file][0][file], $board[bo_1], $board[bo_2], cut_str($list[$i][subject],20))."</a></div></td></tr>";
        //echo "<tr><td align=center style='font-size:11px; color:#888;'>Date.".$list[$i][datetime2]." / Hit.".$list[$i][wr_hit]."</td></tr>";
        echo "<tr><td align=center class=lh>";
        if ($is_category) echo "<a href='{$list[$i][ca_name_href]}'>[{$list[$i][ca_name]}]</a> ";
        echo "<a href='{$list[$i][href]}'>$subject</a><span class='comment'>{$comment_cnt}</span>";
        //echo " " . $list[$i][icon_new];
        //echo " " . $list[$i][icon_file];
        //echo " " . $list[$i][icon_link];
        //echo " " . $list[$i][icon_hot];
        //echo " " . $list[$i][icon_secret];
        echo "</td></tr>";
        if ($is_checkbox) echo "<tr><td align=center><input type=checkbox name=chk_wr_id[] value='{$list[$i][wr_id]}'></td></tr>";
        echo "</table></td>\n";
    }

    // 나머지 td
    $cnt = $i%$mod;
    if ($cnt)
        for ($i=$cnt; $i<$mod; $i++)
            echo "<td width='{$td_width}%'>&nbsp;</td>";
    ?>
    </tr>

    <? if (count($list) == 0) { echo "<tr><td colspan='$mod' height=100 align=center>게시물이 없습니다.</td></tr>"; } ?>
	<tr><td colspan='<?=$mod?>' height=15></td></tr>
    <tr><td colspan=<?=$mod?> bgcolor=#DEE3E7 height=1>
    </table>
    </form>

<!-- 버튼 링크 -->
<div style="margin:10px 0 0 0;">
    <div style="float:left;">
    <? if ($list_href) { ?>
    <a href="<?=$list_href?>"><img src="<?=$board_skin_path?>/img/btn_list.gif" align="absmiddle" border='0'></a>
    <? } ?>
    <? if ($is_checkbox) { ?>
    <a href="javascript:select_delete();"><img src="<?=$board_skin_path?>/img/btn_select_delete.gif" align="absmiddle" border='0'></a>
    <a href="javascript:select_copy('copy');"><img src="<?=$board_skin_path?>/img/btn_select_copy.gif" align="absmiddle" border='0'></a>
    <a href="javascript:select_copy('move');"><img src="<?=$board_skin_path?>/img/btn_select_move.gif" align="absmiddle" border='0'></a>
    <? } ?>
    </div>
    <div style="float:right;">
    <? if ($write_href) { ?><a href="<?=$write_href?>"><img src="<?=$board_skin_path?>/img/btn_write.gif" border='0'></a><? } ?>
    </div>
</div>

<!-- 페이지 -->
<table width="100%" cellspacing="0" cellpadding="0">
<tr> 
    <td width="100%"  height="36" align="center" valign="top">
        <? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/btn_search_prev.gif' border=0 align=absmiddle title='이전검색'></a>"; } ?>
        <?
        // 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
        //echo $write_pages;
        $write_pages = str_replace("처음", "<img src='$board_skin_path/img/begin.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
        $write_pages = str_replace("이전", "<img src='$board_skin_path/img/prev.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
        $write_pages = str_replace("다음", "<img src='$board_skin_path/img/next.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
        $write_pages = str_replace("맨끝", "<img src='$board_skin_path/img/end.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
        $write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "<b><font style=\"font-family:돋움; font-size:9pt; color:#797979\">$1</font></b>", $write_pages);
        $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><font style=\"font-family:돋움; font-size:9pt; color:orange;\">$1</font></b>", $write_pages);
        ?>
        <?=$write_pages?>
        <? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/btn_search_next.gif' border=0 align=absmiddle title='다음검색'></a>"; } ?>
    </td>
</tr>
</table>

<!-- 검색 -->
<table cellSpacing=1 cellPadding="10" width="100%" bgColor=#dfe4e9 border=0 height="21">
    <tr>
        <td align=middle bgColor=#f6f9fb>
        <form name="fsearch" method="get">
        <input type="hidden" name="bo_table" value="<?=$bo_table?>">
        <input type="hidden" name="sca"      value="<?=$sca?>">
        <select name="sfl" class="sel">
            <option value="wr_subject">제목</option>
            <option value="wr_content">내용</option>
            <option value="wr_subject||wr_content">제목+내용</option>
            <option value="mb_id,1">아이디</option>
            <option value="mb_id,0">아이디(코)</option>
            <option value="wr_name,1">글쓴이</option>
            <option value="wr_name,0">글쓴이(코)</option>
        </select>
        <input name="stx" class="stx" maxlength="28" itemname="검색어" required value='<?=stripslashes($stx)?>'>
        <input type="image" src="<?=$board_skin_path?>/img/btn_search.gif" border='0' align="absmiddle">
        <input type="radio" name="sop" value="and">AND
        <input type="radio" name="sop" value="or">OR
        </form>		
		</td>
</tr>
</table>

    </td>
    </tr>
</table>

<script type="text/javascript">
if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
if ('<?=$stx?>') {
    document.fsearch.sfl.value = '<?=$sfl?>';

    if ('<?=$sop?>' == 'and') 
        document.fsearch.sop[0].checked = true;

    if ('<?=$sop?>' == 'or')
        document.fsearch.sop[1].checked = true;
} else {
    document.fsearch.sop[0].checked = true;
}
</script>

<? if ($is_checkbox) { ?>
<script type="text/javascript">
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function check_confirm(str) {
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
function select_delete() {
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
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";
                       
    if (!check_confirm(str))
        return;

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<? } ?>
<!-- 게시판 목록 끝 -->
