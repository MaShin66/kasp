<?php
$rel_sql = "select wr.idx,wp.prdcode,wp.prdname,wp.prdimg_R,wp.prdprice
						from wiz_prdrelation wr, wiz_product wp
						where wr.relcode = wp.prdcode and wr.prdcode = '$prdcode' and wp.showset != 'N'";
$rel_result = mysql_query($rel_sql) or error(mysql_error());
$rel_total = mysql_num_rows($rel_result);

if($rel_total > 0) {
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" bgcolor="ebebeb"><img src="<?=$skin_dir?>/image/tit_relation_front.gif" width="136" height="21" /></td>
        <td align="right" bgcolor="ebebeb"><img src="<?=$skin_dir?>/image/tit_contents_back.gif" width="15" height="21" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="5"></td>
  </tr>
  <tr>
    <td align="left">
	  	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	      <tr valign="top">
				<?php
				$no = 0;
				while($rel_row = mysql_fetch_object($rel_result)) {
					if($no%5 == 0 && $no > 0) echo "</tr><tr>";

					$rel_row->prdprice = number_format($rel_row->prdprice)."원";

					// 상품 이미지
					if(!@file($_SERVER[DOCUMENT_ROOT]."/admin/data/product/".$rel_row->prdimg_R)) $rel_row->prdimg_R = $skin_dir."/image/noimg_R.gif";
					else $rel_row->prdimg_R = "/admin/data/product/".$rel_row->prdimg_R;

					$rel_prd_view_page = $_SERVER['PHP_SELF']."?ptype=view&prdcode=".$rel_row->prdcode;

				?>
					<td width="20%" align="center" valign="top">
	           <table width="140" border="0" cellpadding="0" cellspacing="0" class="pro_list">
	              <tr>
	                <td class="prd"><a href="<?=$rel_prd_view_page?>"><img src="<?=$rel_row->prdimg_R?>" width="130" height="130" border="0"></a></td>
	              </tr>
	              <tr>
	                <td height="15"></td>
	              </tr>
	              <tr>
	                <td class="subject"><a href="<?=$rel_prd_view_page?>"><?=cut_str($rel_row->prdname,20)?></a></td>
	              </tr>
	              <tr>
	                <td class="price"><?=$rel_row->prdprice?></td>
	              </tr>
	              <tr>
	                <td height="20"></td>
	              </tr>
	            </table>
	          </td>
				<?php
					$no++;
				}
				?>
				</tr>
			</table>
    </td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
</table>
<?php
}
?>