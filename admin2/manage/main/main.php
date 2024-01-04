<? include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php"; ?>
<? include_once "$_SERVER[DOCUMENT_ROOT]/admin2/inc/admin_check.php"; ?>
<? include_once "$_SERVER[DOCUMENT_ROOT]/admin2/inc/site_info.php"; ?>
<? include "$_SERVER[DOCUMENT_ROOT]/admin2/manage/head.php"; ?>
<?
// 하드사용량
/*
$disk_use = exec("du -h ../../../");
$disk_use = str_replace(array("M","/","..","	"),"",$disk_use);
$disk_graph = round($disk_use*2)/10;
*/

// 디비사용량
/*
$sql = "show table status like '%'";
$result = mysql_query($sql) or error(mysql_error());
while($sys_db = mysql_fetch_object($result)){
$db_use += $sys_db->Data_length;
}
$db_use = ceil($db_use/(8*102400));
$db_graph = round($db_use*2)/10;
*/

// 총게시판수
$sql = "select count(code) as cnt from wiz_bbsinfo";
$result = mysql_query($sql) or error(mysql_error());
$row = mysql_fetch_array($result);
$bbs_num = $row[cnt];

// 총게시물수
$sql = "select count(idx) as cnt from wiz_bbs";
$result = mysql_query($sql) or error(mysql_error());
$row = mysql_fetch_array($result);
$bbs_total = $row[cnt];

// 오늘게시물수
$today = date("Ymd");
$sql = "select count(idx) as cnt from wiz_bbs where DATE_FORMAT(FROM_UNIXTIME(wdate), '%Y%m%d') = '".$today."'";
$result = mysql_query($sql) or error(mysql_error());
$row = mysql_fetch_array($result);
$bbs_today = $row[cnt];

// 오늘댓글
$sql = "select count(idx) as cnt from wiz_comment where DATE_FORMAT(wdate, '%Y%m%d') = '".$today."'";
$result = mysql_query($sql) or error(mysql_error());
$row = mysql_fetch_array($result);
$comment_today = $row[cnt];

// 방문자
$sql = "select time, sum(cnt) as cnt from wiz_contime group by substring(time,1,8) order by substring(time,1,8) desc";
$result = mysql_query($sql) or error(mysql_error());
$visit_cnt = mysql_fetch_object($result);
$today_cnt = $visit_cnt->cnt;
if($today_cnt == "") $today_cnt = "0";

$visit_cnt = mysql_fetch_object($result);
$yester_cnt = $visit_cnt->cnt;
if($yester_cnt == "") $yester_cnt = "0";

$sql = "select sum(cnt) as cnt from wiz_contime";
$result = mysql_query($sql) or error(mysql_error());
$visit_cnt = mysql_fetch_object($result);
$total_cnt = $visit_cnt->cnt;
if($total_cnt == "") $total_cnt = "0";

// 현재접속자
$dir = @opendir(WIZHOME_PATH."/data/connect");
$now_time = mktime(date('H'), date('i'), 0, date('m'), date('d'), date('Y'));

while(($file = readdir($dir)) !== false)
{
   if(($file != ".") && ($file != ".."))
   {
      $now_cnt++;
      $fileinfo = stat(WIZHOME_PATH."/data/connect/$file");
      if($fileinfo[9] < $now_time - 120)
      {
         unlink(WIZHOME_PATH."/data/connect/$file");
         $now_cnt--;
      }
   }
}
if($now_cnt == "") $now_cnt = "0";

