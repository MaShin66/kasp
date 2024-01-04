<?php
include_once "../../common.php";
include_once "../../inc/admin_check.php";
include_once "../../inc/site_info.php";
include_once "../../ycommon.php";

$param = "page=".$page."&searchopt=".$searchopt."&searchkey=".$searchkey;

if($mode == "") $mode = "insert";

if($mode == "insert"){
}else if($mode == "update"){

    $sql = "select * from dm_history where idx = '$idx'";
    $result = mysql_query($sql) or error(mysql_error());
    $rowData = mysql_fetch_assoc($result);

    $sql="select * from dm_history_txt where left(date, 4) = '".$rowData['year']."' order by date asc";
    $result = mysql_query($sql) or error(mysql_error());
    $txtRowData = array();

    while($row = mysql_fetch_assoc($result)){
        $txtRowData[] = $row;
    }

//    yprint($txtRowData);

}

include "../head.php";

$q = 1;

?>

<script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>
<script src="/admin/js/ycommon.js?v=<?=time()?>"></script>
<link rel="stylesheet" href="//cdn.materialdesignicons.com/6.5.95/css/materialdesignicons.min.css">
<link rel="stylesheet" href=/admin/js/ycommon.css?v=<?=date('Y-m-d-H')?>">

<script type="text/javascript">
    var channel_form = '\
        <div class="form-group row">\
            <div class="col-sm-9 po_rel">\
                <input type="date" name="date[{key}]" value="{reg_dt}" class="input" />\
                <input type="text" name="text[{key}]" value="{text}" class="input" size="80" maxlength="255" placeholder="연혁내용" />\
                <input type="number" name="order[{key}]" value="{order}" placeholder="순서" class="input" />\
            </div>\
            <div class="col-sm-1">\
                {btn}\
            </div>\
        </div>\
    ';

    var add_btn = '<input type="button" class="btn2 btn-info add_channel" value="추가">';
    var delete_btn = '<input type="button" class="btn2 btn-info delete_channel" value="삭제">';

    function set_channel_form(key, name_value, btn, reg_dt, order) {
        var channel_form_tmp = channel_form;
        channel_form_tmp = channel_form_tmp.replace(/{key}/gi, key);
        channel_form_tmp = channel_form_tmp.replace(/{text}/gi, name_value);
        channel_form_tmp = channel_form_tmp.replace(/{btn}/gi, btn);
        channel_form_tmp = channel_form_tmp.replace(/{reg_dt}/gi, reg_dt);
        channel_form_tmp = channel_form_tmp.replace(/{order}/gi, order);
        return channel_form_tmp;
    }

    $(document).ready(function() {

        $('.channel').before(set_channel_form('','',add_btn,'',''));
        <? if ($mode == 'insert') { ?>
        <? } else if ($mode == 'update') {
        if (count($txtRowData) > 0) {
        foreach ($txtRowData as $k => $l) {
        ?>
        $('.channel').before(set_channel_form('old_<?=$l['idx']?>','<?=$l['text']?>',delete_btn,'<?=$l['date']?>', '<?=$l['order']?>'));
        <? }} } ?>

        $(document).on('click', '.add_channel', function(){
            var p = $(this).parents('.form-group');
            var ipt = p.find('input[type="text"]');
            var ipt2 = p.find('input[type="date"]');
            var ipt3 = p.find('input[type="order"]');
            $('.channel').append(set_channel_form('',ipt.val(),delete_btn,ipt2.val(),ipt3.val()));
            ipt.val('');
            ipt2.val('');
            ipt3.val('');
        });
        $(document).on('click', '.delete_channel', function(){
            $(this).parents('.form-group').remove();
        });
    });

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
        <td valign="bottom" class="tit">연혁관리</td>
        <td width="2"></td>
        <td valign="bottom" class="tit_alt">연혁을 추가/수정/삭제 관리합니다.</td>
    </tr>
</table>
<br>
<form class="frm_mg" name="frm" action="history_save.php" method="post" onSubmit="return frm_form_chk(this)" enctype="multipart/form-data">
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
            <td width="15%" class="t_name">사진</td>
            <td width="85%" class="t_value" colspan="3">
                <input type="file" name="picture<?=$q?>" id="picture<?=$q?>" value="<?=$rowData['picture'.$q]?>" accept=".gif, .jpg, .jpeg, .png, .gif, .bmp" class="d-none" />
                <input type="hidden" name="picture<?=$q?>_on" id="picture<?=$q?>_on" value="<?=$rowData['picture'.$q]?>" class="form-control" />
                <input type="hidden" name="picture<?=$q?>_del" value="" />

                <div class="float-left mr-3 mb-3">
                    <a href="javascript:;" onclick="f_preview_image_delete('<?=$q?>', 'picture','<?=$rowData['picture'.$q]?>')"><label class="image_del" id="picture<?=$q?>_del"><i class="mdi mdi-close"></i></label></a>
                    <label for="picture<?=$q?>" class="plus-input" id="picture<?=$q?>_box"><i class="mdi mdi-plus"></i></label>
                </div>
                <script type="text/javascript">
                    <!--
                    $('#picture<?=$q?>').on('change', function(e) {
                        f_preview_image_selected2(e, '<?=$q?>', 'picture');
                    });

                    <? if($rowData['picture'.$q]) { ?>
                    $('#picture<?=$q?>_del').show();
                    $("#picture<?=$q?>_box").css('border', 'none');
                    $("#picture<?=$q?>_box").html('<img class="rounded-circle" src="<?=$history_img_dir.'/'.$rowData['picture'.$q]?>?v=<?=time()?>" onerror="this.src=\'/admin/img/noimg.png\'" />');
                    <? } ?>
                    //-->
                </script>

                <div class="clearfix"></div>

                <small id="picture<?=$q?>_help" class="form-text text-muted">✳ pc에서︎ 350px X 250px 사이즈로 노출됩니다.</small>
            </td>
        </tr>
        <tr>
            <td width="15%" class="t_name">내용</td>
            <td width="85%" class="t_value" colspan="3">
                <small id="picture<?=$q?>_help" class="form-text text-muted">
                    ✳︎ 위 연도와 다른 연도를 입력하시면 위 연도로 변경저장됩니다.<br />
                    ✳︎ 연도를 작성하지 않은 내용은 저장되지 않습니다.<br />
                    ✳︎ 순서는 높을수록 같은날자일경우, 먼저 노출됩니다. [ex) 아래 노출됩니다.]
                </small>
                <div class="channel"></div>
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
                <img src="../image/btn_list_l.gif" style="cursor:hand" onclick="document.location='history_list.php?page=<?=$page?>';">
            </td>
        </tr>
    </table>
</form>


<? include "../foot.php"; ?>
