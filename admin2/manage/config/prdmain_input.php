<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include "../head.php"; ?>

<?
$basic_ex = "<table border='0' cellspacing='0' cellpadding='0'>\\n<tr>\\n[LOOP]\\n<td>\\n  <table border='0' cellspacing='0' cellpadding='4'>\\n    <tr>\\n      <td rowspan='2'>\\n      	<a href='{PRDLINK}'><img src='{PRDIMG}' width='78' height='78' border='0'></a>\\n      </td>\\n      <td><strong><a href='{PRDLINK}'>{PRDNAME}</a></strong><br>\\n      <span class='s01'><a href='{PRDLINK}'>{PRDEXP}</a></span>\\n      </td>\\n    </tr>\\n  </table>\\n</td>\\n[/LOOP]\\n</tr>\\n</table>";

if(!strcmp($mode, "insert")) {
	$prd_info[prdcnt] = 4;
	$prd_info[prdline] = 0;
	$prd_info[prdname_len] = 30;
	$prd_info[prdexp_len]	 = 30;
	$prd_info[mainskin] = str_replace("\\n", "\n", $basic_ex);
} else {
	
	$mode = "update";

	$sql = "select * from wiz_prdmain where idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$total = mysql_num_rows($result);
	$prd_info = mysql_fetch_array($result);
	$prd_info[mainskin] = stripslashes($prd_info[mainskin]);
}

?>
      <script language="javascript">
      <!--
      function inputCheck(frm){

      	if(frm.prdname_len.value != "" && !check_Num(frm.prdname_len.value)){
      		alert("상품명 글자수는 숫자만 입력하세요");
      		frm.prdname_len.focus();
      		return false;
      	}
      	if(frm.prdcnt.value != "" && !check_Num(frm.prdcnt.value)){
      		alert("상품수는 숫자만 입력하세요");
      		frm.prdcnt.focus();
      		return false;
      	}
      	
      	if(frm.prdline.value != "" && !check_Num(frm.prdline.value)){
      		alert("줄바꿈 상품수는 숫자만 입력하세요");
      		frm.prdline.focus();
      		return false;
      	}
      	if(frm.mainskin.value == ""){
      		alert("상품스킨을 입력하세요");
      		frm.mainskin.focus();
      		return false;
      	}

      }

      function setSkin(frm, skin) {

      	if(skin == "DB") frm.mainskin.value = frm.tmp_skin.value;
      	if(skin == "BASIC") frm.mainskin.value = "<?=$basic_ex?>";

      }
      -->
      </script>
      
      <table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">상품관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">상품추출 스킨 및 기능을 설정합니다.</td>
        </tr>
      </table>
      
			<br><br>
	<form name="frm" action="prdmain_save.php" method="post" enctype="multipart/form-data" onSubmit="return inputCheck(this);">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <input type="hidden" name="idx" value="<?=$idx?>">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr> 
                <td class="t_name">추출상품</td>
                <td class="t_value" colspan="3">
                  <input type="radio" name="maintype" value="wdate" <? if($prd_info[maintype] == "" || $prd_info[maintype] == "wdate") echo "checked"; ?>>최근등록상품 
                  <input type="radio" name="maintype" value="recom" <? if($prd_info[maintype] == "recom") echo "checked"; ?>>추천상품
                </td>
              </tr>
              <tr>
                <td width="15%" class="t_name">상품명 글자수</td>
                <td width="35%" class="t_value">
                  <input name="prdname_len" type="text" value="<?=$prd_info[prdname_len]?>" class="input">
                </td>
                <td width="15%" class="t_name">간단설명 글자수</td>
                <td width="35%" class="t_value">
                  <input name="prdexp_len" type="text" value="<?=$prd_info[prdexp_len]?>" class="input">
                </td>
              </tr>
              <tr> 
                <td class="t_name">상품수</td>
                <td class="t_value">
                  <input name="prdcnt" type="text" value="<?=$prd_info[prdcnt]?>" class="input">
                </td>
                <td class="t_name">줄바꿈 상품수</td>
                <td class="t_value">
                  <input name="prdline" type="text" value="<?=$prd_info[prdline]?>" class="input">
                </td>
              </tr>
              <tr>
                <td width="150" height="10" class="t_name">예제소스적용</td>
                <td class="t_value" colspan="3">
                	<input type="radio" name="skin_ex" value="DB" onClick="setSkin(this.form, this.value)" checked> 기존스킨
                	<input type="radio" name="skin_ex" value="BASIC" onClick="setSkin(this.form, this.value)"> 일반스킨
                </td>
              </tr>
              <tr> 
                <td height="10" class="t_name">상품스킨</td>
                <td class="t_value" colspan="3">
                  <textarea name="mainskin" rows="12" cols="60" class="textarea" style="width:96%"><?=$prd_info[mainskin]?></textarea><br><br>
                  <textarea name="tmp_skin" rows="12" cols="60" class="textarea" style="width:100%;display:none"><?=$prd_info[mainskin]?></textarea>
                  <font color="red">반복되는 부분을 [LOOP]와 [/LOOP]사이에 위치하게 합니다.</font><br><br>
                  <table width="100%" border="0" cellpadding="5" cellspacing="3" class="e_style">
                    <tr>
                      <td bgcolor="#FFFFFF">
                        <table width="100%" border="0">
                        <tr><td><b>{PRDNAME}</b> 상품명 &nbsp; <b>{PRDPRICE}</b> 상품가격&nbsp;  <b>{PRDCODE}</b> 상품코드 &nbsp; <b>{PRDIMG}</b> 상품사진</td>
                        	<tr><td><b>{PRDLINK}</b> 이미지링크 <b>{PRDEXP}</b> 상품간단설명<td>
                        <tr><td height="5"></td></tr>
                        <tr><td><b>{PRDIMG}</b> : &lt;img src="{PRDIMG}" width="100" height="100"&gt; 태그를 이용해 이미지 사이즈 조정</td></tr>
                        <tr><td><b>{PRDLINK}</b> : &lt;a href="{PRDLINK}"&gt;&lt;img src="{PRDIMG}" width="100" height="100"&gt;&lt;/a&gt; 해당 상품으로 이동</td></tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                  
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
          	<img src="../image/btn_list_l.gif" style="cursor:hand" onClick="document.location='prdmain_config.php';">
          </td>
        </tr>
      </table>
	</form>
      
<? include "../foot.php"; ?>
