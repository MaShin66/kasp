<?
include_once "../../common.php";
include_once "../../inc/admin_check.php";
include_once "../../ycommon.php";

$param = "searchopt=".$searchopt."&searchkey=".$searchkey;
include "../head.php";

$sql = "select count(idx) as all_total from dm_history";
$result = $DB->fetch_assoc($sql);
$all_total = $result['all_total'];

if($searchopt != "") $search_sql .= " where $searchopt like '%$searchkey%' ";

$sql = "
    select 
        a.*, 
        (
            select group_concat(concat(replace(date, '-', '.'), ' ', text) order by b.date desc, b.order asc, b.idx asc SEPARATOR '/**/') 
            from dm_history_txt as b 
            where left(b.date,4) = a.year
        ) as txt
    from dm_history as a
    order by a.year desc
";

$result = mysql_query($sql) or error(mysql_error());
$total = mysql_num_rows($result);

//$result = $DB->select_assoc_query2($sql);
//$list_data = $result['data'];
//$total = $result['total'];

$rows = 20;
$lists = 5;
$page_count = ceil($total/$rows);
if(!$page || $page > $page_count) $page = 1;
$start = ($page-1)*$rows;
$no = $total-$start;

if($start>1) mysql_data_seek($result,$start);

?>
<script language="JavaScript" type="text/javascript">
<!--
function delConfirm(idx){
    if(confirm("삭제 하시겠습니까?\n삭제된 데이터는 복구되지 않습니다.")){
        document.location = "history_save.php?mode=delete&idx=" + idx;
    }
}
//-->
</script>
<link rel="stylesheet" href=/admin/js/ycommon.css?v=<?=date('Y-m-d-H')?>">

<table border="0" cellspacing="0" cellpadding="2">
    <tr>
        <td><img src="../image/ic_tit.gif"></td>
        <td valign="bottom" class="tit">연혁관리</td>
        <td width="2"></td>
        <td valign="bottom" class="tit_alt">연혁을 추가/수정/삭제 관리합니다.</td>
    </tr>
</table>

<br>
<table style="margin-bottom: 5px;" width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>등록된 연혁 갯수 : <b><?=$all_total?></b></td>
        <td align="right">
            <img src="../image/btn_add2.gif" style="cursor:hand" onClick="document.location='history_input.php?mode=insert';">
        </td>
    </tr>
</table>
<table class="t1" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr><td class="t_rd" colspan=20></td></tr>
    <tr class="t_th">
        <th width="8%">번호</th>
        <th width="10%">연도</th>
        <th>사진</th>
        <th>내용</th>
        <th width="10%">노출여부</th>
        <th width="15%">기능</th>
    </tr>
    <tr><td class="t_rd" colspan=20></td></tr>
    <?
    while(($row = mysql_fetch_array($result)) && $rows){
        ?>
        <tr>
            <td height="30" align="center"><?=$no?></td>
            <td align="center"><?=$row['year']?></td>
            <td align="center"><?=($row['picture1'])? '<a href="'.$history_img_dir."/".$row['picture1'].'" target="_blank"><img width="30" height="30" src="'.$history_img_dir."/".$row['picture1'].'" /></a>' :''?></td>
            <td align="left"><?=str_replace("/**/", "<br />", $row['txt'])?></td>
            <td align="center"><?=($row['show']) ? 'Y' :'N'?></td>
            <td align="center">
                <img src="../image/btn_edit_s.gif" style="cursor:hand" onClick="document.location='history_input.php?mode=update&idx=<?=$row['idx']?>&page=<?=$page?>&<?=$param?>';">
                <img src="../image/btn_delete_s.gif" style="cursor:hand" onClick="delConfirm('<?=$row['idx']?>')">
            </td>
        </tr>
        <tr><td colspan="20" class="t_line"></td></tr>
        <?
        $no--;
        $rows--;
    }

    if($total <= 0){
        ?>
        <tr><td height="30" colspan="10" align="center">등록된 데이터가 없습니다.</td></tr>
        <tr><td colspan="20" class="t_line"></td></tr>
        <?
    }
    ?>
</table>

<table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
    <tr><td height="5"></td></tr>
    <tr>
        <td><? print_pagelist($page, $lists, $page_count, $param); ?></td>
    </tr>
</table>

<? include "../foot.php"; ?>

