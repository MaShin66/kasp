<? include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php"; ?>
<html>
<head>
<title>회원검색</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="./style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
<!--
function setMem(id){
	opener.bbsFrm.memid.value = id;
	self.close();
}
//-->
</script>
</head>
<body onLoad="document.frm.searchkey.focus();" topmargin="0" leftmargin="0">

<table width="410" border="0" cellpadding="0" cellspacing="0" style="border:6px solid #979797;" height="280">
	<tr>
    <td width="351" height="74" style="padding-left:38px;"><img src="./image/id_check_01.gif"></td>
    <td width="60"><a href="javascript:window.close();"><img src="./image/id_check_close.gif" width="21" height="21" border="0"></a></td>    
  </tr>
  <tr><td colspan="2" height="1" bgcolor="#a9a9a9"></td></tr>
  <tr>
    <td colspan="2" align="center" valign="top">
    	
        <table width="360" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" style="padding-left:10px;" class="form_sub">이름,아이디로 검색가능합니다.</td>
          </tr>
          <tr>
            <td bgcolor="#f5f5f5" height="50" align="center">
            	
                <!-- 검색 -->
                <table width="280" border="0" cellpadding="0" cellspacing="0">
                <form name="frm" method="post" action="<?=$PHP_SELF?>">
                  <tr>
                    <td style="padding-right:5px;"><img src="./image/id_check_id.gif"></td>
                    <td><input type="text" name="searchkey" class="input_idpw" style="width:188px;"></td>
                    <td><input type="image" src="./image/but_idcheck.gif"></td>                                        
                  </tr>
                </form>
                </table>
            
            </td>
          </tr>
          <tr>
            <td style="padding-top:16px;">
            	
            	<!-- 아이디 검색결과 -->
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td colspan="2" height="2" bgcolor="#a9a9a9"></td>
                </tr>
								<?
								if($searchkey != ""){
									$sql = "select id,name from wiz_member where id like '%$searchkey%' or name like '%$searchkey%'";
									$result = mysql_query($sql) or error(mysql_error());
									$total = mysql_num_rows($result);
									while($row = mysql_fetch_array($result)){
								?>
								<tr>
                  <td height="30" align="left" style="padding-left:10px;"><a href="javascript:setMem('<?=$row[id]?>');"><?=$row[name]?>(<?=$row[id]?>)</a></td>
                  <td align="right" width="50" style="padding-right:10px;"><a href="javascript:setMem('<?=$row[id]?>');">[선택]</a></td>
                </tr>
                <tr><td colspan="2" height="1" bgcolor="#d7d7d7"></td></tr>
								<?
									}
									if($total <= 0){
								?>
								<tr>
                  <td colspan="2" height="30" align="center">- 검색된 회원이 없습니다.</td>
                </tr>
                <tr><td colspan="2" height="1" bgcolor="#d7d7d7"></td></tr>
								<?
									}
								}
								?>
                               
              </table>
             	<!-- 아이디 검색결과 끝 -->              
            
            </td>
          </tr>
        </table>
    
    </td>
  </tr>  
</table>
