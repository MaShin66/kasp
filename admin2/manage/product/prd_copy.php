<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?
if($mode != "copy"){
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>상품복사</title>
<link href="../wiz_style.css" rel="stylesheet" type="text/css">
<script language="javascript">
<!--
function inputCheck(frm){

	if(!confirm("상품을 복사하시겠습니까?")){
		return false;
	} else {
		frm.mode.value = "copy";
	}
}

function catChange(form, idx){
   if(idx == "1"){
      form.dep2_code.options[0].selected = true;
      form.dep3_code.options[0].selected = true;
   }else if(idx == "2"){
      form.dep3_code.options[0].selected = true;
   }
   	form.mode.value = "";
   	form.submit();
}

-->
</script>
<body>
<table align="center" width="100%" border="0" cellspacing="10" cellpadding="0">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 상품복사</td>
        </tr>
      </table>

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<form name="frm" action="<?=$PHP_SELF?>" method="post" onSubmit="return inputCheck(this)">
			<input type="hidden" name="mode" value="">
			<input type="hidden" name="selvalue" value="<?=$selvalue?>">
			  <tr>
			    <td>
			      <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
			        <tr>
			          <td width="40%" align="center" class="t_name">복사할 상품분류</td>
			          <td width="60%" class="t_value">

			          	<select name="dep_code" onChange="catChange(this.form,'1');">
			            <option value=''>:: 대분류 ::
			            <?
			            $sql = "select substring(catcode,1,2) as catcode, catname from wiz_category where depthno = 1 order by priorno01 asc";
			            $result = mysql_query($sql) or error(mysql_error());
			            while($row = mysql_fetch_object($result)){
			               if($row->catcode == $dep_code)
			                  echo "<option value='$row->catcode' selected>$row->catname";
			               else
			                  echo "<option value='$row->catcode'>$row->catname";
			            }
			            ?>
			            </select>
			          	<select name="dep2_code" onChange="catChange(this.form,'2');" class="select">
			            <option value=''> :: 중분류 ::
			            <?
			            if($dep_code != ''){
			               $sql = "select substring(catcode,3,2) as catcode, catname from wiz_category where depthno = 2 and catcode like '$dep_code%' order by priorno02 asc";
			               $result = mysql_query($sql) or error(mysql_error());
			               while($row = mysql_fetch_object($result)){
			                  if($row->catcode == $dep2_code)
			                     echo "<option value='$row->catcode' selected>$row->catname";
			                  else
			                     echo "<option value='$row->catcode'>$row->catname";
			               }
			            }
			            ?>
			            </select>
			            <select name="dep3_code" onChange="catChange(this.form,'3');" class="select">
			            <option value=''> :: 소분류 ::
			            <?
			            if($dep_code != '' && $dep2_code != ''){
			               $sql = "select substring(catcode,5,2) as catcode, catname from wiz_category where depthno = 3 and catcode like '$dep_code$dep2_code%' order by  priorno03 asc";
			               $result = mysql_query($sql) or error(mysql_error());
			               while($row = mysql_fetch_object($result)){
			                  if($row->catcode == $dep3_code)
			                     echo "<option value='$row->catcode' selected>$row->catname";
			                  else
			                     echo "<option value='$row->catcode'>$row->catname";
			               }
			            }
			            ?>
			            </select>&nbsp;

			          </td>
			        </tr>
			      </table>
			    </td>
			  </tr>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center" style="padding:7px">
						<input type="submit" value=" 상품복사 " class="btn_m">
						<input type="button" value=" 닫기 " class="btn_m" onClick="self.close();">
					</td>
				</tr>
			</form>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
<?
}else{

	$upfile_path = WIZHOME_PATH."/data/product/";

	$selarr = explode("|",$selvalue);

	for($ii=count($selarr); $ii>=0; $ii--){

		if($selarr[$ii]!=""){

			 // 상품넘버 만들기
		   $sql = "select max(prdcode) as prdcode, max(prior) as prior from wiz_product";
		   $result = mysql_query($sql) or error(mysql_error());
		   if($row = mysql_fetch_object($result)){

		      $datenum = substr($row->prdcode,0,6);
		      $prdnum = substr($row->prdcode,6,4);
		      $prdnum = substr("000".(++$prdnum),-4);

		      if($datenum == date('ymd')) $prdcode = $datenum.$prdnum;
		      else $prdcode = date('ymd')."0001";

					// 상품진열 순서
		   		$prior = $row->prior + 1;

		   }else{
		      $prdcode = date('ymd')."0001";

					// 상품진열 순서
					$prior = date(ymdHis);

		   }

			$sql = "select * from wiz_product where prdcode='$selarr[$ii]'";
			$result = mysql_query($sql) or error(mysql_error());
			$row = mysql_fetch_array($result);

			$prdimg_ext = strtolower(substr($row["prdimg_R"],-3));
			$prdimg_R_name = $prdcode."_R.".$prdimg_ext;
			@copy($upfile_path."/".$row["prdimg_R"], $upfile_path."/".$prdimg_R_name);

			for($jj = 1; $jj <= 12; $jj++) {

				$prdimg_L_ext = strtolower(substr($row["prdimg_L".$jj],-3));
				$prdimg_M_ext = strtolower(substr($row["prdimg_M".$jj],-3));
				$prdimg_S_ext = strtolower(substr($row["prdimg_S".$jj],-3));

				${"prdimg_L".$jj."_name"} = $prdcode."_L".$jj.".".$prdimg_L_ext;
				${"prdimg_M".$jj."_name"} = $prdcode."_M".$jj.".".$prdimg_M_ext;
				${"prdimg_S".$jj."_name"} = $prdcode."_S".$jj.".".$prdimg_S_ext;

				if(!empty($row["prdimg_L".$jj])) @copy($upfile_path."/".$row["prdimg_L".$jj], $upfile_path."/".${"prdimg_L".$jj."_name"});
				if(!empty($row["prdimg_M".$jj])) @copy($upfile_path."/".$row["prdimg_M".$jj], $upfile_path."/".${"prdimg_M".$jj."_name"});
				if(!empty($row["prdimg_S".$jj])) @copy($upfile_path."/".$row["prdimg_S".$jj], $upfile_path."/".${"prdimg_S".$jj."_name"});

			}

			for($jj = 1; $jj <= 5; $jj++) {

				$upfile_ext = strtolower(substr($row["upfile".$jj],-3));

				${"upfile".$jj."_tmp"} = $prdcode."_".$jj.".".$upfile_ext;
				${"upfile".$jj."_name"} = $row["upfile".$jj."_name"];

				if(!empty($row["upfile".$jj])) @copy($upfile_path."/".$row["upfile".$jj], $upfile_path."/".${"upfile".$jj."_tmp"});

			}

		for($jj = 1; $jj <= 10; $jj++) {
			$row['info_name'.$jj] = addslashes($row['info_name'.$jj]);
			$row['info_value'.$jj] = addslashes($row['info_value'.$jj]);

			$row['addinfo'.$jj] = addslashes($row['addinfo'.$jj]);
		}

   $row[content] = addslashes($row[content]);
   $row[shortexp] = addslashes($row[shortexp]);

	 // 상품정보 저장
   $sql = "insert into wiz_product
							(prdcode,prdnum,prdname,prdprice,showset,prior,prdicon,recom,
							info_name1,info_value1,info_name2,info_value2,info_name3,info_value3,info_name4,info_value4,info_name5,info_value5,
							info_name6,info_value6,info_name7,info_value7,info_name8,info_value8,info_name9,info_value9,info_name10,info_value10,
							addinfo1,addinfo2,addinfo3,addinfo4,addinfo5,prdimg_R,prdimg_L1,prdimg_M1,prdimg_S1,prdimg_L2,prdimg_M2,prdimg_S2,
							prdimg_L3,prdimg_M3,prdimg_S3,prdimg_L4,prdimg_M4,prdimg_S4,prdimg_L5,prdimg_M5,prdimg_S5,
							prdimg_L6,prdimg_M6,prdimg_S6,prdimg_L7,prdimg_M7,prdimg_S7,prdimg_L8,prdimg_M8,prdimg_S8,
							prdimg_L9,prdimg_M9,prdimg_S9,prdimg_L10,prdimg_M10,prdimg_S10,prdimg_L11,prdimg_M11,prdimg_S11,
							prdimg_L12,prdimg_M12,prdimg_S12,upfile1,upfile2,upfile3,upfile4,upfile5,
							upfile1_name,upfile2_name,upfile3_name,upfile4_name,upfile5_name,shortexp,content)
							values('$prdcode','$prdnum','$row[prdname]','$row[prdprice]','$row[showset]','$prior','$row[prdicon]','$row[recom]',
							'$row[info_name1]','$row[info_value1]','$row[info_name2]','$row[info_value2]','$row[info_name3]','$row[info_value3]','$row[info_name4]','$row[info_value4]','$row[info_name5]','$row[info_value5]',
							'$row[info_name6]','$row[info_value6]','$row[info_name7]','$row[info_value7]','$row[info_name8]','$row[info_value8]','$row[info_name9]','$row[info_value9]','$row[info_name10]','$row[info_value10]',
							'$row[addinfo1]','$row[addinfo2]','$row[addinfo3]','$row[addinfo4]','$row[addinfo5]',
							'$prdimg_R_name','$prdimg_L1_name','$prdimg_M1_name','$prdimg_S1_name',
							'$prdimg_L2_name','$prdimg_M2_name','$prdimg_S2_name',
							'$prdimg_L3_name','$prdimg_M3_name','$prdimg_S3_name',
							'$prdimg_L4_name','$prdimg_M4_name','$prdimg_S4_name',
							'$prdimg_L5_name','$prdimg_M5_name','$prdimg_S5_name',
							'$prdimg_L6_name','$prdimg_M6_name','$prdimg_S6_name',
							'$prdimg_L7_name','$prdimg_M7_name','$prdimg_S7_name',
							'$prdimg_L8_name','$prdimg_M8_name','$prdimg_S8_name',
							'$prdimg_L9_name','$prdimg_M9_name','$prdimg_S9_name',
							'$prdimg_L10_name','$prdimg_M10_name','$prdimg_S10_name',
							'$prdimg_L11_name','$prdimg_M11_name','$prdimg_S11_name',
							'$prdimg_L12_name','$prdimg_M12_name','$prdimg_S12_name',
							'$upfile1_tmp','$upfile2_tmp','$upfile3_tmp','$upfile4_tmp','$upfile5_tmp',
							'$upfile1_name','$upfile2_name','$upfile3_name','$upfile4_name','$upfile5_name',
							'$row[shortexp]','$row[content]')";
			mysql_query($sql) or error(mysql_error());

		  // 카테고리 정보 저장
			if(empty($dep2_code)) $dep2_code = "00";
			if(empty($dep3_code)) $dep3_code = "00";

			$catcode = $dep_code.$dep2_code.$dep3_code;

			$sql = "insert into wiz_cprelation(idx,prdcode,catcode) values('', '$prdcode', '$catcode')";
			$result = mysql_query($sql) or error(mysql_error());

		}
	}

	echo "<script>alert('복사 되었습니다.');opener.document.location='prd_list.php?dep_code=$dep_code&dep2_code=$dep2_code&dep3_code=$dep3_code';self.close();</script>";

}
?>
