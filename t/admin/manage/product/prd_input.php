<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include_once "../../inc/prd_info.php"; ?>
<?
// 업로드 위치
$imgpath = "../../data/product";

// 검색 파라미터
$param = "page=$page&dep_code=$dep_code&dep2_code=$dep2_code&dep3_code=$dep3_code&searchopt=$searchopt&searchkey=$searchkey";

// 상품정보
if($mode == "") $mode = "insert";
if($mode == "insert"){

	$catcode01 = $dep_code;
	$catcode02 = $dep_code.$dep2_code;
	$catcode03 = $dep_code.$dep2_code.$dep3_code;

}else if($mode == "update"){

	$sql = "select wp.*, wc.idx, wc.catcode from wiz_product wp, wiz_cprelation wc where wp.prdcode = '$prdcode' and wp.prdcode = wc.prdcode";
	$result = mysql_query($sql) or error(mysql_error());
	$prd_info = mysql_fetch_array($result);
	$page_info[shortexp] = stripslashes($page_info[shortexp]);
	$page_info[content] = stripslashes($page_info[content]);

	$relidx = $prd_info[idx];
	$catcode01 = substr($prd_info[catcode],0,2);
	$catcode02 = substr($prd_info[catcode],0,4);
	$catcode03 = substr($prd_info[catcode],0,6);

}
?>
<? include "../head.php"; ?>

<script language="JavaScript" type="text/javascript">
<!--
  var loding = false;
  var prd_class = new Array();
<?
   $no = 0;
   $sql = "select catcode, catname, depthno from wiz_category order by priorno01, priorno02, priorno03 asc";
   $result = mysql_query($sql) or error(mysql_error());
   $total = mysql_num_rows($result);
   while($row = mysql_fetch_object($result)){

      $code01 = substr($row->catcode,0,2);
      $code02 = substr($row->catcode,0,4);
      $code03 = substr($row->catcode,0,6);

      if($row->depthno == 1){ $catcode = $code01; $parent = 0; }
      if($row->depthno == 2){ $catcode = $code02; $parent = $code01; }
      if($row->depthno == 3){ $catcode = $code03; $parent = $code02; }
?>

  prd_class[<?=$no?>] = new Array();
  prd_class[<?=$no?>][0] = "<?=$catcode?>";
  prd_class[<?=$no?>][1] = "<?=$row->catname?>";
  prd_class[<?=$no?>][2] = "<?=$parent?>";
  prd_class[<?=$no?>][3] = "<?=$row->depthno?>";

<?
   	$no++;
   }
?>
var tno = <?=$total?>;

function setClass01(){

  var arrayClass = eval("document.frm.class01");
  var arrayClass1 = eval("document.frm.class02");
  var arrayClass2 = eval("document.frm.class03");

  arrayClass.options[0] = new Option(":: 대분류 ::","");
  arrayClass1.options[0] = new Option(":: 중분류 ::","");
  arrayClass2.options[0] = new Option(":: 소분류 ::","");

  for(no=0,sno=1 ; no < tno ; no++){
	  if(prd_class[no][3]=='1'){
		 arrayClass.options[sno] = new Option(prd_class[no][1],prd_class[no][0]);
		 sno++;
	  }
  }
}

function changeClass01(){

  var arrayClass = eval("document.frm.class01");
  var arrayClass1 = eval("document.frm.class02");
  var arrayClass2 = eval("document.frm.class03");

  var selidx = arrayClass.selectedIndex;
  var selvalue = arrayClass.options[selidx].value;

  arrayClass1.options.length=0;
  arrayClass2.options.length=0;
  arrayClass1.options[0] = new Option(":: 중분류 ::","");
  arrayClass2.options[0] = new Option(":: 소분류 ::","");

  for(no=0,sno=1 ; no < tno ; no++){
	  if(prd_class[no][3]=='2' && prd_class[no][2]==selvalue){
		 arrayClass1.options[sno] = new Option(prd_class[no][1],prd_class[no][0]);
		 sno++;
	  }
  }

}

function changeClass02(){

  var arrayClass1 = eval("document.frm.class02");
  var arrayClass2 = eval("document.frm.class03");

  var selidx = arrayClass1.selectedIndex;
  var selvalue = arrayClass1.options[selidx].value;

  arrayClass2.options.length=0;
  arrayClass2.options[0] = new Option(":: 소분류 ::","");

  for(no=0,sno=1 ; no < tno ; no++){
	  if(prd_class[no][3]=='3' && prd_class[no][2]==selvalue){
		 arrayClass2.options[sno] = new Option(prd_class[no][1],prd_class[no][0]);
		 sno++;
	  }
  }

}

