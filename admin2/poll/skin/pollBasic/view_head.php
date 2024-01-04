<script language="javascript">
<!--
function viewImg(img){
   var url = "/admin2/bbs/view_img.php?code=<?=$code?>&img=" + img;
   window.open(url, "viewImg", "height=100, width=100, menubar=no, scrollbars=no, resizable=yes, toolbar=no, status=no");
}
//-->
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" height="2" bgcolor="#a9a9a9"></td>
  </tr>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>제목</strong></td>
    <td colspan="3" style="padding-left:10px;"><b><?=$subject?></b></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>         
  <tr>
    <td align="center" width="15%" bgcolor="#f9f9f9" height="30" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>기간</strong></td>
    <td align="left" width="55%" style="padding-left:10px; border-right:1px solid #d7d7d7;"><?=$sdate?> ~ <?=$edate?></td>
    <td align="center" width="15%" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>조회수</strong></td>
    <td align="left" width="15%" style="padding-left:10px;"><?=$cnt?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>   
  <tr>
    <td height="50" colspan="4" align="center">
    	<table width="100%" border="0" cellpadding="10" cellspacing="0">
        <tr>
          <td align="left" style="padding-top:10px">
          <?=$content?>
          </td>
        </tr>
    	</table>
    	<table cellspacing="0" cellpadding="10" border="0" width="95%">
			<form name="voteForm" method="post">
			<tr>
			<td style="padding-top:10px">
			<?
			$no = 0;
      $sql = "select * from wiz_polldata where pidx = '$idx' order by idx asc";
      $result = mysql_query($sql);
      while($row = mysql_fetch_array($result)){
      	
      	$total_count = $row[count01]+$row[count02]+$row[count03]+$row[count04]+$row[count05]+$row[count06]+$row[count07]+$row[count08]+$row[count09]+$row[count10];
      	if($total_count == 0) $total_count = 1;
      	
      	$answer_list[0][0] = $row[answer01];
      	$answer_list[0][1] = $row[count01];
      	$answer_list[0][2] = "count01";
				$answer_list[0][3] = round(($row[count01]/$total_count)*100,1);

				$answer_list[1][0] = $row[answer02];
      	$answer_list[1][1] = $row[count02];
      	$answer_list[1][2] = "count02";
      	$answer_list[1][3] = round(($row[count02]/$total_count)*100,1);
      	
      	$answer_list[2][0] = $row[answer03];
      	$answer_list[2][1] = $row[count03];
      	$answer_list[2][2] = "count03";
      	$answer_list[2][3] = round(($row[count03]/$total_count)*100,1);
      	
      	$answer_list[3][0] = $row[answer04];
      	$answer_list[3][1] = $row[count04];
      	$answer_list[3][2] = "count04";
      	$answer_list[3][3] = round(($row[count04]/$total_count)*100,1);
      	
      	$answer_list[4][0] = $row[answer05];
      	$answer_list[4][1] = $row[count05];
      	$answer_list[4][2] = "count05";
      	$answer_list[4][3] = round(($row[count05]/$total_count)*100,1);
      	
      	$answer_list[5][0] = $row[answer06];
      	$answer_list[5][1] = $row[count06];
      	$answer_list[5][2] = "count06";
      	$answer_list[5][3] = round(($row[count06]/$total_count)*100,1);
      	
      	$answer_list[6][0] = $row[answer07];
      	$answer_list[6][1] = $row[count07];
      	$answer_list[6][2] = "count07";
      	$answer_list[6][3] = round(($row[count07]/$total_count)*100,1);
      	
      	$answer_list[7][0] = $row[answer08];
      	$answer_list[7][1] = $row[count08];
      	$answer_list[7][2] = "count08";
      	$answer_list[7][3] = round(($row[count08]/$total_count)*100,1);
      	
      	$answer_list[8][0] = $row[answer09];
      	$answer_list[8][1] = $row[count09];
      	$answer_list[8][2] = "count09";
      	$answer_list[8][3] = round(($row[count09]/$total_count)*100,1);
      	
      	$answer_list[9][0] = $row[answer10];
      	$answer_list[9][1] = $row[count10];
      	$answer_list[9][2] = "count10";
      	$answer_list[9][3] = round(($row[count10]/$total_count)*100,1);
      	
      ?>
      <table cellspacing=0 cellpadding=0 border=0 width=100%>
      	<input type="hidden" name="qidx<?=$no?>" value="<?=$row[idx]?>">
        <tr><td bgcolor="#efefef" height="25" align="left" style="padding-left:10px"><b><?=$row[question]?></b></td></tr>
      <?
      	for($ii=0;$ii<10;$ii++){
      		if($answer_list[$ii][0] != ""){
      ?>
        <tr> 
          <td valign=top style="padding-top:5px"> 
            <table width=100% cellspacing=0 cellpadding=0 border=0>
              <tr> 
                <td width="60%" valign="top" height="20" align="left" style="padding-left:10px"> 
                	<? if($polluse != "N"){ ?>
                	<input onFocus=this.blur(); type=radio name="answer<?=$no?>" value="<?=$answer_list[$ii][2]?>">
                	<? } ?>
                	<?=$answer_list[$ii][0]?>
                </td>
                <td width="25%" valign=top align=right> 
                  <table cellspacing=0 cellpadding=0 border=0>
                    <tr> 
                      <td height=5></td>
                    </tr>
                    <tr> 
                      <td align=middle height=12> 
                        <table height=10 cellspacing=0 cellpadding=0 width=150 border=0>
                          <tr> 
                            <td width="<?=$answer_list[$ii][3]?>%" bgcolor="red" height=10></td>
                            <td width=43 height=10></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr> 
                      <td height=5></td>
                    </tr>
                  </table>
                </td>
                <td width="15%" valign=top> 
                  <table cellspacing=0 cellpadding=0 width="100%" border=0>
                    <tr valign=center> 
                      <td height=20>&nbsp; <?=$answer_list[$ii][1]?> (<?=$answer_list[$ii][3]?>%) </td>
                    </tr>
                  </table>
                </td>
              </tr>
              </tbody> 
            </table>
          </td>
        </tr>
        <?
        		}
        	}
				?>
				<tr> 
          <td height=20></td>
        </tr>
        </table>
				<?
					$no++;
      	}
        ?>

        <? if($polluse != "N"){ ?>
        <table cellspacing=0 cellpadding=0 border=0 width=94%>
        <tr> 
          <td align="center" height=30><a href="javascript:vote();"><img src="<?=$skin_dir?>/image/bt_vote_ok.gif" align=absMiddle border=0 width=77 height=25></a></td>
        </tr>
        </table>
        <? } ?>

			</td>
		  </tr>
		  </form>
	    </table>
    </td>
  </tr>
</table>
