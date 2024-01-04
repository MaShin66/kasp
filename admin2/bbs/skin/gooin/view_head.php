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

  <tr>
    <td align="center" bgcolor="#f9f9f9" height="30" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>기관명</strong></td>
    <td align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;"><?=$addinfo1[0]?></td>
    <td align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>작성일</strong></td>
    <td align="left" style="padding-left:10px;"><?=$wdate?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>          
  <tr>
    <td width="15%" align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>기관개요</strong></td>
    <td width="35%" align="left" colspan="3" style="padding-left:10px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td align="left" height="30" style="padding-left:10px;"><strong>● 설립년도&nbsp;:&nbsp;</strong><?=$addinfo1[1]?></td>
			<td align="left" height="30"><strong>● 소재지&nbsp;:&nbsp;</strong><?=$address?></td>
		  </tr>
		  <tr>
			<td align="left" height="30" style="padding-left:10px;"><strong>● 기업형태&nbsp;:&nbsp;</strong>
				<?
					if($addinfo2[0] == 1)echo"중소기업";
					elseif($addinfo2[0] == 2)echo"중견기업";
					elseif($addinfo2[0] == 3)echo"대기업";
					elseif($addinfo2[0] == 4)echo"대기업자회사";
					elseif($addinfo2[0] == 5)echo"벤쳐기업";
					elseif($addinfo2[0] == 6)echo"공공기관";
					elseif($addinfo2[0] == 7)echo"외국계";
					elseif($addinfo2[0] == 8)echo"비영리단체/협회/교육기관/재단";
				?>
			</td>
			<td align="left" height="30" ><strong>● 사원수&nbsp;:&nbsp;</strong><?=$addinfo2[1]?>&nbsp;명</td>
		  </tr>
		  <tr>
			<td align="left" height="30" style="padding-left:10px;"><strong>● 홈페이지&nbsp;:&nbsp;</strong><?=$addinfo2[2]?></td>
			<td align="left" height="30" ><strong>● 매출액&nbsp;:&nbsp;</strong><?=$addinfo1[2]?>&nbsp;만원</td>
		  </tr>
		</table>
	</td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
    <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>지원자격</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="left" height="30" style="padding-left:10px;"><strong>● 경력&nbsp;:&nbsp;</strong><?=$addinfo3[0]?></td>			
		</tr>
		<tr>
			<td align="left" height="30" style="padding-left:10px;"><strong>● 학력&nbsp;:&nbsp;</strong><?=$addinfo3[1]?></td>
		</tr>
		</table>
	</td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:5px; border-right:1px solid #d7d7d7;"><strong>근무조건</strong></td>
    <td width="35%" align="left" style="padding-left:5px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="left" height="30" style="padding-left:5px;"><strong>● 급&nbsp&nbsp&nbsp여&nbsp&nbsp&nbsp&nbsp;:&nbsp;</strong>
					<?
						if($addinfo9 == 1)echo"회사내규";
						elseif($addinfo9 == 2)echo"면접 후 협의";
						elseif($addinfo9 == 3)echo"1500";
						elseif($addinfo9 == 4)echo"1500~2000";
						elseif($addinfo9 == 5)echo"2000~2500";
						elseif($addinfo9 == 6)echo"2500~3000";
						elseif($addinfo9 == 7)echo"3000~3500";
						elseif($addinfo9 == 8)echo"3500~4000";
						elseif($addinfo9 == 9)echo"4000~4500";
						elseif($addinfo9 == 10)echo"4500~5000";
						elseif($addinfo9 == 11)echo"5000~5500";
						elseif($addinfo9 == 12)echo"5500~6000";
						elseif($addinfo9 == 13)echo"6000~7000";
						elseif($addinfo9 == 14)echo"7000~8000";
						elseif($addinfo9 == 15)echo"8000~9000";
						elseif($addinfo9 == 16)echo"9000~1억";
						elseif($addinfo9 == 17)echo"1억이상";
					?>
				</td>			
			</tr>
			<tr>
				<td align="left" height="30" style="padding-left:5px;"><strong>● 지&nbsp&nbsp&nbsp역&nbsp&nbsp&nbsp&nbsp;:&nbsp;&nbsp;</strong><?=$zipcode?>
				</td>
			</tr>
			<tr>
				<td align="left" height="30" style="padding-left:5px;"><strong>● 고용형태&nbsp;:&nbsp;</strong>
				<?
						if($addinfo4[0] == 0)echo"무관";
						elseif($addinfo4[0] == 1)echo"정규직";
						elseif($addinfo4[0] == 2)echo"계약직";
						elseif($addinfo4[0] == 3)echo"계약직 후 정규직";
						elseif($addinfo4[0] == 4)echo"병역특례";
						elseif($addinfo4[0] == 5)echo"인턴직";
						elseif($addinfo4[0] == 6)echo"인턴 후 정규직";

				?>			
				</td>
			</tr>
		</table>
	</td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
   <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>접수기간</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;">
		<?=$addinfo3[2]?> ~ <?=$addinfo3[3]?>
	</td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>접수방법</strong></td>
    <td width="35%" align="left" style="padding-left:10px;"><?=$addinfo4[1]?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
   <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>근무시간</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="left" height="30" style="padding-left:10px;"><strong>● 평일&nbsp;:&nbsp;</strong><?=$addinfo4[3]?></td>			
		</tr>
		<tr>
			<td align="left" height="30" style="padding-left:10px;"><strong>● 주말&nbsp;:&nbsp;</strong><?=$addinfo4[4]?></td>
		</tr>
		</table>
	</td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>근무분야</strong></td>
    <td width="35%" align="left" style="padding-left:10px;"><?=$addinfo4[2]?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>복리후생</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><?=$addinfo5?></td>
  </tr>
   <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
	 <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>담당자</strong></td>
	 <td width="35%" align="left" colspan="3" style="padding-left:5px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td align="left" height="30" style="padding-left:10px;"><strong>● 성&nbsp;&nbsp;&nbsp;명&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong><?=$name ?>
				<td align="left" height="30" style="padding-left:10px;"><strong>● E - mail&nbsp;&nbsp;:&nbsp;</strong><?=$email ?></td>
			  </tr>
			  <tr>
				<td align="left" height="30" style="padding-left:10px;"><strong>● 일반전화&nbsp;:&nbsp;</strong><?=$tphone?></td>
				<td align="left" height="30" style="padding-left:10px;"><strong>● 이동전화&nbsp;:&nbsp;</strong><?=$hphone?></td>
			  </tr>
			</table>
	</td>
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
    <td colspan="4" height="3"></td>
  </tr>
  <tr>
    <td colspan="4" height="4" bgcolor="#a9a9a9"></td>
  </tr>
  <tr>
    <td align="center" colspan="4" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>상세요강</strong></td>
  <tr>
    <td colspan="4" height="2" bgcolor="#a9a9a9"></td>
  </tr>
  <tr>
    <td height="50" colspan="4">
    	<table width="100%" border="0" cellpadding="10" cellspacing="0">
        <tr>
          <td align="left" style="padding-top:5px">
          <?=$upimg1?><?=$upimg2?><?=$upimg3?><?=$upimg4?><?=$upimg5?><?=$upimg6?>
        	<?=$upimg7?><?=$upimg8?><?=$upimg9?><?=$upimg10?><?=$upimg11?><?=$upimg12?>
      		<?=$movie1?><?=$movie2?><?=$movie3?>
      		<?=$content?>
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
