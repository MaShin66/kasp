<table width="410" border="0" cellpadding="0" cellspacing="0" style="border:6px solid #979797;" height="310">
  <tr>
    <td width="351" height="74" style="padding-left:37px;"><img src="<?=$skin_dir?>/image/zip_01.gif"></td>
    <td width="60"><a href="javascript:window.close();"><img src="<?=$skin_dir?>/image/id_check_close.gif" width="21" height="21" border="0"></a></td>
  </tr>
  <tr><td colspan="2" height="1" bgcolor="#d2d2d2"></td></tr>
  <tr>
    <td colspan="2" align="center" valign="top">

        <table width="360" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="60" style="padding-left:10px;"><img src="<?=$skin_dir?>/image/post_txt.gif"></td>
          </tr>
          <tr>
            <td bgcolor="#f5f5f5" height="50" align="center">

                <!-- 우편번호 검색 -->
                <table width="280" border="0" cellpadding="0" cellspacing="0">
                <form name="frm" action="<?=$PHP_SELF?>" method="get">
      					<input type="hidden" name="code" value="<?=$code?>">
      					<input type="hidden" name="kind" value="<?=$kind?>">
                  <tr>
                    <td><img src="<?=$skin_dir?>/image/zip_02.gif"></td>
                    <td><input type="text" name="address" class="input_idpw" style="width:188px;"></td>
                    <td><input type="image" src="<?=$skin_dir?>/image/but_idcheck.gif"></td>
                  </tr>
                </form>
                </table>

            </td>
          </tr>
          <tr>
            <td style="padding:16px 0 48px 0;" height="203" valign="top">

              <!-- 우편번호 검색결과 -->
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
               <tr>
                  <td colspan="2" height="2" bgcolor="#a9a9a9"></td>
                </tr>
                <tr>
                  <td width="35%" height="38" align="center" bgcolor="#f9f9f9" style="color:#555555"><strong>우편번호</strong></td>
                  <td width="75%" align="center" bgcolor="#f9f9f9" style="color:#555555"><strong>주소</strong></td>
                </tr>
                <tr><td colspan="2" height="1" bgcolor="#d7d7d7"></td></tr>