function changeClass03(){
}

// 상품카테고리 설정
function setCategory(){

  var arrayClass01 = eval("document.frm.class01");
  var arrayClass02 = eval("document.frm.class02");
  var arrayClass03 = eval("document.frm.class03");

  for(no=1; no < arrayClass01.length; no++){
    if(arrayClass01.options[no].value == '<?=$catcode01?>'){
      arrayClass01.options[no].selected = true;
      changeClass01();
    }
  }

  for(no=1; no < arrayClass02.length; no++){
    if(arrayClass02.options[no].value == '<?=$catcode02?>'){
      arrayClass02.options[no].selected = true;
      changeClass02();
    }
  }

  for(no=1; no < arrayClass03.length; no++){
    if(arrayClass03.options[no].value == '<?=$catcode03?>')
      arrayClass03.options[no].selected = true;
  }

}

function inputCheck(frm){

  if(loding == false){
   	alert("상품정보를 가져오고 있습니다. 잠시후 재시도 하세요");
   	return false;
  }
	if(frm.prdname.value == ""){
		alert("상품명을 입력하세요");
		frm.prdname.focus();
		return false;
	}
	content.outputBodyHTML();
}

//해당 이미지를 삭제한다.
function deleteImage(prdcode, prdimg, imgpath){
	if(imgpath == ""){
		alert("삭제할 이미지가 없습니다.");
		return;
	}else{
	if(confirm("이미지를 삭제하시겠습니까?"))
		document.location = "prd_save.php?mode=delete_image&prdcode="+prdcode+"&prdimg="+prdimg+"&imgpath="+imgpath;
	}
	return;
}

function prdlayCheck(){
	<?
	for($ii = 2; $ii <= $prdimg_max; $ii++) {
		if(@file($imgpath."/".$prd_info[prdimg_S.$ii])) echo "document.frm.prdlay_check".$ii.".checked = true; prdlay".$ii.".style.display='';";
	}
	?>
}

function lodingComplete(){
	loding = true;
}

function prdCategory(){
  var url = "prd_catlist.php?prdcode=<?=$prdcode?>";
  window.open(url, "prdCategory", "height=330, width=560, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, left=150, top=100");
}

function prdIcon(){
	var url = "prd_icon.php";
	window.open(url, "prdIcon", "height=250, width=450, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, left=150, top=100");
}

function setImgsize(){
	var url = "prd_imgsize.php";
   window.open(url, "setImgsize", "height=230, width=300, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, left=150, top=100");
}

//상품이동
function movePrd(){

	selvalue = "<?=$prdcode?>";

	if(selvalue == ""){
		alert("이동할 상품을 선택하세요.");
		return false;
	}else{
		var uri = "prd_move.php?selvalue=" + selvalue;
		window.open(uri,"movePrd","width=300,height=150");
	}
}

// 상품복사
function copyPrd(){
	selvalue = "<?=$prdcode?>";

	if(selvalue == ""){
		alert("복사할 상품을 선택하세요.");
		return false;
	}else{
		var uri = "prd_copy.php?selvalue=" + selvalue;
		window.open(uri,"copyPrd","width=300,height=150,resizable=yes");
	}
}