?>

          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr><td height="3"></td></tr>
          <tr>
            <td width="49%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="left" background="../image/tit_bg.gif"><img src="../image/tit_new.gif"></td>
                    <td align="right" background="../image/tit_bg.gif"><a href="../bbs/bbs_list.php"><img src="../image/tit_more.gif" border="0"></a></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="14"></td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
               	<?
								$ttime = mktime(0,0,0,date('m'),date('d'),date('Y'));

								$sql = "select wb.idx,wb.code,wb.subject,date_format(from_unixtime(wb.wdate), '%Y-%m-%d') as wdate,wi.title, wi.type from wiz_bbs wb, wiz_bbsinfo wi where wb.code = wi.code order by wb.idx desc limit 8";
								$result = mysql_query($sql) or error(mysql_error());
								$total = mysql_num_rows($result);
								while($row = mysql_fetch_array($result)){
									$new = "";
									$wtime = mktime(0,0,0,substr($row[wdate],5,2),substr($row[wdate],8,2),substr($row[wdate],0,4));
									if(($ttime-$wtime)/86400 <= 2) $new = "<img src='../image/new.gif' border='0' align='absmiddle'>";	// new
									$row[wdate] = str_replace("-","/",$row[wdate]);

									if(!strcmp($row[type], "SCH")) $purl = "../schedule/list.php";
									else $purl = "../bbs/list.php";
								?>
                  <tr>
                    <td height="25" align="center" width="12"><img src="../image/left_s_arrow.gif" /></td>
                    <td><a href="<?=$purl?>?code=<?=$row[code]?>">[<?=$row[title]?>] <?=$row[subject]?></a> <?=$new?></td>
                    <td align="right">[<?=$row[wdate]?>]</td>
                  </tr>
                  <tr>
                    <td colspan="3" height="1" background="../image/dot_bg.gif"></td>
                  </tr>
                <?
              	}
                ?>
                </table></td>
              </tr>
            </table>
            </td>
            <td width="20"></td>
            <td width="49%" valign="top">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="left" background="../image/tit_bg.gif"><img src="../image/tit_log.gif"></td>
                        <td align="right" background="../image/tit_bg.gif"><a href="../connect/connect_list.php"><img src="../image/tit_more.gif" border="0"></a></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="14"></td>
                </tr>
                <tr>
                  <td>


                  	<table width="100%" border="0" cellspacing="0" cellpadding="0" background="../image/graph_bg2.gif" style="background-position:bottom;">
                  		<tr>
											<?
											$substring_sql = "substring(time,5,2)";
											$time_gubun = "월";
											$pr_start = 1; $pr_end = 12;

											$prev_period = date("Y")."010100";
											$next_period = date("Y")."123124";

											$period_sql = " where time >= '$prev_period' and time <= '$next_period' ";

											$sql = "select sum(cnt) as total_cnt from wiz_contime";
											$result = mysql_query($sql) or error(mysql_error());
											$row = mysql_fetch_object($result);
											$total_cnt = $row->total_cnt;

											$sql = "select sum(cnt) as cnt, $substring_sql as time from wiz_contime $period_sql group by $substring_sql order by $substring_sql asc";
											$result = mysql_query($sql) or error(mysql_error());
											$total = mysql_num_rows($result);

								      while($row = mysql_fetch_object($result)){
								      	$row->time = $row->time/1;
								      	$percent = ceil(($row->cnt/$total_cnt)*100);
								      	$cnt_list[$row->time][cnt] = $row->cnt;
								      	$cnt_list[$row->time][percent] = $percent;
										  }

											for($pr_start; $pr_start <= $pr_end; $pr_start++){
									    ?>
									      <td height="195" width="8%" align="center" valign="bottom"><span class="s01"><?=$cnt_list[$pr_start][cnt]?></span>
	                      	<table width="13" border="0" cellspacing="1" cellpadding="0" bgcolor="3796d1">
	                        	<tr>
	                          	<td background="../image/graph_bg.gif" height='<?=($cnt_list[$pr_start][percent]*1.9)?>'  style="background-repeat:repeat-y"></td>
	                        	</tr>
	                        </table>
	                      </td>
									      <?
									      }
									   	?>
									  	</tr>
                  	</table>

                  	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="22" width="8%" align="center">1월</td>
                      <td width="8%" align="center">2월</td>
                      <td width="8%" align="center">3월</td>
                      <td width="8%" align="center">4월</td>
                      <td width="8%" align="center">5월</td>
                      <td width="8%" align="center">6월</td>
                      <td width="8%" align="center">7월</td>
                      <td width="8%" align="center">8월</td>
                      <td width="8%" align="center">9월</td>
                      <td width="8%" align="center">10월</td>
                      <td width="8%" align="center">11월</td>
                      <td width="8%" align="center">12월</td>
                    </tr>
                  	</table>

                  </td>
                </tr>
              </table></td>
            </tr>
          	<tr>
	            <td height="30"></td>
	            <td></td>
	            <td></td>
            </tr>



            <tr>
            <td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width=7><img src="../image/center01_left_top.gif" /></td>
                  <td width=99% background="../image/center01_top_bg.gif" height=7 style="background-repeat:repeat-x"></td>
                  <td width=7><img src="../image/center01_right_top.gif" /></td>
                </tr>
                <tr>
                  <td background="../image/center01_left_bg.gif" width=7 style="background-repeat:repeat-y"></td>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="10">
                    <tr>
                      <td height="120" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="27" colspan="2" align="left" valign="top"><img src="../image/tit_board.gif" /></td>
                          </tr>
                          <tr>
                            <td width="13" height="30">&nbsp;</td>
                            <td valign="top">

                            	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="t_style">
                                <tr>
                                  <td width="20%" class="t_name">총게시판수</td>
                                  <td width="30%" align="right" class="t_value"><strong><?=$bbs_num?> 개</strong>&nbsp;</td>
                                  <td width="20%" class="t_name">총게시물</td>
                                  <td width="30%" align="right" class="t_value"><strong><?=$bbs_total?> 개</strong>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td height="29" class="t_name">오늘게시물</td>
                                  <td align="right" class="t_value"><strong><?=$bbs_today?> 개</strong>&nbsp;</td>
                                  <td width="20%" class="t_name">오늘댓글</td>
                                  <td width="30%" align="right" class="t_value"><strong><?=$comment_today?> 개</strong>&nbsp;</td>
                                </tr>
                              </table>

                            </td>
                          </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td background="../image/center01_right_bg.gif" width=7 style="background-repeat:repeat-y"></td>
                </tr>
                <tr>
                  <td width=7><img src="../image/center01_left_bottom.gif" /></td>
                  <td width=99% background="../image/center01_bottom_bg.gif" height=7 style="background-repeat:repeat-x"></td>
                  <td width=7><img src="../image/center01_right_bottom.gif" /></td>
                </tr>
              </table>
              </td>
            	<td>&nbsp;</td>
            	<td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="7"><img src="../image/center01_left_top.gif" /></td>
                  <td width="99%" background="../image/center01_top_bg.gif" height="7" style="background-repeat:repeat-x"></td>
                  <td width="7"><img src="../image/center01_right_top.gif" /></td>
                </tr>
                <tr>
                  <td background="../image/center01_left_bg.gif" width="7" style="background-repeat:repeat-y"></td>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="10">
                      <tr>
                        <td height="120" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td height="27" colspan="2" align="left" valign="top"><img src="../image/tit_loginfo.gif" width="78" height="14" /></td>
                            </tr>
                            <tr>
                              <td width="13" height="30">&nbsp;</td>
                              <td valign="top">
			                        	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="t_style">
	                                <tr>
	                                  <td width="20%" class="t_name">현재접속자</td>
	                                  <td width="30%" align="right" class="t_value"><strong><?=$now_cnt?> 명</strong>&nbsp;</td>
	                                  <td width="20%" class="t_name">오늘접속자</td>
	                                  <td width="30%" align="right" class="t_value"><strong><?=$today_cnt?> 명</strong>&nbsp;</td>
	                                </tr>
	                                <tr>
	                                  <td height="29" class="t_name">총접속자</td>
	                                  <td align="right" class="t_value"><strong><?=$total_cnt?> 명</strong>&nbsp;</td>
	                                  <td width="20%" class="t_name">어제접속자</td>
	                                  <td width="30%" align="right" class="t_value"><strong><?=$yester_cnt?> 명</strong>&nbsp;</td>
	                                </tr>
	                              </table>
                              </td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                  <td background="../image/center01_right_bg.gif" width="7" style="background-repeat:repeat-y"></td>
                </tr>
                <tr>
                  <td width="7"><img src="../image/center01_left_bottom.gif" /></td>
                  <td width="99%" background="../image/center01_bottom_bg.gif" height="7" style="background-repeat:repeat-x"></td>
                  <td width="7"><img src="../image/center01_right_bottom.gif" /></td>
                </tr>
              </table></td>
          	</tr>

          <tr>
            <td height="23"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="100%" align="center" valign="bottom" background="../image/member_txt_front.gif" style="background-repeat:no-repeat;padding-bottom:12px"><table width="90%" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
                    <tr>
                      <td width="30%">
                      <?
		              	  // 전체회원수
		              	  $sql = "select idx from wiz_member";
		              	  $result = mysql_query($sql);
		              	  $all_total = mysql_num_rows($result);

		              	  // 오늘가입자수
		              	  $sql = "select idx from wiz_member where wdate between '".date('Y-m-d')." 00:00:00' and '".date('Y-m-d')." 23:59:59'";
		              	  $result = mysql_query($sql);
		              	  $today_total = mysql_num_rows($result);

		              	  // 오늘탈퇴회원수
		              	  $sql = "select idx from wiz_bbs where code = '[memout]' and FROM_UNIXTIME(wdate, '%Y-%m-%d') = '".date('Y-m-d')."'";
		              	  $result = mysql_query($sql);
		              	  $today_out = mysql_num_rows($result);
		              	  ?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="5" class="t_name">
                        <tr>
                          <td align="center">오늘 가입회원</td>
                        </tr>
                        <tr>
                          <td align="center"><img src="../image/ic_arrow_red_v.gif" width="7" height="4" /></td>
                        </tr>
                        <tr>
                          <td align="center"><strong><?=$today_total?> 명</strong></td>
                        </tr>
                      </table></td>
                      <td width="30%"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="t_name">
                        <tr>
                          <td align="center">오늘 탈퇴회원</td>
                        </tr>
                        <tr>
                          <td align="center"><img src="../image/ic_arrow_red_v.gif" width="7" height="4" /></td>
                        </tr>
                        <tr>
                          <td align="center"><strong><?=$today_out?> 명</strong></td>
                        </tr>
                      </table></td>
                      <td width="30%" bgcolor="f2f2f2"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="t_name">
                        <tr>
                          <td align="center">전체회원수</td>
                        </tr>
                        <tr>
                          <td align="center"><img src="../image/ic_arrow_red_v.gif" width="7" height="4" /></td>
                        </tr>
                        <tr>
                          <td align="center"><strong><?=$all_total?> 명</strong></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="3" align="right"><img src="../image/member_txt_back.gif"></td>
                </tr>
              </table></td>
            <td>&nbsp;</td>
            <td>


            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="100%" align="center" valign="bottom" background="../image/domain_txt_front.gif" style="background-repeat:no-repeat;padding-bottom:12px">
                  <table width="90%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                      <td width="30%">
							<style type="text/css">
							#domain_box {width:100%; height:65px; overflow: auto; padding:0px; border:0 solid;}
							</style>
							<div id="domain_box" bgcolor="f2f2f2">
                      	<?
					        $no = 1;
					        $sql = "select * from wiz_otherinfo where type = 'domain' order by idx asc";
					        $result = mysql_query($sql) or error(mysql_error());
					        $total = mysql_num_rows($result);
					        while($row = mysql_fetch_object($result)){
										if($no != 1) echo "<br>";
					        ?>
                      	<table width="100%" border="0" cellspacing="0" cellpadding="3" class="t_name">
                        <tr>
                          <td width="25%" align="left">&nbsp;&nbsp;도메인</td>
                          <td width="5%" align="center"><img src="../image/ic_arrow_red_h.gif" width="4" height="7" /></td>
                          <td align="right"><strong>http://<?=$row->info01?></strong>&nbsp;&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;&nbsp;만료일</td>
                          <td align="center"><img src="../image/ic_arrow_red_h.gif" width="4" height="7" /></td>
                          <td align="right"><?=$row->info05?>&nbsp;&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;&nbsp;구입사이트</td>
                          <td align="center"><img src="../image/ic_arrow_red_h.gif" width="4" height="7" /></td>
                          <td align="right">http://<?=$row->info02?>&nbsp;&nbsp;</td>
                        </tr>
                      	</table>
                      	<?
                        	$no++;
                      	}
                      	?>
                      	</div>
                      </td>
                    </tr>
                </table></td>
                <td width="3" align="right"><img src="../image/member_txt_back.gif" /></td>
              </tr>
            	</table>


		        </td>
		        <td width="25"></td>
		      </tr>
		    </table>

<? include "$_SERVER[DOCUMENT_ROOT]/admin2/manage/foot.php"; ?>
