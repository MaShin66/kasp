<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<?
$param = "sdate=".$sdate."&edate=".$edate."&level=".$level."&searchopt=".$searchopt."&searchkey=".$searchkey."&resms=".$resms;
?>
<? include "../head.php"; ?>

<script language="JavaScript" type="text/javascript">
<!--
function smsCheck(){

	var frm = document.frm;
	if(frm.se_num.value == ""){
		alert("보내는분 번호를 입력하세요");
		frm.se_num.focus();
		return false;
	}
	if(frm.message.value == ""){
		alert("내용을 입력하세요");
		frm.message.focus();
		return false;
	}

	frm.action = "sms_save.php";
	frm.method = "post";
	frm.submit();

}

function calByte(aquery){

	var tmpStr;
	var temp = 0;
	var onechar;
	var tcount = 0;;

	tmpStr = new String(aquery);
	temp = tmpStr.length;
	for(k=0; k<temp; k++) {
		onechar = tmpStr.charAt(k);
		if(escape(onechar).length > 4) {
			tcount += 2;
		} else if(onechar != '\n' || onechar != '\r') {
			tcount++;
		}

		frm.sms_byte.value = tcount+"/80 bytes";

		if(tcount > 80) {
			alert("메시지내용은 80 바이트 이상 전송할 수 없습니다.");

			cutText(frm.message.value);

			return;
		}
	}
	if ( temp == 0 ) {

		frm.sms_byte.value = "0/80 bytes";

	}
}

function cutText(aquery) {

	var tmpStr;
	var temp=0;
	var onechar;
	var tcount = 0;

	tmpStr = new String(aquery);
	temp = tmpStr.length;
	for(t=0; t<temp; t++){
		onechar = tmpStr.charAt(t);
		if(escape(onechar).length > 4) {
			tcount += 2;
		} else if(onechar != '\n' || onechar != '\r') {
			tcount++;
		}
		if(tcount > 80) {
			tmpStr = tmpStr.substring(0, t);
			break;
		}
	}

	document.frm.message.value = tmpStr;

	calByte(tmpStr);
}

function checkSmsmsg(){

	var tmpStr = document.frm.message.value;

	calByte(tmpStr);

}