//-->
</script>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="setClass01();setCategory();prdlayCheck();lodingComplete();">

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">상품관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">상품 검색/추가/수정/삭제 관리합니다.</td>
        </tr>
      </table>

      <br>
	  <form name="frm" action="prd_save.php?<?=$param?>" method="post" enctype="multipart/form-data" onSubmit="return inputCheck(this);">
      <input type="hidden" name="tmp">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <input type="hidden" name="relidx" value="<?=$relidx?>">
      <input type="hidden" name="prdcode" value="<?=$prdcode?>">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td width="15%" class="t_name">상품분류</td>
                <td width="85%" class="t_value" colspan="3">
                <select name="class01" onChange="changeClass01();">
                </select>
                <select name="class02" onChange="changeClass02();">
                </select>
                <select name="class03" onChange="changeClass03();">
                </select>
                </td>
              </tr>
              <tr>
                <td class="t_name">상품명</td>
                <td colspan="3" class="t_value">
                	<input name="prdname" type="text" value="<?=$prd_info[prdname]?>" size="60" class="input">&nbsp;
                	<input type="checkbox" name="recom" value="Y" <? if($prd_info[recom] == "Y") echo "checked"; ?>>추천상품
                </td>
              </tr>
              <tr>
                <td class="t_name">상품코드</td>
                <td colspan="3" class="t_value">
                	<input name="prdnum" type="text" value="<?=$prd_info[prdnum]?>" size="30" class="input">
                </td>
              </tr>
              <tr>
                <td class="t_name">상품가격</td>
                <td colspan="3" class="t_value">
                	<input name="prdprice" type="text" value="<?=$prd_info[prdprice]?>" size="30" class="input">
                </td>
              </tr>
              <tr>
                <td class="t_name">상품정보</td>
                <td colspan="3" class="t_value">


                	<table border="0" cellspacing="5" cellpadding="0">
                		<tr>
                			<td></td>
                			<td>상품가격</td>
                			<td>1,000원 (예시)</td>
                		</tr>
                		<tr>
                			<td>1.</td>
                			<td><input name="info_name1" type="text" value="<?=$prd_info[info_name1]?>" size="15" class="input"></td>
                			<td><input name="info_value1" type="text" value="<?=$prd_info[info_value1]?>" size="20" class="input"></td>
                			<td width="60" align="right">6.</td>
                			<td><input name="info_name6" type="text" value="<?=$prd_info[info_name6]?>" size="15" class="input"></td>
                			<td><input name="info_value6" type="text" value="<?=$prd_info[info_value6]?>" size="20" class="input"></td>
                		</tr>
                		<tr>
                			<td>2.</td>
                			<td><input name="info_name2" type="text" value="<?=$prd_info[info_name2]?>" size="15" class="input"></td>
                			<td><input name="info_value2" type="text" value="<?=$prd_info[info_value2]?>" size="20" class="input"></td>
                			<td align="right">7.</td>
                			<td><input name="info_name7" type="text" value="<?=$prd_info[info_name7]?>" size="15" class="input"></td>
                			<td><input name="info_value7" type="text" value="<?=$prd_info[info_value7]?>" size="20" class="input"></td>
                		</tr>
                		<tr>
                			<td>3.</td>
                			<td><input name="info_name3" type="text" value="<?=$prd_info[info_name3]?>" size="15" class="input"></td>
                			<td><input name="info_value3" type="text" value="<?=$prd_info[info_value3]?>" size="20" class="input"></td>
                			<td align="right">8.</td>
                			<td><input name="info_name8" type="text" value="<?=$prd_info[info_name8]?>" size="15" class="input"></td>
                			<td><input name="info_value8" type="text" value="<?=$prd_info[info_value8]?>" size="20" class="input"></td>
                		</tr>
                		<tr>
                			<td>4.</td>
                			<td><input name="info_name4" type="text" value="<?=$prd_info[info_name4]?>" size="15" class="input"></td>
                			<td><input name="info_value4" type="text" value="<?=$prd_info[info_value4]?>" size="20" class="input"></td>
                			<td align="right">9.</td>
                			<td><input name="info_name9" type="text" value="<?=$prd_info[info_name9]?>" size="15" class="input"></td>
                			<td><input name="info_value9" type="text" value="<?=$prd_info[info_value9]?>" size="20" class="input"></td>
                		</tr>
                		<tr>
                			<td>5.</td>
                			<td><input name="info_name5" type="text" value="<?=$prd_info[info_name5]?>" size="15" class="input"></td>
                			<td><input name="info_value5" type="text" value="<?=$prd_info[info_value5]?>" size="20" class="input"></td>
                			<td align="right">10.</td>
                			<td><input name="info_name10" type="text" value="<?=$prd_info[info_name10]?>" size="15" class="input"></td>
                			<td><input name="info_value10" type="text" value="<?=$prd_info[info_value10]?>" size="20" class="input"></td>
                		</tr>
                	</table>


                </td>
              </tr>
              <tr>
                <td class="t_name">상품사진</td>
                <td colspan="3" class="t_value">

					      <? include "./prd_img.php"; ?>

                </td>
              </tr>
              <tr>
                <td height="25" class="t_name">첨부파일</td>
                <td class="t_value" colspan="3">
                	<table border="0" cellspacing="5" cellpadding="0">
                		<tr>
                			<td>1.</td>
                			<td>
                				<input type="file" name="upfile1" class="input">
				                <? if(@file($imgpath."/".$prd_info[upfile1])){ ?>
				                <input type="checkbox" name="delupfile[]" value="upfile1">삭제 (<a href="../../data/product/<?=$prd_info[upfile1]?>" target="_blank"><?=$prd_info[upfile1_name]?></a>)
				                <? } ?>
                			</td>
                		</tr>
                		<tr>
                			<td>2.</td>
                			<td>
                				<input type="file" name="upfile2" class="input">
				                <? if(@file($imgpath."/".$prd_info[upfile2])){ ?>
				                <input type="checkbox" name="delupfile[]" value="upfile2">삭제 (<a href="../../data/product/<?=$prd_info[upfile2]?>" target="_blank"><?=$prd_info[upfile2_name]?></a>)
				                <? } ?>
                			</td>
                		</tr>
                		<tr>
                			<td>3.</td>
                			<td>
                				<input type="file" name="upfile3" class="input">
				                <? if(@file($imgpath."/".$prd_info[upfile3])){ ?>
				                <input type="checkbox" name="delupfile[]" value="upfile3">삭제 (<a href="../../data/product/<?=$prd_info[upfile3]?>" target="_blank"><?=$prd_info[upfile3_name]?></a>)
				                <? } ?>
                			</td>
                		</tr>
                		<tr>
                			<td>4.</td>
                			<td>
                				<input type="file" name="upfile4" class="input">
				                <? if(@file($imgpath."/".$prd_info[upfile4])){ ?>
				                <input type="checkbox" name="delupfile[]" value="upfile4">삭제 (<a href="../../data/product/<?=$prd_info[upfile4]?>" target="_blank"><?=$prd_info[upfile4_name]?></a>)
				                <? } ?>
                			</td>
                		</tr>
                		<tr>
                			<td>5.</td>
                			<td>
                				<input type="file" name="upfile5" class="input">
				                <? if(@file($imgpath."/".$prd_info[upfile5])){ ?>
				                <input type="checkbox" name="delupfile[]" value="upfile5">삭제 (<a href="../../data/product/<?=$prd_info[upfile5]?>" target="_blank"><?=$prd_info[upfile5_name]?></a>)
				                <? } ?>
                			</td>
                		</tr>
                	</table>
                </td>
              </tr>
              <tr>
                <td height="25" class="t_name">관련상품</td>
                <td class="t_value" colspan="3">
			            <table width="100%" border="0" cellspacing="1" cellpadding="2" class="t_style">
			              <tr>
			                <td width="100%" class="t_value">
			                <iframe width="100%" height="95" frameborder="0" src="prd_relation.php?mode=<?=$mode?>&prdcode=<?=$prdcode?>"></iframe>
			                </td>
			              </tr>
			            </table>
                </td>
              </tr>
              <tr>
                <td height="25" class="t_name">상품간단설명</td>
                <td class="t_value" colspan="3">
                <textarea name="shortexp" rows="5" cols="50" style="width:98%" class="textarea"><?=$prd_info[shortexp]?></textarea>
                </td>
              </tr>
              <tr>
                <td height="25" class="t_name">상품상세정보</td>
                <td class="t_value" colspan="3">
                <?
			          $edit_content = $prd_info[content];
			          include "../../webedit/WIZEditor.html";
			          ?>
                </td>
              </tr>
              <!--
              <tr>
                <td height="25" class="t_name">기타정보1</td>
                <td class="t_value" colspan="3">
                <textarea name="addinfo1" rows="5" cols="60" style="width:100%" class="textarea"><?=$prd_info[addinfo1]?></textarea>
                </td>
              </tr>
              <tr>
                <td height="25" class="t_name">기타정보2</td>
                <td class="t_value" colspan="3">
                <textarea name="addinfo2" rows="5" cols="60" style="width:100%" class="textarea"><?=$prd_info[addinfo2]?></textarea>
                </td>
              </tr>
              <tr>
                <td height="25" class="t_name">기타정보3</td>
                <td class="t_value" colspan="3">
                <textarea name="addinfo3" rows="5" cols="60" style="width:100%" class="textarea"><?=$prd_info[addinfo3]?></textarea>
                </td>
              </tr>
              <tr>
                <td height="25" class="t_name">기타정보4</td>
                <td class="t_value" colspan="3">
                <textarea name="addinfo4" rows="5" cols="60" style="width:100%" class="textarea"><?=$prd_info[addinfo4]?></textarea>
                </td>
              </tr>
              <tr>
                <td height="25" class="t_name">기타정보5</td>
                <td class="t_value" colspan="3">
                <textarea name="addinfo5" rows="5" cols="60" style="width:100%" class="textarea"><?=$prd_info[addinfo5]?></textarea>
                </td>
              </tr>
              -->
            </table>
          </td>
        </tr>
      </table>

      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr>
      		<td align="center">
		      	<input type="image" src="../image/btn_confirm_l.gif"> &nbsp;
		      	<img src="../image/btn_list_l.gif" style="cursor:hand" onClick="document.location='prd_list.php?<?=$param?>';">
			    </td>
      		<!--td width="33%" align="right">
          	<input type="button" value="상품이동" onClick="movePrd();" class="sbtn">
            <input type="button" value="상품복사" onClick="copyPrd();" class="sbtn">
          </td-->
      	</tr>
      </table>
	  </form>

<? include "../foot.php"; ?>
