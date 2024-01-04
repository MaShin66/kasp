<?
	$arrW_type = array("0"=>"무관", "1"=>"정규직", "2"=>"계약직", "3"=>"계약직 후 정규직 전환", "4"=>"병역특례", "5"=>"인턴직", "6"=>"인턴 후 정규직 전환");
?>
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
  <!--    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>조회수</strong></td>
    <td width="35%" align="left" style="padding-left:10px;"><?=$count?></td>-->
    <td colspan="4" height="2" bgcolor="#a9a9a9"></td>
  </tr>
   <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>제목</strong></td>
    <td colspan="3" style="padding-left:10px;">
    <table width="100%" border="0">
    	<tr>
    		<td width="80%" align="left"><?=$catname?><?=$subject?></td>
    		<td width="20%" align="right" style="padding-right:10px"><?=$hide_recom_start?>추천:<?=$recom?><?=$hide_recom_end?></td>
    	</tr>
    </table>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>          
  <tr height="30">
    <td align="center" bgcolor="#f9f9f9" height="30" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>작성자</strong></td>
    <td align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;"><?=$name?></td>
    <td width="15%" align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>작성일</strong></td>
    <td width="35%" align="left" style="padding-left:10px;"><?=$wdate?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>          
  <tr height="30">
	<td align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>거주지</strong></td>
    <td align="left" style="padding-left:10px;"><?=$address?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>생년월일</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;"><?=$birth?></td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>성별</strong></td>
    <td width="35%" align="left" style="padding-left:10px;"><?if($gender=="1") echo "남";?><?if($gender=="2") echo "여"?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
 <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>연락처</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="left" height="30" style="padding-left:5px;"><strong>● 일반전화&nbsp;:&nbsp;&nbsp;</strong><?=$tphone?></td>			
		</tr>
		<tr>
			<td align="left" height="30" style="padding-left:5px;"><strong>● 이동전화&nbsp;:&nbsp;&nbsp;</strong><?=$hphone?></td>
		</tr>
		<tr>
			<td align="left" height="30" style="padding-left:5px;"><strong>● E - mail&nbsp;&nbsp;:&nbsp;&nbsp;</strong><?=$email?></td>
		</tr>
		</table>
	</td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>경력</strong></td>
    <td width="35%" align="left" style="padding-left:10px;"><?=$career?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
   
    <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>근무형태</strong></td>
    <td width="35%" align="left" style="padding-left:10px;border-right:1px solid #d7d7d7;">
	<?=$arrW_type[$w_type]?>			
	</td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>희망근무지</strong></td>
    <td width="35%" align="left" style="padding-left:10px;"><?=$zipcode?></td>
  </tr>  
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>지원분야</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;"><?=$w_field?></td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>희망연봉</strong></td>
	<td align="left" style="padding-left:10px;"><?=$h_salary?></td>
  </tr> 
   <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
    <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>특기사항</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><?=$addinfo3?></td>
  </tr>
   <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?=$hide_upfile_start?>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>파일첨부</strong></td>
    <td colspan="3" align="left" style="padding-left:10px;"><?=$upfile1?> <?=$upfile2?> <?=$upfile3?> <?=$upfile4?> <?=$upfile5?> <?=$upfile6?> <?=$upfile7?> <?=$upfile8?> <?=$upfile9?> <?=$upfile10?> <?=$upfile11?> <?=$upfile12?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?=$hide_upfile_end?>    
  <tr>
  <td height="50" colspan="4">
    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="left" valign="top">
				<table width="100%" cellspacing="0" cellpadding="0" style="border:1px solid #d7d7d7;">
				  
				  <tr>
					<td align="center" colspan="5" height="30" bgcolor="#f9f9f9" style="padding:10px;"><strong>학력사항</strong></td>
				  </tr>
					<td colspan="5" height="1" bgcolor="#a9a9a9"></td>
				  </tr>
				<tr height="30">
					<th style="padding-left:10px; border-right:1px solid #d7d7d7;width:30%">재학기간</th>
					<th style="padding-left:10px; border-right:1px solid #d7d7d7;">학교명</th>
					<th style="padding-left:10px; border-right:1px solid #d7d7d7;">소재지</th>
					<th style="padding-left:10px; border-right:1px solid #d7d7d7;">전공</th>
					<th style="padding-left:10px;">학점</th>
				</tr>
				 <tr>
					<td colspan="5" height="1" bgcolor="#d7d7d7"></td>
	 			  </tr>
				 <?
				  for($i =0; $i<=sizeof($addinfo6)-1; $i++){
					$eduinfo = explode("/+googic+/",$addinfo6[$i]);
					echo "<tr height='30'>";
					echo "<td align='center' style='padding-left:5px;border-right:1px solid #d7d7d7;'>$eduinfo[0] ~ $eduinfo[1]</td>";
					echo "<td align='center' style='padding-left:5px;border-right:1px solid #d7d7d7;'>$eduinfo[2]</td>";
					echo "<td align='center' style='padding-left:5px;border-right:1px solid #d7d7d7;'>$eduinfo[3]</td>";
					echo "<td align='center' style='padding-left:5px;border-right:1px solid #d7d7d7;'>$eduinfo[4]</td>";
					echo "<td align='center' style='padding-left:5px;'>$eduinfo[5] / $eduinfo[6]</td>";
					echo "</tr>";
					if($i != sizeof($addinfo6)-1)echo "<tr><td colspan='5' height='1' bgcolor='#d7d7d7'></td></tr>";
				  }
				 ?>		
			</table>
			</td>
		</tr>
	    <tr>
			<td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border:1px solid #d7d7d7;"><strong>경력사항</strong></td>
		  </tr>
		<tr>
          <td align="left" style="padding-top:5px">
      		<?=$content1?>
          </td>
        </tr>
		  <tr>
			<td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border:1px solid #d7d7d7;"><strong>자기소개서</strong></td>
		  </tr>
		<tr>
		  <td align="left" style="padding-top:5px">
      		<?=$content2?>
          </td>
        </tr>
    	</table>
    </td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>          
  <tr>
    <td width="15%" align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>이전글</strong></td>
    <td width="85%" align="left" colspan="3" style="padding-left:10px;"><?=$prev?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>          
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>다음글</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><?=$next?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
  	<td height="10"></td>
  </tr>
</table>
