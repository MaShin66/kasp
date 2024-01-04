<?
/*
$prdurl			: 상품상세 페이지
$prdname		: 상품명
$prdprice		: 상품가격
$prdnum			: 상품코드
$prdimg			: 상품이미지
$viewimg		: 상품상세보기 이미지
$shortexp		: 상품간단설명
*/
?>
  <tr><td height="2"></td></tr>
	<tr>
	  <td align="center" width="15%" style="padding:2px"><a href="<?=$prdurl?>"><img src="<?=$prdimg?>" width="60" height="60" border="0"></a></td>
	  <td align="left" width="70%" style="padding-left:10px">
	  	<strong><?=$prdname?></strong><br>
	    <span class="s02"><?=$shortexp?></span>
	  </td>
	  <td align="center" width="15%"><?=$viewimg?></td>
	</tr>
	<tr>
	  <td colspan="10" height="1" bgcolor="#d7d7d7"></td>
	</tr>
