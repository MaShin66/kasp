<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<?
$param = "dep_code=$dep_code&dep2_code=$dep2_code&dep3_code=$dep3_code&searchopt=$searchopt&searchkey=$searchkey";
?>
<? include "../head.php"; ?>

<script language="JavaScript" type="text/javascript">
<!--

function catChange(form, idx){
   if(idx == "1"){
      form.dep2_code.options[0].selected = true;
      form.dep3_code.options[0].selected = true;
   }else if(idx == "2"){
      form.dep3_code.options[0].selected = true;
   }
   	form.page.value = 1;
   	form.submit();
}

function delConfirm(prdcode){
	if(confirm("삭제하시겠습니까?")){
		document.location = "prd_save.php?mode=delete&prdcode=" + prdcode + "&<?=$param?>";
	}
}

// 체크박스 전체선택
function selectAll(){

	var i;
	for(i=0;i<document.forms.length;i++){
		if(document.forms[i].prdcode != null){
			if(document.forms[i].select_checkbox){
				document.forms[i].select_checkbox.checked = true;
			}
		}
	}
	return;
}

// 체크박스 선택해제
function selectCancel(){
	var i;
	for(i=0;i<document.forms.length;i++){
		if(document.forms[i].select_checkbox){
			if(document.forms[i].prdcode != null){
				document.forms[i].select_checkbox.checked = false;
			}
		}
	}
	return;
}

// 체크박스선택 반전
function selectReverse(form){
		
	if(form.select_tmp.checked){
		selectAll();
	}else{
		selectCancel();
	}
}

// 체크박스 선택리스트
function selectValue(){
	var i;
	var selvalue = "";
	for(i=0;i<document.forms.length;i++){
		if(document.forms[i].prdcode != null){
			if(document.forms[i].select_checkbox){
				if(document.forms[i].select_checkbox.checked)
					selvalue = selvalue + document.forms[i].prdcode.value + "|";
				}
			}
	}
	return selvalue;
}

//선택회원 삭제
function prdDelete(){

	selvalue = selectValue();

	if(selvalue == ""){
		alert("삭제할 상품을 선택하세요.");
		return false;
	}else{
		if(confirm("선택한 상품을 정말 삭제하시겠습니까?")){
			document.location = "prd_save.php?mode=delete&selvalue=" + selvalue;
		}
	}

}

//상품이동
function movePrd(){
	selvalue = selectValue();

	if(selvalue == ""){
		alert("이동할 상품을 선택하세요.");
		return false;
	}else{
		var uri = "prd_move.php?selvalue=" + selvalue;
		window.open(uri,"movePrd","width=350,height=150");
	}
}

// 상품복사
function copyPrd(){
	selvalue = selectValue();
	if(selvalue == ""){
		alert("복사할 상품을 선택하세요.");
		return false;
	}else{
		var uri = "prd_copy.php?selvalue=" + selvalue;
		window.open(uri,"copyPrd","width=350,height=150,resizable=yes");
	}
}

