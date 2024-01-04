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

<? if($idx%4 == 0) echo "<tr>"; ?>

<td width="25%" align="center" valign="top">
  <table cellpadding=0 cellspacing=0 border=0>
    <tr>
      <td align=center><table cellpadding=5 cellspacing=1 bgcolor="E6E6E6">
        <tr>
          <td background="img/gallery_photo_bg.gif"><a href="<?=$prdurl?>"><img src="<?=$prdimg?>" border="0"></a></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="20" align=center valign="top"><?=$prdname?></td>
    </tr>
    <tr>
      <td height="20" align=center valign="top"><?=$prdprice?>원</td>
    </tr>
    <tr><td height="10"></td></tr>
  </table>
</td>
