<?
include_once "../../common.php";
include_once "../../inc/admin_check.php";
include_once "../../ycommon.php";

$param = "searchopt=".$searchopt."&searchkey=".$searchkey;
include "../head.php";

$_where = array();
if ($searchopt != "") {
    $_where[] = 'type = "'.$searchopt.'"';
}
if ($searchkey != "") {
    $_where[] = 'com_name like "%'.$searchkey.'%"';
}
$search_sql = "";
if (count($_where) > 0) {
    $search_sql = " where " . implode(" and ", $_where);
}

$sql = "select count(idx) as all_total from dm_member_company".$search_sql;

$result = $DB->fetch_assoc($sql);
$all_total = $result['all_total'];

$sql = "
    select 
        a.*
    from dm_member_company as a
    {$search_sql}
    order by a.type asc, 
        (
            case 
                when LEFT(a.com_name,1) REGEXP '^[가-힣]+' THEN 1
                when LEFT(a.com_name,1) REGEXP '^[0-9]+' THEN 2
                when LEFT(a.com_name,1) REGEXP '^[a-zA-Z]+' THEN 3
                ELSE 4
            END
        ) asc,
        a.com_name asc, `order` desc, a.idx desc
";
$result = mysql_query($sql) or error(mysql_error());
$total = mysql_num_rows($result);

$rows = 20;
$lists = 5;
$page_count = ceil($total/$rows);
if(!$page || $page > $page_count) $page = 1;
$start = ($page-1)*$rows;
$no = $total-$start;

if($start>1) mysql_data_seek($result,$start);

?>
<script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>
<link rel="stylesheet" href=/admin/js/ycommon.css?v=<?=date('Y-m-d-H')?>2">

<script language="JavaScript" type="text/javascript">
<!--
function delConfirm(code){
    if(confirm("삭제 하시겠습니까?\n삭제된 데이터는 복구되지 않습니다.")){
        document.location = "member_company_save.php?mode=delete&idx=" + code;
    }
}
//-->
</script>

<table border="0" cellspacing="0" cellpadding="2">
    <tr>
        <td><img src="../image/ic_tit.gif"></td>
        <td valign="bottom" class="tit">회원사관리</td>
        <td width="2"></td>
        <td valign="bottom" class="tit_alt">회원사를 추가/수정/삭제 관리합니다.</td>
    </tr>
</table>
<br>
<form name="searchForm" action="<?=$PHP_SELF?>" method="get">
    <input type="hidden" name="page" value="<?=$page?>">
    <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
        <tr>
            <td width="15%" class="t_name">조건검색</td>
            <td width="85%" class="t_value">

                <table cellspacing="2" cellpadding="0">
                    <tr>
                        <td>
                            <label>
                                등급선택&nbsp;
                                <select name="searchopt" id="searchopt" class="select">
                                    <option value="">전체</option>
                                    <? foreach ($mem_com_type as $k => $l) {
                                        $checked = "";
                                        if ($k == $searchopt) $checked = "selected=\"selected\"";
                                        ?>
                                    <option value="<?=$k?>" <?=$checked?>><?=$l?></option>
                                    <? } ?>
                                </select>
                            </label>
                        </td>
                        <td><input type="text" name="searchkey" id="searchkey" value="<?=$searchkey?>" class="input"></td>
                        <td><input type="image" src="../image/btn_search.gif"></td>
                        <td><div class="ybtn inital" id="inital">검색초기화</div></td>
                    </tr>
                </table>
                <script language="javascript">
                    <!--
                    $(document).ready(function() {
                        $(document).on('change','#searchopt',function(e){
                            var f = document.searchForm;
                            f.submit();
                        });
                        $(document).on('click','#inital',function(e){
                            var f = document.searchForm;
                            $('#searchopt').val('');
                            $('#searchkey').val('');
                            f.submit();
                        });
                    });
                    -->
                </script>

            </td>
        </tr>
    </table>
</form>

<br>
<table style="margin-bottom: 5px;" width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>총 갯수 : <b><?=$all_total?></b></td>
        <td align="right">
            <img src="../image/btn_add2.gif" style="cursor:hand" onClick="document.location='member_company_input.php?mode=insert';">
        </td>
    </tr>
</table>

<table class="t1" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr><td class="t_rd" colspan=20></td></tr>
    <tr class="t_th">
        <th width="8%">번호</th>
        <th width="10%">등급</th>
        <th width="10%">로고</th>
        <th>업체명</th>
        <th width="10%">대표자</th>
        <th width="10%">노출여부</th>
        <th width="15%">기능</th>
    </tr>
    <tr><td class="t_rd" colspan=20></td></tr>
    <?
    while(($row = mysql_fetch_array($result)) && $rows){
        ?>
        <tr>
            <td height="30" align="center"><?=$no?></td>
            <td align="center"><?=(isset($mem_com_type[$row['type']]))? $mem_com_type[$row['type']]: ''?></td>
            <td align="center">
                <?=($row['logo_path1'])? '<a href="'.$company_logo_img_dir."/".$row['logo_path1'].'" target="_blank"><img width="60" height="30" src="'.$company_logo_img_dir."/".$row['logo_path1'].'" /></a>' :''?>
            </td>
            <td align="center"><?=$row['com_name']?></td>
            <td align="center"><?=$row['boss_name']?></td>
            <td align="center"><?=($row['show']) ? 'Y' :'N'?></td>
            <td align="center">
                <img src="../image/btn_edit_s.gif" style="cursor:hand" onClick="document.location='member_company_input.php?mode=update&idx=<?=$row['idx']?>&page=<?=$page?>&<?=$param?>';">
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

