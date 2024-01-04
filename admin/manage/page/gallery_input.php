<?php
include_once "../../common.php";
include_once "../../inc/admin_check.php";
include_once "../../inc/site_info.php";
include_once "../../ycommon.php";

$param = "page=".$page."&searchopt=".$searchopt."&searchkey=".$searchkey;

if($mode == "") $mode = "insert";

if($mode == "insert"){
}else if($mode == "update"){
    $sql = "select * from dm_gallery where idx = '$idx'";
    $result = mysql_query($sql) or error(mysql_error());
    $rowData = mysql_fetch_assoc($result);
}

include "../head.php";

?>

<script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>
<script src="/admin/js/ycommon.js?v=<?=time()?>"></script>
<link rel="stylesheet" href="//cdn.materialdesignicons.com/6.5.95/css/materialdesignicons.min.css">
<link rel="stylesheet" href=/admin/js/ycommon.css?v=<?=date('Y-m-d-H')?>">

<script type="text/javascript">
    function frm_form_chk(f) {
        if(f.year.value=="") {
            alert("연도를 입력해주세요.");
            f.year.focus();
            return false;
        }

        // $('#splinner_modal').modal('toggle');

        return true;
    }
</script>

<table border="0" cellspacing="0" cellpadding="2">
    <tr>
        <td><img src="../image/ic_tit.gif"></td>
        <td valign="bottom" class="tit">갤러리연도관리</td>
        <td width="2"></td>
        <td valign="bottom" class="tit_alt">갤러리 연도 추가 관리합니다.</td>
    </tr>
</table>
<br>
<form class="frm_mg" name="frm" action="gallery_save.php" method="post" onSubmit="return frm_form_chk(this)" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="<?=$mode?>">
    <input type="hidden" name="idx" value="<?=$rowData['idx']?>">
    <input type="hidden" name="page" value="<?=$page?>">

    <table width="100%" border="0" cellspacing="1" cellpadding="2" class="t_style">
        <tr>
            <td width="15%" class="t_name">연도 <font color="red">*</font></td>
            <td width="85%" class="t_value" colspan="3">
                <input type="number" name="year" placeholder="ex) 2023" min="2000" step="1" value="<?=$rowData['year']?>" size="30" class="input" maxlength="30" <? if($mode == "update") echo "readonly"; ?>>
            </td>
        </tr>
        <tr>
            <td width="15%" class="t_name">보임여부</td>
            <td width="85%" class="t_value" colspan="3">

                <label><input type="radio" name="show" value="Y" <?=($rowData['show'] == '1' || !isset($rowData['show']))?'checked=""':''?>> 보임</label>
                <label><input type="radio" name="show" value="N" <?=($rowData['show'] == '0')?'checked=""':''?>> 안보임</label>
            </td>
        </tr>
    </table>

    <br>
    <table align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <input type="image" src="../image/btn_confirm_l.gif"> &nbsp;
                <img src="../image/btn_list_l.gif" style="cursor:hand" onclick="document.location='gallery_list.php?page=<?=$page?>';">
            </td>
        </tr>
    </table>
</form>


<? include "../foot.php"; ?>
