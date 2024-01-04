<table width="410" border="0" cellpadding="0" cellspacing="0" style="border:6px solid #979797;" height="280">
  <tr>
    <td width="351" height="74" style="padding-left:38px;"><img src="<?=$skin_dir?>/image/nick_check_01.gif"></td>
    <td width="60"><a href="javascript:window.close();"><img src="<?=$skin_dir?>/image/id_check_close.gif" width="21" height="21" border="0"></a></td>    
  </tr>
  <tr><td colspan="2" height="1" bgcolor="#d2d2d2"></td></tr>
  <tr>
    <td colspan="2" align="center" valign="top">
    	
        <table width="360" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" style="padding-left:10px;" class="form_sub">띄어쓰기 없이 한글,영문(숫자포함) 6~20자까지 사용 가능함.</td>
          </tr>
          <tr>
            <td bgcolor="#f5f5f5" height="50" align="center">
            	
                <!-- 닉네임 검색 -->
				<form name="frm" method="post" action="<?=$PHP_SELF?>" onSubmit="return idCheck(this);">
                <table width="280" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td style="padding-right:5px;"><img src="<?=$skin_dir?>/image/nick_check_nick.gif"></td>
                    <td><input type="text" name="nick" class="input_idpw" style="width:188px;"></td>
                    <td><input type="image" src="<?=$skin_dir?>/image/but_idcheck.gif"></td>                                        
                  </tr>
                </table>
				</form>
            
            </td>
          </tr>
          <tr>
            <td style="padding-top:16px;">
            	
            	<!-- 닉네임 검색결과 -->
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="2" bgcolor="#a9a9a9"></td>
                </tr>
                <tr>
                  <td height="38" align="center" style="color:#555555"><?=$checkmsg?></td>
                </tr>
                <tr><td height="1" bgcolor="#d7d7d7"></td></tr>               
              </table>
             	<!-- 아이디 검색결과 끝 -->              
            
            </td>
          </tr>
        </table>
    
    </td>
  </tr>  
</table>