//-->
</script>

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">단체SMS발송</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">회원을 검색하여 단체 SMS를 발송합니다.</td>
        </tr>
      </table>

      <br>
	  <form name="frm" action="<?=$PHP_SELF?>" method="get">
      <input type="hidden" name="page" value="<?=$page?>">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td bgcolor="ffffff">
            <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
            <tr>
            <td width="15%" class="t_name">조건검색</td>
            <td width="85%" class="t_value">

             <table cellspacing="2" cellpadding="0">
             <tr>
             <td>
               <select name="level">
               <option value=""> :: 등급선택 ::</option>
               <?=level_list();?>
               </select>
             </td>
             <td>
               <select name="searchopt" class="select">
               <option value="name">고객명
               <option value="id">아이디
               <option value="resno">주민번호
               <option value="email">이SMS
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
             level = document.frm.level;
             for(ii=0; ii<level.length; ii++){
               if(level.options[ii].value == "<?=$level?>")
                 level.options[ii].selected = true;
             }
             searchopt = document.frm.searchopt;
             for(ii=0; ii<searchopt.length; ii++){
               if(searchopt.options[ii].value == "<?=$searchopt?>")
                 searchopt.options[ii].selected = true;
             }
             -->
             </script>

           </td>
           </tr>
           <tr>
            <td width="120" class="t_name">&nbsp; 가입기간</td>
            <td class="t_value">
            	<? if($sdate == "") $sdate = "2006-01-01"; if($edate == "") $edate = date('Y-m-d'); ?>
              <input type="text" name="sdate" value="<?=$sdate?>" size="12" class="input">
              <img src="../image/ic_cal.gif" style="cursor:hand" align="center" onClick="Calendar1('document.frm','sdate');"> ~
              <input type="text" name="edate" value="<?=$edate?>" size="12" class="input">
              <img src="../image/ic_cal.gif" style="cursor:hand" align="center" onClick="Calendar1('document.frm','edate');">
            </td>
            </tr>
            <tr>
            <td width="120" class="t_name">&nbsp; SMS수신</td>
            <td class="t_value">
            	<input type="radio" name="resms" value="Y" <? if($resms == "Y" || $resms == "") echo "checked"; ?>>회원전체
              <input type="radio" name="resms" value="N" <? if($resms == "N") echo "checked"; ?>>수신거부회원 제외
            </td>
            </tr>
           </table>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr><td height="15"></td></tr>
      </table>
      <?
      	$sql = "select id from wiz_member";
      	$result = mysql_query($sql) or error(mysql_error());
      	$all_total = mysql_num_rows($result);


         $today = date('n-d');
         $toyear = date('Y');

         $age_syear = substr($toyear-($age+9),-2)+1;
         $age_eyear = substr($toyear-$age,-2)+2;

         $join_sdate = $prev_year."-".$prev_month."-".$prev_day;
         $join_edate = $next_year."-".$next_month."-".$next_day;


         $sql = "select id,passwd,name,hphone,email,visit,resms,wdate from wiz_member where id != '' ";

         if($sdate != "") 		$sql .= " and wdate > '$sdate'";
         if($edate != "") 		$sql .= " and wdate <= '$edate 23:59:59'";
         if($searchkey != "") $sql .= " and $searchopt like '%$searchkey%'";
         if($level != "") 		$sql .= " and level = '$level'";
         if($birthday == "Y") $sql .= " and birthday like '%$today'";
         if($memorial == "Y") $sql .= " and memorial like '%$today'";
         if($age != "")       $sql .= " and resno > '$age_syear' and resno < '$age_eyear'";
         if($address != "")   $sql .= " and address like '%$address%'";
         if($job != "")       $sql .= " and job = '$job'";
         if($marriage != "")  $sql .= " and marriage = '$marriage'";
         if($resms == "N")	$sql .= " and resms != 'N'";

         $sql .=" order by wdate desc";

         $result = mysql_query($sql) or error(mysql_error());
         $total = mysql_num_rows($result);

         $rows = 6;
         $lists = 5;
       	 $page_count = ceil($total/$rows);
       	 if(!$page || $page > $page_count) $page = 1;
         $start = ($page-1)*$rows;
         $no = $total-$start;
      ?>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>총 회원수 : <?=$all_total?> , 검색 회원수 : <?=$total?></td>
        </tr>
        <tr><td height="3"></td></tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr><td colspan=20 class="t_rd"></td></tr>
        <tr class="t_th">
          <th width="8%">번호</th>
          <th>이름</th>
          <th>아이디</th>
          <th>휴대폰</th>
          <th>이메일</th>
          <th width="5%">방문수</th>
          <th width="10%">SMS수신</th>
          <th width="10%">가입일</th>
        </tr>
        <tr><td colspan=20 class="t_rd"></td></tr>
		<?
         $sql = "select id,passwd,name,hphone,email,visit,resms,wdate from wiz_member where id != '' ";

         if($sdate != "") 		$sql .= " and wdate > '$sdate'";
         if($edate != "") 		$sql .= " and wdate <= '$edate 23:59:59'";
         if($searchkey != "") $sql .= " and $searchopt like '%$searchkey%'";
         if($level != "") 		$sql .= " and level = '$level'";
         if($birthday == "Y") $sql .= " and birthday like '%$today'";
         if($memorial == "Y") $sql .= " and memorial like '%$today'";
         if($age != "")       $sql .= " and resno > '$age_syear' and resno < '$age_eyear'";
         if($address != "")   $sql .= " and address like '%$address%'";
         if($job != "")       $sql .= " and job = '$job'";
         if($marriage != "")  $sql .= " and marriage = '$marriage'";
         if($resms == "N")	$sql .= " and resms != 'N'";

         $sql .=" order by wdate desc limit $start, $rows";

         $result = mysql_query($sql) or error(mysql_error());

		while($row = mysql_fetch_object($result)){
			if($row->resms == "N") $row->resms = "아니오";
			else $row->resms = "예";
		?>
        <input type="hidden" name="id" value="<?=$row->id?>">
        <tr>
          <td align="center" height="30"><?=$no?></td>
          <td align="center"><?=$row->name?></td>
          <td align="center"><?=$row->id?></td>
          <td align="center"><?=$row->hphone?></td>
          <td align="center"><?=$row->email?></td>
          <td align="center"><?=$row->visit?></td>
          <td align="center"><?=$row->resms?></td>
          <td align="center"><?=substr($row->wdate,0,10)?> &nbsp;</td>
        </tr>
        <tr><td colspan="20" class="t_line"></td></tr>
     <?
     		$no--;
      }

    	if($total <= 0){
    	?>
    		<tr><td height=30 colspan=10 align=center>검색된 회원이 없습니다.</td></tr>
    		<tr><td colspan="20" class="t_line"></td></tr>
    	<?
    	}
      ?>
      </table>

      <br>

      <? print_pagelist($page, $lists, $page_count, "$param"); ?>

      <br>

      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="2" class="t_style">
              <tr>
                <td width="15%" class="t_name">보내는이</td>
                <td width="85%" class="t_value">
                <input type="text" name="se_num" value="<?=$site_info[site_hand]?>" size="60" class="input">
                </td>
              </tr>
              <tr>
                <td class="t_name">내용</td>
                <td class="t_value">
                  <textarea name="message" rows="12" cols="60" class="textarea" onKeyDown="checkSmsmsg();"></textarea>
                  <input type="text" name="sms_byte" size="11" style="height:14px; border: 1px solid #91FBFF; ; font-size:8pt; font-family:돋움; background-color:#91FBFF" value="0/80 bytes" onfocus="this.blur()">
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center">
          	<img src="../image/btn_send_l.gif" style="cursor:hand" onClick="smsCheck()">
          </td>
        </tr>
      </table>
	  </form>


<? include "../foot.php"; ?>
