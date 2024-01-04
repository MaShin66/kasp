<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php"; ?>
<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/inc/admin_check.php"; ?>
<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/inc/prd_info.php"; ?>
<?
if($save == "ok"){
	//$sql = "update wiz_prdinfo set skin='$skin',purl='$purl', prdcnt='$prdcnt', prdline='$prdline', maintype='$maintype', mainskin='$mainskin', prdname_len='$prdname_len'";
	$sql = "update wiz_prdinfo set skin='$skin'";
	mysql_query($sql) or error(mysql_error());
	complete("수정되었습니다.","prd_config.php");
	exit;
}
?>
<? include "$_SERVER[DOCUMENT_ROOT]/admin/manage/head.php"; ?>
<script Language="Javascript">
<!--
function phpCode(idx){
	var php_code = "&lt;? \$pidx=\""+idx+"\"; include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/prdmain.php\"; // 상품추출 ?&gt;";
	set_ClipBoard(php_code);
}

function delPrdmain(idx) {
	if(confirm("삭제하시겠습니까?")) {
		document.location = "prdmain_save.php?mode=delete&idx="+idx;
	}
}
function viewPrdmain(idx) {
	var url = "prdmain_view.php?pidx=" + idx;
	window.open(url,"ViewPrdmain","height=150, width=470, menubar=no, scrollbars=yes, resizable=yes, toolbar=no, status=no, top=100, left=100");
}
//-->
</script>
			
			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">상품관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 상품관리를 생성합니다.</td>
        </tr>
      </table>
      
			<br><br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 상품관리 생성코드</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td class="t_name">

                <?
                $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/product.php\";     // 상품관리 ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode1(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><b><?=$php_code?></b></font>&nbsp; &nbsp;
                <a href="javascript:copy_Phpcode1();"><img src="../image/btn_codecopy.gif" border="0"></a>


                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table><br>
      <?php
      /*
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <form name="frm" action="<?=$PHP_SELF?>" method="post">
      <input type="hidden" name="save" value="ok">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td width="20%" height="25" align="left" class="t_name">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;스킨</td>
                <td class="t_value" colspan="3">
                <select name="skin">
                <?
                $dh = opendir("../../product/skin");
                while(($file = readdir($dh)) !== false){
                	if($file != "." && $file != ".."){
                		$file_list[] = $file;
                	}
                }
                sort ($file_list); reset ($file_list);
                for($ii=0;$ii<count($file_list);$ii++){
                ?>
                <option value="<?=$file_list[$ii]?>"><?=$file_list[$ii]?></option>
                <?
                }
                ?>
                </select>
                <script language="javascript">
                <!--
                  skin = document.frm.skin;
                  for(ii=0; ii<skin.length; ii++){
                     if(skin.options[ii].value == "<?=$prd_info[skin]?>")
                        skin.options[ii].selected = true;
                  }
                -->
                </script>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      
      <br>
      <table align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
          	<input type="image" src="../image/btn_confirm_l.gif"> &nbsp; 
          	<img src="../image/btn_cancel_l.gif" style="cursor:hand" onClick="history.go(-1);">
          </td>
        </tr>
      </form>
      </table>
      <br>
      */
      ?>
      
      <br>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="9d9d9d">
        <tr>
          <td width="5" height="5"><img src="../image/check_left_top.gif"></td>
          <td width="100%"></td>
          <td width="5" height="5"><img src="../image/check_right_top.gif"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
            <tr>
              <td>
              	<img src="../image/check_tit.gif" width="75" height="19" align="absmiddle">
              	&nbsp; 기업홈페이지에서 자주사용되는 상품관리 기능을 제공합니다.
              </td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 스킨위치 : /admin/product/skin<br>
            	<font color="#000000"><b>- 특정 상품분류 열기</b></font><br>
              &nbsp; &nbsp;방법1 : 생성코드 삽입시 코드($catcode)를 포함합니다.  <b>예)&lt;? $catcode="100000"; include "$_SERVER[DOCUMENT_ROOT]..."</b><br>
          		&nbsp; &nbsp;방법2 : 페이지 링크시 분류코드(catcode=100000) 를 추가합니다. <b>예) /product.php?catcode=1000000</b><br>
          		- 분류코드는 "상품관리 > 상품분류 > 해당 분류 클릭 > 분류코드" 에 나옵니다.
              </td>
            </tr>
          </table></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="5" height="5"><img src="../image/check_left_bottom.gif" width="5" height="5" /></td>
          <td></td>
          <td width="5" height="5"><img src="../image/check_right_bottom.gif" width="5" height="5" /></td>
        </tr>
      </table>

<? include "$_SERVER[DOCUMENT_ROOT]/admin/manage/foot.php"; ?>
