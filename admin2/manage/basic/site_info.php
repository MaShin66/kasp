<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include "../head.php"; ?>


<script language="javascript">
<!--
function inputCheck(frm){

	if(frm.site_name.value == ""){
		alert("사이트명을 입력하세요.");
		frm.site_name.focus();
		return false;
	}
	if(frm.site_url.value == ""){
		alert("사이트 URL을 입력하세요.");
		frm.site_url.focus();
		return false;
	}
	if(frm.site_email.value == ""){
		alert("관리자 이메일을 입력하세요.");
		frm.site_email.focus();
		return false;
	}
	if(frm.site_hand.value == ""){
		alert("관리자 휴대폰을 입력하세요.");
		frm.site_hand.focus();
		return false;
	}
}

function inputDomain(submode,idx){
   if(submode == "delete"){
      if(confirm("삭제하시겠습니까?")){
         document.location = "site_save.php?mode=domain&submode=delete&idx=" + idx;
      }
   }else{
	   var url = "./domain_input.php?submode=" + submode + "&idx=" + idx;
	   window.open(url,"inputDomain","height=250, width=367, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
   }
}

function inputEmail(submode,idx){
   if(submode == "delete"){
      if(confirm("삭제하시겠습니까?")){
         document.location = "site_save.php?mode=email&submode=delete&idx=" + idx;
      }
   }else{
	   var url = "./email_input.php?submode=" + submode + "&idx=" + idx;
	   window.open(url,"inputEmail","height=250, width=367, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
   }
}

function searchZip(){
	document.frm.com_address1.focus();
	var url = "../member/search_zip.php?kind=com_";
	window.open(url,"searchZip","height=350, width=367, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
}
-->
</script>
</head>

		<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">사이트정보</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">사이트 기본정보를 관리합니다.</td>
        </tr>
      </table>

      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 기본정보</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <form name="frm" action="site_save.php" method="post" onSubmit="return inputCheck(this);">
      <input type="hidden" name="tmp">
      <input type="hidden" name="mode" value="site_info">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
              <tr>
                <td align="left" class="t_name">사이트명</td>
                <td class="t_value" colspan="3"><input name="site_name" value="<?=$site_info[site_name]?>" type="text" class="input"></td>
              </tr>
              <tr>
                <td align="left" class="t_name">사이트 URL</td>
                <td class="t_value" colspan="3"><input name="site_url" type="text" value="<?=$site_info[site_url]?>" size="60" class="input"></td>
              </tr>
              <tr>
                <td align="left" class="t_name">관리자 이메일</td>
                <td class="t_value" colspan="3"><input name="site_email" type="text" value="<?=$site_info[site_email]?>" size="60" class="input"></td>
              </tr>
              <tr>
                <td width="15%" align="left" class="t_name">관리자 전화번호</td>
                <td width="35%" class="t_value"><input name="site_tel" type="text" value="<?=$site_info[site_tel]?>" size="28" class="input"></td>
                <td width="15%" align="left" class="t_name">관리자 휴대폰</td>
                <td width="35%" class="t_value"><input name="site_hand" type="text" value="<?=$site_info[site_hand]?>" class="input"></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30"><font color=red>- 관리자 이메일,휴대폰번호로 회원가입,탈퇴,폼메일 등 사이트에서 일어나는 상황을 알려줍니다.</font></td>
        </tr>
      </table>

      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> FTP정보</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
        <tr>
          <td align="left" class="t_name">접속주소(ip,도메인)</td>
          <td class="t_value" colspan="3"><input name="ftp_host" value="<?=$site_info[ftp_host]?>" type="text" class="input"></td>
        </tr>
        <tr>
          <td width="15%" align="left" class="t_name">아이디</td>
          <td width="35%" class="t_value"><input name="ftp_id" type="text" value="<?=$site_info[ftp_id]?>" size="28" class="input"></td>
          <td width="15%" align="left" class="t_name">비밀번호</td>
          <td width="35%" class="t_value">
          <input name="ftp_pw" type="text" value="" class="input"> <?=set_passwd($site_info[ftp_pw])?>
          </td>
        </tr>
      </table>

      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 도메인 정보</td>
          <td align="right"><img src="../image/btn_insert_s.gif" onClick="inputDomain('insert','');" style="cursor:hand"></td>
        </tr>
      </table>
      <table width="100%" border=0 cellspacing="1" cellpadding="3" class="t_style">
        <tr align="center" class="t_name">
          <td width="5%">No</td>
          <td width="20%">도메인</td>
          <td width="20%">구입사이트</td>
          <td width="12%">아이디</td>
          <td width="13%">비밀번호</td>
          <td width="15%">만료일</td>
          <td width="15%">기능</td>
        </tr>
        <?
        $no = 1;
        $sql = "select * from wiz_otherinfo where type = 'domain' order by idx asc";
        $result = mysql_query($sql) or error(mysql_error());
        $total = mysql_num_rows($result);
        while($row = mysql_fetch_array($result)){
        ?>
        <tr align="center" class="t_value">
          <td><?=$no?></td>
          <td><?=$row[info01]?></td>
          <td><?=$row[info02]?></td>
          <td><?=$row[info03]?></td>
          <td><?=set_passwd($row[info04])?></td>
          <td><?=$row[info05]?></td>
          <td>
          	<a href="javascript:inputDomain('update','<?=$row[idx]?>')"><img src="../image/btn_edit_s.gif" border="0"></a>
          	<a href="javascript:inputDomain('delete','<?=$row[idx]?>')"><img src="../image/btn_delete_s.gif" border="0"></a>
          </td>
        </tr>
        <?
         $no++;
        }
        if($total <= 0){
        ?>
        <tr align="center" class="t_value"><td colspan="10" align="center">등록된 도메인이 없습니다.</td></tr>
        <?
        }
        ?>
      </table>

      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 이메일 정보</td>
          <td align="right"><img src="../image/btn_insert_s.gif" onClick="inputEmail('insert','');" style="cursor:hand"></td>
        </tr>
      </table>
      <table width="100%" border=0 cellspacing="1" cellpadding="3" class="t_style">
        <tr align="center" class="t_name">
          <td width="5%">No</td>
          <td width="20%">이메일</td>
          <td width="20%">사용자명</td>
          <td width="20%">아이디</td>
          <td width="20%">비밀번호</td>
          <td width="15%">기능</td>
        </tr>
        <?
        $no = 1;
        $sql = "select * from wiz_otherinfo where type = 'email' order by idx asc";
        $result = mysql_query($sql) or error(mysql_error());
        $total = mysql_num_rows($result);
        while($row = mysql_fetch_array($result)){
        ?>
        <tr align="center" class="t_value">
          <td><?=$no?></td>
          <td><?=$row[info01]?></td>
          <td><?=$row[info02]?></td>
          <td><?=$row[info03]?></td>
          <td><?=set_passwd($row[info04])?></td>
          <td>
          	<a href="javascript:inputEmail('update','<?=$row[idx]?>')"><img src="../image/btn_edit_s.gif" border="0"></a>
          	<a href="javascript:inputEmail('delete','<?=$row[idx]?>')"><img src="../image/btn_delete_s.gif" border="0"></a>
          </td>
        </tr>
        <?
          $no++;
        }
        if($total <= 0){
        ?>
        <tr align="center" class="t_value"><td colspan="10" align="center">등록된 이메일이 없습니다.</td></tr>
        <?
        }
        ?>
      </table>

      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 사업자정보</td>
        </tr>
      </table>

      <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
        <tr>
          <td align="left" class="t_name">사업자등록번호</td>
          <td class="t_value" colspan="3"><input name="com_num" type="text" value="<?=$site_info[com_num]?>" class="input"></td>
        </tr>
        <tr>
          <td width="120" align="left" class="t_name">상호</td>
          <td class="t_value"><input name="com_name" type="text" value="<?=$site_info[com_name]?>" class="input"></td>
          <td width="120" align="left" class="t_name">대표자명</td>
          <td class="t_value"><input name="com_owner" type="text" value="<?=$site_info[com_owner]?>" class="input"></td>
        </tr>
        <tr>
          <td align="left" class="t_name">우편번호</td>
          <td class="t_value" colspan="3">
            <? list($post1, $post2) = explode("-",$site_info[com_post]); ?>
            <input name="com_post1" type="text" value="<?=$post1?>" size="5" class="input"> -
            <input name="com_post2" type="text" value="<?=$post2?>" size="5" class="input">
            <img src="../image/btn_post.gif" onClick="searchZip();" style="cursor:hand" align="absmiddle">
          </td>
        </tr>
        <tr>
          <td align="left" class="t_name">주소</td>
          <td class="t_value" colspan="3"><input name="com_address1" type="text" value="<?=$site_info[com_address]?>" size="50" class="input"></td>
        </tr>
        <tr>
          <td align="left" class="t_name">업태</td>
          <td class="t_value"><input name="com_kind" type="text" value="<?=$site_info[com_kind]?>" class="input"></td>
          <td align="left" class="t_name">종목</td>
          <td class="t_value"><input name="com_class" type="text" value="<?=$site_info[com_class]?>" class="input"></td>
        </tr>
        <tr>
          <td align="left" class="t_name">전화번호</td>
          <td class="t_value"><input name="com_tel" type="text" value="<?=$site_info[com_tel]?>" class="input"></td>
          <td align="left" class="t_name">팩스번호</td>
          <td class="t_value"><input name="com_fax" type="text" value="<?=$site_info[com_fax]?>" class="input"></td>
        </tr>
      </table>

			<br>
      <table align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
          	<input type="image" src="../image/btn_confirm_l.gif"> &nbsp;
          	<img src="../image/btn_cancel_l.gif" style="cursor:hand" onClick="history.back();">
          </td>
        </tr>
      </form>
      </table>

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
              <td><img src="../image/check_tit.gif" width="75" height="19" /></td>
            </tr>
            <tr>
              <td class="chk_alt">
              - FTP 정보, 도메인정보, 이메일정보, 사업자정보 는 사이트 운영에 영향을 미치는 것이 아니며<br>
              - 분실하기 쉬운 정보를 작성하여 추후 사이트 관리에 이용하는 부분입니다.
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

<? include "../foot.php"; ?>
