<?
	
$sql = "select * from wiz_prdinfo";
$result = mysql_query($sql) or error(mysql_error());
$prd_info = mysql_fetch_array($result);

$sql = "select prd_skin from wiz_category order by catcode asc limit 1";
$result = mysql_query($sql) or error(mysql_error());
$row = mysql_fetch_array($result);

// 스킨위치
$skin_dir = "/admin2/product/skin/".$prd_info[skin];
if(!empty($row[prd_skin])) $skin_dir = "/admin2/product/skin/".$row[prd_skin];

$prdimg_max = 8; // 상품사진 : 최대12까지가능
$prdfile_max = 5; // 첨부파일 : 최대5까지가능

?>
