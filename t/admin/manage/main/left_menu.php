			<table width="175" border="0" cellpadding="0" cellspacing="0">
				<tr><td><img src="../image/left_tit_main.gif"></td></tr>
				<tr> 
					<td style="padding-top:5px"><img src="../image/left_top.gif" width="175" height="10"></td>
				</tr>
				<tr> 
					<td background="../image/left_bg.gif" style="padding:0 12 3 15"> 
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							
							<? if($menu_arr["BASIC"]==true){ ?>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="../basic/site_info.php">기본설정</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							<? } ?>
							
							<? if($menu_arr["MEMBER"]==true){ ?>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="../member/member_list.php">회원관리</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							<? } ?>
						
							<? if($menu_arr["BBS"]==true){ ?>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="../bbs/bbs_list.php">게시판관리</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							<? } ?>
							
							<? if($menu_arr["LOG"]==true){ ?>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="../connect/connect_list.php">접속관리</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							<? } ?>
							
						</table>
					</td>
				</tr>
				<tr> 
					<td><img src="../image/left_bottom.gif" width="175" height="7"></td>
				</tr>
			</table>
			<br>
      <table width="175" border="0" cellpadding="0" cellspacing="0">
      	<tr>
          <td align="left"><a href="../db_backup.php"><img src="../image/bt_allbackup.gif" border="0"></a></td>
        </tr>
        <? if($menu_arr["MEMBER"]==true){ ?>
        <tr><td height="5"></td></tr>
        <tr>
          <td align="left"><a href="../db_backup.php?table=wiz_member"><img src="../image/bt_membackup.gif" border="0"></a></td>
        </tr>
        <? } ?>
      </table>
