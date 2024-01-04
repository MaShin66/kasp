<?php
include_once "../../common.php";
include_once "../../inc/admin_check.php";
include_once "../../inc/site_info.php";
include_once "../../ycommon.php";

$param = "page=".$page."&searchopt=".$searchopt."&searchkey=".$searchkey;

if($mode == "") $mode = "insert";

if($mode == "insert"){
}else if($mode == "update"){
    $sql = "select * from dm_main_banner where idx = '$idx'";
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
    <link rel="stylesheet" href=/admin/js/ycommon.css?v=1<?=date('Y-m-d-H')?>">

    <script type="text/javascript">
        function frm_form_chk(f) {
            // $('#splinner_modal').modal('toggle');

            return true;
        }
    </script>

    <table border="0" cellspacing="0" cellpadding="2">
        <tr>
            <td><img src="../image/ic_tit.gif"></td>
            <td valign="bottom" class="tit">메인배너관리</td>
            <td width="2"></td>
            <td valign="bottom" class="tit_alt">메인배너를 추가/수정/삭제 관리합니다.</td>
        </tr>
    </table>

    <br>
    <form class="frm_mg" name="frm" action="banner_save.php" method="post" onSubmit="return frm_form_chk(this)" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="<?=$mode?>">
        <input type="hidden" name="idx" value="<?=$rowData['idx']?>">
        <input type="hidden" name="page" value="<?=$page?>">

        <table width="100%" border="0" cellspacing="1" cellpadding="2" class="t_style">

            <tr>
                <td width="15%" class="t_name">제목</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="title" value="<?=$rowData['title']?>" class="input" size="90" maxlength="255" />
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">내용</td>
                <td width="85%" class="t_value" colspan="3">
                    <textarea id="contents" class="textarea" name="contents"><?=(isset($rowData['contents'])) ? stripslashes($rowData['contents']) : ''?></textarea>
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">출력위치</td>
                <td width="85%" class="t_value" colspan="3">
                    <select name="type">
                        <?
                        foreach ($main_banner_type as $k => $l) {
                            $selected = '';
                            if ($rowData['type'] == $k) $selected = 'selected';
                            echo '<option value="'.$k.'" '.$selected.'>'.$l.'</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">순서</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="number" name="rank" value="<?=$rowData['rank']?>" class="input" size="30" />
                    <div>
                        <small id="order_help" class="form-text text-muted">✳ 순서가 높을수록 같은 등급 내 상위 노출됩니다.</small>
                    </div>
                </td>
            </tr>
            <?
                for ($q=1; $q<=3; $q++) {
                    $banner_tr_class = "";
                    if ($q === 3) $banner_tr_class = "d-none";
            ?>
            <tr class="<?=$banner_tr_class?>">
                <td width="15%" class="t_name">배너<?=$q?></td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="file" name="picture<?=$q?>" id="picture<?=$q?>" value="<?=$rowData['picture'.$q]?>" accept=".gif, .jpg, .jpeg, .png, .gif, .bmp" class="d-none" />
                    <input type="hidden" name="picture<?=$q?>_on" id="picture<?=$q?>_on" value="<?=$rowData['picture'.$q]?>" class="form-control" />
                    <input type="hidden" name="picture<?=$q?>_del" value="" />

                    <div class="float-left mr-3 mb-3">
                        <a href="javascript:;" onclick="f_preview_image_delete('<?=$q?>', 'picture','<?=$rowData['file'.$q]?>')"><label class="image_del" id="picture<?=$q?>_del"><i class="mdi mdi-close"></i></label></a>
                        <label for="picture<?=$q?>" class="plus-input" id="picture<?=$q?>_box"><i class="mdi mdi-plus"></i></label>
                    </div>
                    <script type="text/javascript">
                        <!--
                        $('#picture<?=$q?>').on('change', function(e) {
                            f_preview_image_selected2(e, '<?=$q?>', 'picture');
                        });

                        <? if($rowData['file'.$q]) { ?>
                        $('#picture<?=$q?>_del').show();
                        $("#picture<?=$q?>_box").css('border', 'none');
                        $("#picture<?=$q?>_box").html('<img class="rounded-circle" src="<?=$main_banner_img_dir.'/'.$rowData['file'.$q]?>?v=<?=time()?>" onerror="this.src=\'/admin/img/noimg.png\'" />');
                        <? } ?>
                        //-->
                    </script>
                </td>
            </tr>
            <? } ?>
            <tr>
                <td width="15%" class="t_name">배너</td>
                <td width="85%" class="t_value" colspan="3">
                    <div class="clearfix"></div>
                    <small id="picture_help" class="form-text text-muted">✳ 출력위치 큰배너1,2의 경우 2개의 이미지를 사용합니다. 나머지는 배너1만 등록하시면 됩니다.</small><br />
                    <small id="picture_help" class="form-text text-muted">✳ 출력위치 큰배너1,2의 pc 사이즈는 1030px x 160px 사이즈로 노출됩니다.</small><br />
                    <small id="picture_help" class="form-text text-muted">✳ 출력위치 큰배너1,2의 mobile 사이즈는 384px x 207px 사이즈로 노출됩니다.</small><br />
                    <small id="picture_help" class="form-text text-muted">✳ 출력위치 큰배너1 오른쪽 작은배너1,2: 115px X 160px 사이즈로 노출됩니다.</small><br />
                    <small id="picture_help" class="form-text text-muted">✳ 출력위치 큰배너1 오른쪽 중간배너: 250px X 158px 사이즈로 노출됩니다.</small><br />
                    <small id="picture_help" class="form-text text-muted">✳ 출력위치 롤링배너: 200px X 80px 사이즈로 노출됩니다.</small>
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">링크</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="link" value="<?=$rowData['link']?>" class="input" size="90" maxlength="255" />
                    <label><input type="checkbox" name="blank" value="1" <?=($rowData['target'] == '1') ? 'checked' : ''?> /> 새창열기</label>
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">대체택스트</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="alt" value="<?=$rowData['alt']?>" class="input" size="90" maxlength="255" />
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
                    <img src="../image/btn_list_l.gif" style="cursor:hand" onclick="document.location='banner_list.php?page=<?=$page?>';">
                </td>
            </tr>
        </table>
    </form>

<? include "../foot.php"; ?>