//-->
</script>

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">상품관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">상품 검색/추가/수정/삭제 관리합니다.</td>
        </tr>
      </table>
      
      <br>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <form name="searchForm" action="<?=$PHP_SELF?>" method="get">
      <input type="hidden" name="page" value="<?=$page?>">
        <tr>
          <td bgcolor="ffffff">
          <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
          <tr>
          <td width="15%" class="t_name">상품분류</td>
          <td width="85%" class="t_value">
          	
          	<select name="dep_code" onChange="catChange(this.form,'1');">
            <option value=''>:: 대분류 :: 
            <?
            $sql = "select substring(catcode,1,2) as catcode, catname from wiz_category where depthno = 1 order by priorno01 asc";
            $result = mysql_query($sql) or error(mysql_error());
            while($row = mysql_fetch_object($result)){
               if($row->catcode == $dep_code)
                  echo "<option value='$row->catcode' selected>$row->catname";
               else
                  echo "<option value='$row->catcode'>$row->catname";
            }
            ?>
            </select>
          	<select name="dep2_code" onChange="catChange(this.form,'2');" class="select">
            <option value=''> :: 중분류 :: 
            <?
            if($dep_code != ''){
               $sql = "select substring(catcode,3,2) as catcode, catname from wiz_category where depthno = 2 and catcode like '$dep_code%' order by priorno02 asc";
               $result = mysql_query($sql) or error(mysql_error());
               while($row = mysql_fetch_object($result)){
                  if($row->catcode == $dep2_code)
                     echo "<option value='$row->catcode' selected>$row->catname";
                  else
                     echo "<option value='$row->catcode'>$row->catname";
               }
            }
            ?>
            </select>
            <select name="dep3_code" onChange="catChange(this.form,'3');" class="select">
            <option value=''> :: 소분류 :: 
            <?
            if($dep_code != '' && $dep2_code != ''){
               $sql = "select substring(catcode,5,2) as catcode, catname from wiz_category where depthno = 3 and catcode like '$dep_code$dep2_code%' order by  priorno03 asc";
               $result = mysql_query($sql) or error(mysql_error());
               while($row = mysql_fetch_object($result)){
                  if($row->catcode == $dep3_code)
                     echo "<option value='$row->catcode' selected>$row->catname";
                  else
                     echo "<option value='$row->catcode'>$row->catname";
               }
            }
            ?>
            </select>&nbsp;
            <input type="checkbox" name="recom" value="Y" <? if($recom == "Y") echo "checked"; ?>>추천상품
          </td>
        	</tr>
          <tr>
          <td class="t_name">조건검색</td>
          <td class="t_value">
          	
          	<table border="0" cellspacing="0" cellpadding="1">
          	<tr>
          	<td>
            <select name="searchopt" class="select">
            <option value="prdnum" <? if($searchopt == "prdnum") echo "selected"; ?>>상품코드
            <option value="prdname" <? if($searchopt == "prdname") echo "selected"; ?>>상품명
            </select>
            </td>
            <td>
            <input type="text" name="searchkey" value="<?=$searchkey?>" class="input">
            </td>
            <td>
            <input type="image" src="../image/btn_search.gif" align="absmiddle">
            </td>
            </table>
            <script language="javascript">
            searchopt = document.searchForm.searchopt;
            for(ii=0; ii<searchopt.length; ii++){
              if(searchopt.options[ii].value == "<?=$searchopt?>")
                searchopt.options[ii].selected = true;
            }
            </script>
          </td>
        	</tr>
          </table>
          </td>
        </tr>
      </form>
      </table>
      <?
				$sql = "select count(prdcode) as all_total from wiz_product";
				$result = mysql_query($sql) or error(mysql_error());
				$row = mysql_fetch_object($result);
				$all_total = $row->all_total;
			
				if($dep_code != "") $catcode_sql = " and wc.catcode like '$dep_code$dep2_code$dep3_code%' ";
        if($searchkey != "") $searchkey_sql = " and wp.$searchopt like '%$searchkey%' ";
        if($recom != "") $recom_sql = " and wp.recom = 'Y' ";
      	$sql = "select distinct wp.prior, wp.prdcode,wp.prdnum,wp.prdname,wp.prdimg_R from wiz_product wp, wiz_cprelation wc where wp.prdcode != '' $catcode_sql $searchkey_sql $recom_sql and  wc.prdcode = wp.prdcode order by prior desc, prdcode desc";
      	$result = mysql_query($sql) or error(mysql_error());
      	$total = mysql_num_rows($result);
      ?>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr><td height="10"></td></tr>
      </table> 
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>총 상품수 : <b><?=$all_total?></b> , 검색 상품수 : <b><?=$total?></b></td>
          <td align="right">
          <img src="../image/btn_prdadd.gif" style="cursor:hand" onClick="document.location='prd_input.php?mode=insert';">
          </td>
        </tr>
      </table> 
      <?
        $rows = 20;
        $lists = 5;
       	$page_count = ceil($total/$rows);
       	if(!$page || $page > $page_count) $page = 1;
       	$start = ($page-1)*$rows;
       	$no = $total-$start;

      ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<form>
      	<tr><td class="t_rd" colspan=20></td></tr>
        <tr class="t_th">
        	<th width="5%"><input type="checkbox" name="select_tmp" onClick="selectReverse(this.form)"></th>
          <th width="5%">번호</th>
          <th>상품명</th>
          <th width="10%">상품코드</th>
          <th width="10%">진열순서</th>
          <th width="15%">기능</th>
        </tr>
        <tr><td class="t_rd" colspan=20></td></tr>
        </form>
			<?
				if($dep_code != "") $catcode_sql = " and wc.catcode like '$dep_code$dep2_code$dep3_code%' ";
        if($searchkey != "") $searchkey_sql = " and wp.$searchopt like '%$searchkey%' ";
        if($recom != "") $recom_sql = " and wp.recom = 'Y' ";
      	$sql = "select distinct wp.prior, wp.prdcode,wp.prdnum,wp.prdname,wp.prdimg_R from wiz_product wp, wiz_cprelation wc where wp.prdcode != '' $catcode_sql $searchkey_sql $recom_sql and  wc.prdcode = wp.prdcode order by prior desc, prdcode desc limit $start, $rows";
      	$result = mysql_query($sql) or error(mysql_error());
      	
			while($row = mysql_fetch_object($result)){
				$row->content = str_replace("\n","",$row->content);
			?>
			  <form name="frm<?=$no?>">
        <input type="hidden" name="prdcode" value="<?=$row->prdcode?>">
        <tr> 
        	<td height="30" align="center"><input type="checkbox" name="select_checkbox"></td>
          <td height="52" align="center"><?=$no?></td>
          <td style="padding-left:20px">
          	<img src="../../data/product/<?=$row->prdimg_R?>" align="absmiddle" width="50" height="50"> 
          	<a href="prd_input.php?mode=update&prdcode=<?=$row->prdcode?>&page=<?=$page?>&<?=$param?>"><?=$row->prdname?></a>
          </td>
          <td align="center"><?=$row->prdnum?></td>
          <td align="center">
            <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><a href="prd_save.php?mode=prior&posi=upup&prdcode=<?=$row->prdcode?>&prior=<?=$row->prior?>&page=<?=$page?>&<?=$param?>"><img src="../image/upup_icon.gif" border="0" alt="10단계 위로"></a></td>
              <td width="4"></td>
              <td></td>
            </tr>
            <tr><td height="4"></td></tr>
            <tr>
              <td><a href="prd_save.php?mode=prior&posi=up&prdcode=<?=$row->prdcode?>&prior=<?=$row->prior?>&page=<?=$page?>&<?=$param?>"><img src="../image/up_icon.gif" border="0" alt="1단계 위로"></a></td>
              <td width="4"></td>
              <td><a href="prd_save.php?mode=prior&posi=down&prdcode=<?=$row->prdcode?>&prior=<?=$row->prior?>&page=<?=$page?>&<?=$param?>"><img src="../image/down_icon.gif" border="0" alt="1단계 아래로"></a></td>
            </tr>
            <tr><td height="4"></td></tr>
            <tr>
              <td></td>
              <td width="4"></td>
              <td><a href="prd_save.php?mode=prior&posi=downdown&prdcode=<?=$row->prdcode?>&prior=<?=$row->prior?>&page=<?=$page?>&<?=$param?>"><img src="../image/downdown_icon.gif" border="0" alt="10단계 아래로"></a> </td>
            </tr>
            </table>
          </td>
          <td align="center">
          	<img src="../image/btn_edit_s.gif" style="cursor:hand" onclick="document.location='prd_input.php?mode=update&prdcode=<?=$row->prdcode?>&page=<?=$page?>&<?=$param?>'">
          	<img src="../image/btn_delete_s.gif" style="cursor:hand" onclick="delConfirm('<?=$row->prdcode?>');">
          </td>
        </tr>
        <tr><td colspan="20" class="t_line"></td></tr>
        </form>
     	<? 
     		$no--;
      }
                           
    	if($total <= 0){
      ?>
    		<tr><td height=30 colspan=10 align=center>등록된 상품이 없습니다.</td></tr>
    		<tr><td colspan="20" class="t_line"></td></tr>
    	<?
    	}
      ?>
      </table>
      
      <table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
      	<tr><td height="5"></td></tr>
        <tr> 
          <td width="33%">
          	<img src="../image/btn_seldel.gif" style="cursor:hand" onClick="prdDelete();">
          	<img src="../image/btn_prdmove.gif" style="cursor:hand" onClick="movePrd();">
          	<img src="../image/btn_prdcopy.gif" style="cursor:hand" onClick="copyPrd();">
          </td>
          <td width="33%"><? print_pagelist($page, $lists, $page_count, $param); ?></td>
          <td width="33%" align="right">
          </td>
        </tr>
      </table>

<? include "../foot.php"; ?>
