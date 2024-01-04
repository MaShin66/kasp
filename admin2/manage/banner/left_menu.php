			<table width="175" border="0" cellpadding="0" cellspacing="0">
				<tr><td><img src="../image/left_tit_banner.gif"></td></tr>
				<tr> 
					<td style="padding-top:5px"><img src="../image/left_top.gif" width="175" height="10"></td>
				</tr>
				<tr> 
					<td background="../image/left_bg.gif" style="padding:0 12 3 15"> 
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle"><a href="./banner_list.php">배너관리</a></td>
							</tr>
							<tr> 
								<td height="1" bgcolor="#DEDEDE"></td>
							</tr>
							<tr><td height="10"></td></tr>
							<tr> 
								<td height="30"><img src="../image/left_m_arrow.gif" align="absmiddle">배너그룹</td>
							</tr>
							<?
				      $sql = "select * from wiz_bannerinfo order by title";
        			$result = mysql_query($sql) or error(mysql_error());
							$total = mysql_num_rows($result);
							while($row = mysql_fetch_array($result)) {
							?>
							<tr> 
								<td height="20" style="padding-left:10px"><img src="../image/left_s_arrow.gif" align="absmiddle"><a href="./list.php?code=<?=$row[code]?>"><?=$row[title]?></a></td>
							</tr>
				      <?
				    	}
				    	if($total <= 0){
				    	?>
				    	<tr> 
								<td height="20" style="padding-left:10px"><font color="red">등록된 배너그룹이 없습니다.</font></td>
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
