<?php

//echo WIZHOME_PATH;
?>
			<table width="175" border="0" cellpadding="0" cellspacing="0">
				<tr><td><img src="../image/left_tit_page.gif"></td></tr>
				<tr> 
					<td style="padding-top:5px"><img src="../image/left_top.gif" width="175" height="10"></td>
				</tr>
				<tr> 
					<td background="../image/left_bg.gif" style="padding:0 12 3 15"> 
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./page_list.php">페이지목록</a></td>
							</tr>
							<?
			            	$page_grp = explode("\n", $site_info[page_grp]);
			            	for($ii = 0; $ii < count($page_grp); $ii++) {
			            		if(!empty($page_grp[$ii])) {
			            			$tmp_grp = explode("^", $page_grp[$ii]);
			            			$page_grp_list[$tmp_grp[0]] = $tmp_grp[1];
			            		}
			            	}
            	
				      		$sql = "select * from wiz_page order by menu asc, prior asc";
							$result = mysql_query($sql) or error(mysql_error());
							$total = mysql_num_rows($result);
							while($row = mysql_fetch_array($result)){
								if(strcmp($row[menu], $tmp_grp) && !empty($row[menu])) {
							?>
							<tr><td height="10"></td></tr>
							<tr>
								<td height="20" style="padding-left:3px"><b><?=$page_grp_list[$row[menu]]?></b></td>
							</tr>
							<?php
								}
							?>
							<tr>
								<td height="20" style="padding-left:3px"><img src="../image/left_s_arrow.gif" align="absmiddle"><a href="./page_input.php?mode=update&idx=<?=$row[idx]?>"><?=$row[title]?></a></td>
							</tr>
					      <?
					      	$tmp_grp = $row[menu];
					    	}
					    	if($total <= 0){
					    	?>
<!--					    	<tr>-->
<!--									<td height="20" style="padding-left:10px"><font color=red>등록된 페이지가<br>없습니다.</font></td>-->
<!--								</tr>-->
					    	<?
					    	}
					    	?>
                            <tr>
                                <td height="1" bgcolor="#DEDEDE"></td>
                            </tr>
                            <tr>
                                <td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./history_list.php">연혁관리</a></td>
                            </tr>
                            <tr>
                                <td height="1" bgcolor="#DEDEDE"></td>
                            </tr>
                            <tr>
                                <td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./gallery_list.php">갤러리연도관리</a></td>
                            </tr>
                            <tr>
                                <td height="1" bgcolor="#DEDEDE"></td>
                            </tr>
                            <tr>
                                <td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./member_company_list.php">회원사관리</a></td>
                            </tr>
                            <tr>
                                <td height="1" bgcolor="#DEDEDE"></td>
                            </tr>
                            <tr>
                                <td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./banner_list.php">메인배너관리</a></td>
                            </tr>
						</table>
					</td>
				</tr>
				<tr> 
					<td><img src="../image/left_bottom.gif" width="175" height="7"></td>
				</tr>
			</table>
