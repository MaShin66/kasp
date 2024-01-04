<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include "../head.php"; ?>
<?
$param = "slevel=".$slevel."&searchopt=".$searchopt."&searchkey=".$searchkey;
?>
<script language="JavaScript" type="text/javascript">
<!--

// 체크박스 전체선택
function selectAll(){
	var i;
	for(i=0;i<document.forms.length;i++){
		if(document.forms[i].elements['id'] != null){
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
			if(document.forms[i].elements['id'] != null){
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
	var seluser = "";
	for(i=0;i<document.forms.length;i++){
		if(document.forms[i].elements['id'] != null){
			if(document.forms[i].select_checkbox){
				if(document.forms[i].select_checkbox.checked)
					seluser = seluser + document.forms[i].elements['id'].value + "|";
				}
			}
	}
	return seluser;
}

//선택회원 삭제
function delUser(){

	seluser = selectValue();

	if(seluser == ""){
		alert("삭제할 회원을 선택하세요.");
		return false;
	}else{
		if(confirm("선택한 회원을 정말 삭제하시겠습니까?")){
			document.location = "member_save.php?mode=deluser&seluser=" + seluser;
		}
	}
}

// 고객 메일발송
function sendMail(seluser, seluser_info){

	if(seluser == ""){
		var i;
		var seluser = "";
		var seluser_info = "";
		for(i=0;i<document.forms.length;i++){
			if(document.forms[i].elements['id'] != null){
				if(document.forms[i].select_checkbox){
					if(document.forms[i].select_checkbox.checked)
						seluser = seluser + document.forms[i].name.value + ":" + document.forms[i].email.value + ",";
						seluser_info = seluser_info + document.forms[i].elements['id'].value + ":" + document.forms[i].passwd.value + ",";
				}
			}
		}
	}

  if(seluser == ""){
		alert("이메일 발송할 회원을 선택하세요.");
		return false;
	}else{
	   var url = "mail_popup.php?seluser=" + seluser + "&seluser_info=" + seluser_info;
	   window.open(url,"sendMail","height=720, width=700, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
	}

}

// 고객 SMS발송
function sendSms(seluser){

	if(seluser == ""){
		var i;
		var seluser = "";
		for(i=0;i<document.forms.length;i++){
			if(document.forms[i].hphone != null){
				if(document.forms[i].select_checkbox){
					if(document.forms[i].select_checkbox.checked)
						seluser = seluser + document.forms[i].hphone.value + ",";
				}
			}
		}
	}

  if(seluser == ""){
		alert("SMS 발송할 회원을 선택하세요.");
		return false;
	}else{
	   var url = "sms_popup.php?seluser=" + seluser;
	   window.open(url,"sendSms","height=370, width=350, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
	}

}

// 회원정보 엑셀다운
function excelDown(){

	document.location = "member_excel.php?<?=$param?>";

}

// 선택회원 메일발송
function setMail(no) {
	var frm = eval("document.frm" + no);

	frm.select_checkbox.checked = true;
	sendMail('');

}

//-->
</script>

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif" align="absmiddle"></td>
          <td valign="bottom" class="tit">회원관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">회원을 검색/수정 관리합니다.</td>
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
         <select name="slevel">
         <option value=""> :: 등급선택 ::</option>
         <?=level_list();?>
         </select>
       </td>
       <td>
         <select name="searchopt" class="select">
         <option value="name">고객명
         <option value="id">아이디
         <option value="resno">주민번호
         <option value="email">이메일
         <option value="tphone">전화번호
         <option value="hphone">휴대폰
         </select>
       </td>
       <td><input type="text" name="searchkey" value="<?=$searchkey?>" class="input"></td>
       <td><input type="image" src="../image/btn_search.gif"></td>
       </tr>
       </table>
       <script language="javascript">
       <!--
       slevel = document.searchForm.slevel;
       for(ii=0; ii<slevel.length; ii++){
         if(slevel.options[ii].value == "<?=$slevel?>")
           slevel.options[ii].selected = true;
       }
       searchopt = document.searchForm.searchopt;
       for(ii=0; ii<searchopt.length; ii++){
         if(searchopt.options[ii].value == "<?=$searchopt?>")
           searchopt.options[ii].selected = true;
       }
       -->
       </script>

     </td>
     </tr>
     </table>
	 </form>

      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr><td height="10"></td></tr>
      </table>
      <?
      	$today = date('n-d');
         $toyear = date('Y');

         $age_syear = substr($toyear-($s_age+9),-2)+1;
         $age_eyear = substr($toyear-$s_age,-2)+2;

         $join_sdate = $prev_year."-".$prev_month."-".$prev_day;
         $join_edate = $next_year."-".$next_month."-".$next_day;

         $sql = "select count(id) as all_total from wiz_member";
         $result = mysql_query($sql) or error(mysql_error());
         $row = mysql_fetch_array($result);
      	$all_total = $row[all_total];

      	$sql = "select idx,id,passwd,name,hphone,email,level,visit,wdate from wiz_member";
         $sql .= " where id != ''";
         if($slevel != "") 		$sql .= " and level = '$slevel'";
         if($prev_year != "") $sql .= " and wdate > '$join_sdate' and wdate <= '$join_edate 23:59:59'";
         if($searchopt != "") $sql .= " and $searchopt like '%$searchkey%'";
         if($birthday == "Y") $sql .= " and birthday like '%$today'";
         if($memorial == "Y") $sql .= " and memorial like '%$today'";
         if($age != "")       $sql .= " and resno > '$age_syear' and resno < '$age_eyear'";
         if($address != "")   $sql .= " and address like '%$s_address%'";
         if($job != "")       $sql .= " and job = '$s_job'";
         if($marriage != "")  $sql .= " and marriage = '$s_marriage'";
         $sql .=" order by idx desc";
      	$result = mysql_query($sql) or error(mysql_error());
      	$total = mysql_num_rows($result);

         $rows = 20;
         $lists = 5;
       	$page_count = ceil($total/$rows);
       	if(!$page || $page > $page_count) $page = 1;
       	$start = ($page-1)*$rows;
       	$no = $total-$start;

      ?>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>총 회원수 : <b><?=$all_total?></b> , 검색 회원수 : <b><?=$total?></b></td>
          <td align="right">
          <img src="../image/btn_excel.gif" style="cursor:hand"  onClick="excelDown();">
          <img src="../image/btn_memadd.gif" style="cursor:hand" onClick="document.location='member_input.php?mode=insert';">
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <form>
        <tr><td colspan=20 class="t_rd"></td></tr>
        <tr class="t_th">
          <th width="5%"><input type="checkbox" name="select_tmp" onClick="selectReverse(this.form)"></th>
          <th width="5%">번호</th>
          <th>이름</th>
          <th width="15%">아이디</th>
          <th width="15%">휴대폰</th>
          <th width="15%">이메일</th>
          <th width="5%">방문수</th>
          <th width="10%">가입일</th>
          <th width="10%">기능</th>
        </tr>
        <tr><td colspan=20 class="t_rd"></td></tr>
        </form>
		<?
      	$sql = "select idx,id,passwd,name,hphone,email,level,visit,wdate from wiz_member";
         $sql .= " where id != ''";
         if($slevel != "") 		$sql .= " and level = '$slevel'";
         if($prev_year != "") $sql .= " and wdate > '$join_sdate' and wdate <= '$join_edate 23:59:59'";
         if($searchopt != "") $sql .= " and $searchopt like '%$searchkey%'";
         if($birthday == "Y") $sql .= " and birthday like '%$today'";
         if($memorial == "Y") $sql .= " and memorial like '%$today'";
         if($age != "")       $sql .= " and resno > '$age_syear' and resno < '$age_eyear'";
         if($address != "")   $sql .= " and address like '%$s_address%'";
         if($job != "")       $sql .= " and job = '$s_job'";
         if($marriage != "")  $sql .= " and marriage = '$s_marriage'";
         $sql .=" order by idx desc limit $start, $rows";
      	$result = mysql_query($sql) or error(mysql_error());

		while($row = mysql_fetch_array($result)){

			if($site_info[sms_use] == "Y") $hphone = "<a href=javascript:sendSms('".$row[hphone]."');>".$row[hphone]."</a>";
			else $hphone = $row[hphone];

		?>
	      <form name="frm<?=$no?>">
        <input type="hidden" name="id" value="<?=$row[id]?>">
        <input type="hidden" name="name" value="<?=$row[name]?>">
        <input type="hidden" name="email" value="<?=$row[email]?>">
        <input type="hidden" name="hphone" value="<?=$row[hphone]?>">
        <input type="hidden" name="passwd" value="<?=$row[passwd]?>">
        <tr>
          <td height="30" align="center"><input type="checkbox" name="select_checkbox"></td>
          <td align="center"><?=$no?></td>
          <td align="center"><?=$row[name]?></td>
          <td align="center"><?=$row[id]?></td>
          <td align="center"><?=$hphone?></td>
          <td align="center">
          	<!--a href="javascript:sendMail('<?=$row[name]?>:<?=$row[email]?>', '<?=$row[id]?>:<?=$row[passwd]?>')"><?=$row[email]?></a//-->
          	<a href="javascript:setMail('<?=$no?>')"><?=$row[email]?></a>
          </td>
          <td align="center"><?=$row[visit]?></td>
          <td align="center"><?=substr($row[wdate],0,10)?> &nbsp;</td>
          <td align="center"><a href="member_input.php?mode=update&idx=<?=$row[idx]?>&page=<?=$page?>&<?=$param?>"><img src="../image/btn_view_s.gif" border="0"></a></td>
        </tr>
        <tr><td colspan="20" class="t_line"></td></tr>
        </form>
      <?
     		$no--;
      }

    	if($total <= 0){
    	?>
    	  <tr><td height="30" colspan="10" align="center">등록된 회원이 없습니다.</td></tr>
        <tr><td colspan="20" class="t_line"></td></tr>
    	<?
    	}
      ?>
      </table>

      <table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
      	<tr><td height="5"></td></tr>
        <tr>
          <td width="30%">
            <img src="../image/btn_memdel.gif" style="cursor:hand" onClick="delUser('');">
            <img src="../image/btn_sendmail.gif" style="cursor:hand" onClick="sendMail('');">
            <? if($site_info[sms_use] == "Y"){ ?><img src="../image/btn_sendsms.gif" style="cursor:hand"  onClick="sendSms('');"><? } ?>
          </td>
          <td width="20%"><? print_pagelist($page, $lists, $page_count, $param); ?></td>
          <td width="30%"></td>
        </tr>
      </table>

<? include "../foot.php"; ?>
