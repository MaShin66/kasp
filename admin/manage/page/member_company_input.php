<?php
include_once "../../common.php";
include_once "../../inc/admin_check.php";
include_once "../../inc/site_info.php";
include_once "../../ycommon.php";

$param = "page=".$page."&searchopt=".$searchopt."&searchkey=".$searchkey;

if($mode == "") $mode = "insert";

if($mode == "insert"){
}else if($mode == "update"){
    $sql = "select * from dm_member_company where idx = '$idx'";
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
<script type="text/javascript" src="/admin/webedit/cheditor.js?v=2"></script>

<script type="text/javascript">
function frm_form_chk(f) {
    // $('#splinner_modal').modal('toggle');
    f.vision.value = vision.outputBodyHTML();
    f.business.value = business.outputBodyHTML();
    f.major_customer.value = major_customer.outputBodyHTML();
    f.products.value = products.outputBodyHTML();
    f.product_advantages.value = product_advantages.outputBodyHTML();
    f.projects.value = projects.outputBodyHTML();
    f.industry.value = industry.outputBodyHTML();

    return true;
}
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
    <form class="frm_mg" name="frm" action="member_company_save.php" method="post" onSubmit="return frm_form_chk(this)" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="<?=$mode?>">
        <input type="hidden" name="idx" value="<?=$rowData['idx']?>">
        <input type="hidden" name="page" value="<?=$page?>">

        <table width="100%" border="0" cellspacing="1" cellpadding="2" class="t_style">
            <tr>
                <td width="15%" class="t_name">회원사 등급</td>
                <td width="85%" class="t_value" colspan="3">
                    <select name="type">
                        <?
                        foreach ($mem_com_type as $k => $l) {
                            $selected = '';
                            if ($rowData['type'] == $k) $selected = 'selected';
                            echo '<option value="'.$k.'" '.$selected.'>'.$l.'</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">회원구분</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="member_type" value="<?=$rowData['member_type']?>" class="input" size="30" maxlength="255" />
                </td>
            </tr>
            <tr class="d-none">
                <td width="15%" class="t_name">순서</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="number" name="order" value="<?=$rowData['order']?>" class="input" size="30" />
                    <div>
                        <small id="order_help" class="form-text text-muted">✳ 순서가 높을수록 같은 등급 내 상위 노출됩니다.</small>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">로고</td>
                <td width="85%" class="t_value" colspan="3">
                    <div class="clearfix"></div>
                    <small id="picture_help" class="form-text text-muted">✳ pc에서︎ 회장사는 586px X 165px 사이즈로 노출됩니다.</small><br />
                    <small id="picture_help" class="form-text text-muted">✳ pc에서︎ 부회장사는 282px X 80px 사이즈로 노출됩니다.</small><br />
                    <small id="picture_help" class="form-text text-muted">✳ pc에서︎ 임원사는 160px X 60px 사이즈로 노출됩니다.</small><br />
                    <small id="picture_help" class="form-text text-muted">✳ pc에서︎ 일반 회원사는 160px X 54px 사이즈로 노출됩니다.</small><br />
                    <small id="picture_help" class="form-text text-muted">✳ 로고2는 팝업에 노출됩니다.</small>
                </td>
            </tr>
            <? for($q=1; $q <= 2; $q++) { ?>
            <tr>
                <td width="15%" class="t_name">로고<?=$q?></td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="file" name="picture<?=$q?>" id="picture<?=$q?>" value="<?=$rowData['picture'.$q]?>" accept=".gif, .jpg, .jpeg, .png, .gif, .bmp" class="d-none" />
                    <input type="hidden" name="picture<?=$q?>_on" id="picture<?=$q?>_on" value="<?=$rowData['picture'.$q]?>" class="form-control" />
                    <input type="hidden" name="picture<?=$q?>_del" value="" />

                    <div class="float-left mr-3 mb-3">
                        <a href="javascript:;" onclick="f_preview_image_delete('<?=$q?>', 'picture','<?=$rowData['logo_path'.$q]?>')"><label class="image_del" id="picture<?=$q?>_del"><i class="mdi mdi-close"></i></label></a>
                        <label for="picture<?=$q?>" class="plus-input" id="picture<?=$q?>_box"><i class="mdi mdi-plus"></i></label>
                    </div>
                    <script type="text/javascript">
                        <!--
                        $('#picture<?=$q?>').on('change', function(e) {
                            f_preview_image_selected2(e, '<?=$q?>', 'picture');
                        });

                        <? if($rowData['logo_path'.$q]) { ?>
                        $('#picture<?=$q?>_del').show();
                        $("#picture<?=$q?>_box").css('border', 'none');
                        $("#picture<?=$q?>_box").html('<img class="rounded-circle" src="<?=$company_logo_img_dir.'/'.$rowData['logo_path'.$q]?>?v=<?=time()?>" onerror="this.src=\'/admin/img/noimg.png\'" />');
                        <? } ?>
                        //-->
                    </script>
                </td>
            </tr>
            <? } ?>
            <tr>
                <td width="15%" class="t_name">업체명</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="com_name" value="<?=$rowData['com_name']?>" class="input" size="90" maxlength="255" />
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">대표명</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="boss_name" value="<?=$rowData['boss_name']?>" class="input" size="30" maxlength="255" />
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">주소</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="adress" value="<?=$rowData['adress']?>" class="input" size="90" maxlength="255" />
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">본사주소</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="head_adress" value="<?=$rowData['head_adress']?>" class="input" size="90" maxlength="255" />
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">기업유형</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="company_type" value="<?=$rowData['company_type']?>" class="input" size="90" maxlength="255" />
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">설립연도</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="number" name="year" placeholder="ex) 2023" min="1500" step="1" value="<?=$rowData['year']?>" size="30" class="input" maxlength="30">
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">매출액</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="take" value="<?=$rowData['take']?>" class="input" size="30" />
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">우주관련 매출액</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="space_take" value="<?=$rowData['space_take']?>" class="input" size="30" />
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">종업원수</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="employer" value="<?=$rowData['employer']?>" class="input" size="30" />
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">R&D 투자규모</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="rnd_scale" value="<?=$rowData['rnd_scale']?>" class="input" size="30" />
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">자본금</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="capital" value="<?=$rowData['capital']?>" class="input" size="30" />
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">연락처</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="contact" value="<?=$rowData['contact']?>" class="input phoneHypen" size="30" />
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">담당자</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="responsible" value="<?=$rowData['responsible']?>" class="input phoneHypen" size="30" />
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">우주산업 참여분야</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="participation" value="<?=$rowData['participation']?>" class="input" size="90" maxlength="255" />
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">홈페이지</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="homepage" value="<?=$rowData['homepage']?>" class="input" size="90" maxlength="255" />
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">홈페이지2</td>
                <td width="85%" class="t_value" colspan="3">
                    <input type="text" name="homepage2" value="<?=$rowData['homepage2']?>" class="input" size="90" maxlength="255" />
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">비전 및 전략</td>
                <td width="85%" class="t_value" colspan="3">
                    <small class="form-text text-muted">✳ cafe24에서 "System(" 단어를 못쓰도록 막고있습니다. 406에러발생. "System (" 관련 에러 발생시 한칸 띄어서 사용 바랍니다.</small>
                    <textarea id="vision" name="vision"><?=(isset($rowData['vision'])) ? stripslashes($rowData['vision']) : ''?></textarea>
                    <script type="text/javascript">
                        var vision = new cheditor();
                        vision.config.editorHeight = '500px';
                        vision.config.editorWidth = '100%';
                        vision.inputForm = 'vision';
                        vision.run();
                    </script>
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">주요사업분야 영역</td>
                <td width="85%" class="t_value" colspan="3">
                    <small class="form-text text-muted">✳ cafe24에서 "System(" 단어를 못쓰도록 막고있습니다. 406에러발생. "System (" 관련 에러 발생시 한칸 띄어서 사용 바랍니다.</small>
                    <textarea id="business" name="business"><?=(isset($rowData['business'])) ? stripslashes($rowData['business']) : ''?></textarea>
                    <script type="text/javascript">
                        var business = new cheditor();
                        business.config.editorHeight = '500px';
                        business.config.editorWidth = '100%';
                        business.inputForm = 'business';
                        business.run();
                    </script>
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">주요고객사</td>
                <td width="85%" class="t_value" colspan="3">
                    <small class="form-text text-muted">✳ cafe24에서 "System(" 단어를 못쓰도록 막고있습니다. 406에러발생. "System (" 관련 에러 발생시 한칸 띄어서 사용 바랍니다.</small>
                    <textarea id="major_customer" name="major_customer"><?=(isset($rowData['major_customer'])) ? stripslashes($rowData['major_customer']) : ''?></textarea>
                    <script type="text/javascript">
                        var major_customer = new cheditor();
                        major_customer.config.editorHeight = '500px';
                        major_customer.config.editorWidth = '100%';
                        major_customer.inputForm = 'major_customer';
                        major_customer.run();
                    </script>
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">주요 기술/제품</td>
                <td width="85%" class="t_value" colspan="3">
                    <small class="form-text text-muted">✳ cafe24에서 "System(" 단어를 못쓰도록 막고있습니다. 406에러발생. "System (" 관련 에러 발생시 한칸 띄어서 사용 바랍니다.</small>
                    <textarea id="products" name="products"><?=(isset($rowData['products'])) ? stripslashes($rowData['products']) : ''?></textarea>
                    <script type="text/javascript">
                        var products = new cheditor();
                        products.config.editorHeight = '500px';
                        products.config.editorWidth = '100%';
                        products.inputForm = 'products';
                        products.run();
                    </script>
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">주요 기술/제품의 장점</td>
                <td width="85%" class="t_value" colspan="3">
                    <small class="form-text text-muted">✳ cafe24에서 "System(" 단어를 못쓰도록 막고있습니다. 406에러발생. "System (" 관련 에러 발생시 한칸 띄어서 사용 바랍니다.</small>
                    <textarea id="product_advantages" name="product_advantages"><?=(isset($rowData['product_advantages'])) ? stripslashes($rowData['product_advantages']) : ''?></textarea>
                    <script type="text/javascript">
                        var product_advantages = new cheditor();
                        product_advantages.config.editorHeight = '500px';
                        product_advantages.config.editorWidth = '100%';
                        product_advantages.inputForm = 'product_advantages';
                        product_advantages.run();
                    </script>
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">주요 우주 관련 프로젝트</td>
                <td width="85%" class="t_value" colspan="3">
                    <small class="form-text text-muted">✳ cafe24에서 "System(" 단어를 못쓰도록 막고있습니다. 406에러발생. "System (" 관련 에러 발생시 한칸 띄어서 사용 바랍니다.</small>
                    <textarea id="projects" name="projects"><?=(isset($rowData['projects'])) ? stripslashes($rowData['projects']) : ''?></textarea>
                    <script type="text/javascript">
                        var projects = new cheditor();
                        projects.config.editorHeight = '500px';
                        projects.config.editorWidth = '100%';
                        projects.inputForm = 'projects';
                        projects.run();
                    </script>
                </td>
            </tr>
            <tr>
                <td width="15%" class="t_name">주요 사업모델</td>
                <td width="85%" class="t_value" colspan="3">
                    <small class="form-text text-muted">✳ cafe24에서 "System(" 단어를 못쓰도록 막고있습니다. 406에러발생. "System (" 관련 에러 발생시 한칸 띄어서 사용 바랍니다.</small>
                    <textarea id="industry" name="industry"><?=(isset($rowData['industry'])) ? stripslashes($rowData['industry']) : ''?></textarea>
                    <script type="text/javascript">
                        var industry = new cheditor();
                        industry.config.editorHeight = '500px';
                        industry.config.editorWidth = '100%';
                        industry.inputForm = 'industry';
                        industry.run();
                    </script>
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
                    <img src="../image/btn_list_l.gif" style="cursor:hand" onclick="document.location='member_company_list.php?page=<?=$page?>';">
                </td>
            </tr>
        </table>
    </form>

<? include "../foot.php"; ?>