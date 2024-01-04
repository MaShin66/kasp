			<table width="175" border="0" cellpadding="0" cellspacing="0">
				<tr><td><img src="../image/left_tit_member.gif"></td></tr>
				<tr> 
					<td style="padding-top:5px"><img src="../image/left_top.gif" width="175" height="10"></td>
				</tr>
				<tr> 
					<td background="../image/left_bg.gif" style="padding:0 12 3 15"> 
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./member_list.php">회원목록</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./level_list.php">회원등급</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./out_list.php">탈퇴회원</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							
							<tr><td height="10"></td></tr>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./mail_list.php">메세지설정</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./mail_test.php">메일발송테스트</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./mail_send.php">단체메일발송</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							
							<? if($site_info[sms_use] == "Y"){ ?>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./sms_send.php">단체SMS발송</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							<? } ?>
						
							<? if($site_info[msg_use] == "Y"){ ?>
							<tr><td height="10"></td></tr>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./message_send.php">쪽지발송</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./message_list.php">쪽지목록</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							<? } ?>
							
							<? if($site_info[point_use] == "Y"){ ?>
							<tr><td height="10"></td></tr>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./point_config.php">포인트설정</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./point_list.php">포인트목록</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							<? } ?>
							
							<tr><td height="10"></td></tr>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./member_analy.php">회원통계</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./member_config.php">가입약관 및<br>&nbsp;개인정보 보호정책</a></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr> 
					<td><img src="../image/left_bottom.gif" width="175" height="7"></td>
				</tr>
			</table>
