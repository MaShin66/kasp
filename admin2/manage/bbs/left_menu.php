			<table width="175" border="0" cellpadding="0" cellspacing="0">
				<tr><td><img src="../image/left_tit_bbs.gif"></td></tr>
				<tr>
					<td style="padding-top:5px"><img src="../image/left_top.gif" width="175" height="10"></td>
				</tr>
				<tr>
					<td background="../image/left_bg.gif" style="padding:0 12 3 15">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./bbs_list.php">게시판관리</a></td>
							</tr>
							<tr>
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							<tr>
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./bbs_list.php">게시판목록</a></td>
							</tr>
							<?
			            	$bbs_grp = explode("\n", $site_info[bbs_grp]);
			            	for($ii = 0; $ii < count($bbs_grp); $ii++) {
			            		if(!empty($bbs_grp[$ii])) {
			            			$tmp_grp = explode("^", $bbs_grp[$ii]);
			            			$bbs_grp_list[$tmp_grp[0]] = $tmp_grp[1];
			            		}
			            	}
            	
				      $sql = "select * from wiz_bbsinfo where type='BBS' order by grp asc, prior asc";
							$result = mysql_query($sql) or error(mysql_error());
							$total = mysql_num_rows($result);
							while($row = mysql_fetch_array($result)){
								if(strcmp($row[grp], $tmp_grp) && !empty($row[grp])) {
							?>
							<tr><td height="10"></td></tr>
							<tr>
								<td height="20" style="padding-left:3px"><b><?=$bbs_grp_list[$row[grp]]?></b></td>
							</tr>
							<?php
								}
							?>
							<tr>
								<td height="20" style="padding-left:3px"><img src="../image/left_s_arrow.gif" align="absmiddle"><a href="./list.php?code=<?=$row[code]?>"><?=$row[title]?></a></td>
							</tr>
				      <?
				      	$tmp_grp = $row[grp];
				    	}
				    	if($total <= 0){
				    	?>
				    	<tr>
								<td height="20" style="padding-left:10px"><font color=red>등록된 게시판이<br>없습니다.</font></td>
							</tr>
				    	<?
				    	}
				    	?>

						</table>
					</td>
				</tr>
				<tr>
					<td><img src="../image/left_bottom.gif" width="175" height="7"></td>
				</tr>
			</table>





