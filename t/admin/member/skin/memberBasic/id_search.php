<?
include "../inc/head.php"; 		// 탑부분
include "../inc/left.php";			// 카테고리, 왼쪽배너영역

?>
 
 
        
        <!-- 실제 컨텐츠 부분 -->
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="35" align="right" class="here">HOME > 회원정보 > <strong>아이디/패스워드 찾기</strong></td>
              </tr>
              <tr>
                <td class="title"><img src="../images/member/tit_idpw.gif" /></td>
              </tr>
              <tr>
                <td align="center" style="padding:30px 0px;">
                    
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td class="bpad_15"><img src="../images/member/idpw_tit.gif" /></td>
                      </tr>
                      <tr>
                        <td style="background:#f5f5f5; border:1px solid #ededed; padding:15 25px;">
                        
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                              <tr valign="top">
                                <td width="50%">
                                
                                
                                    <table width="322" border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td class="bpad_10"><img src="../images/member/tit_id_search.gif" /></td>
                                      </tr>
                                      <tr><td height="1" bgcolor="#ddddd"></td></tr>
                                      <tr>
                                        <td class="tpad_20">
                                        
                                        
                                            <table border="0" cellspacing="0" cellpadding="2">
                                              <tr>
                                                <td>
                                                    <table border="0" cellspacing="0" cellpadding="1">
                                                  <tr>
                                                    <td width="60"><img src="../images/member/idpw_name.gif" /></td>
                                                    <td align="left"><input name="name" type="text"  class="input_id" value="" style="width:150px;" /></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left"><img src="../images/member/idpw_email.gif" /></td>
                                                    <td align="left">
                                                        <input name="email" type="text"  class="input_id" value="" style="width:150px;"  />
                                                    </td>
                                                  </tr>
                                                </table></td>
                                                <td class="lpad_10"><input type="image" src="../images/member/bt_confirm2.gif"/></td>
                                              </tr>
                                              </form>
                                            </table>						  
                                        
                                        </td>
                                      </tr>
                                    </table>
                                
                                </td>
                                <td width="50%" align="right">
                                
                    
                                    <table width="321" border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td class="bpad_10"><img src="../images/member/tit_pw_search.gif"></td>
                                      </tr>
                                      <tr><td height="1" bgcolor="#ddddd"></td></tr>
                                      <tr>
                                        <td class="tpad_20">
                                         <form name="frm" action="/admin/member/idpw.php" method="post" onSubmit="return idpwCheck(this);">
                                              <input type="hidden" name="search" value="ok">
                                              <input type="hidden" name="submode" value="passwd">
                                            <table border="0" cellspacing="0" cellpadding="2">
                                              <tr>
                                                <td>
                                                    <table border="0" cellspacing="0" cellpadding="1">
                                                  <tr>
                                                    <td width="60" align="left"><img src="../images/member/idpw_id.gif" /></td>
                                                    <td align="left"><input name="id" type="text" class="input_id" value=""  style="width:150px;" /></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left"><img src="../images/member/idpw_name.gif" /></td>
                                                    <td align="left"><input name="name" type="text" class="input_id" value="" style="width:150px;" /></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left"><img src="../images/member/idpw_pw.gif" /></td>
                                                  <td align="left">
                                                        <input name="email" type="text" class="input_id" value=""  style="width:150px;"  />
                                                    </td>
                                                  </tr>
                                                </table></td>
                                                <td class="lpad_10"><input type="image" src="../images/member/bt_confirm3.gif" /></td>
                                              </tr>
                                              </table>
											  </form>
                                                            
                                        
                                        </td>
                                      </tr>
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
            
        <!-- 실제 컨텐츠 끝 -->  
        
<?
include "../inc/foot.php"; 		// 푸터영역

?>
