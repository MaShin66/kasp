<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/inc/prd_info.php";

if($_GET[catcode] != "") $catcode = $_GET[catcode];

if($catcode == "") $catcode = "000000";
$param = "catcode=$catcode&searchopt=$searchopt&searchkey=$searchkey";

// 카테고리 정보
$catcode1 = substr($catcode,0,2);
$catcode2 = substr($catcode,0,4);
$position = "";

$sql = "select * from wiz_category where catuse != 'N' and (
						catcode = '000000'
						or (catcode like '$catcode1%' and depthno = 1)
						or (catcode like '$catcode2%' and depthno = 2)
						or (catcode = '$catcode')) order by priorno01 asc, priorno02 asc, priorno03 asc";

$result = mysql_query($sql) or error(mysql_error());

while($row = mysql_fetch_array($result)){
	if($catcode == $row[catcode]){
		$cat_info = $row;
		$catname = $row[catname];
		$parname = $tmp_catname;

		// 스킨위치
		if(!empty($row[prd_skin])) $skin_dir = "/admin/product/skin/".$row[prd_skin];
	}
	if(is_file(WIZHOME_PATH."/data/product/".$row[catimg])) $catimg = "<img src='/admin/data/product/".$row[catimg]."'>";
	$position .= " &gt; <a href='$PHP_SELF?ptype=list&catcode=".$row[catcode]."'>".$row[catname]."</a>";
	$tmp_catname = $row[catname];
}

echo "<link href=\"".$skin_dir."/style.css\" rel=\"stylesheet\" type=\"text/css\">";

if($cat_info[depthno] == 1) $tmp_catcode = substr($catcode,0,2);
else if($cat_info[depthno] == 2) $tmp_catcode = substr($catcode,0,4);
else if($cat_info[depthno] == 3) $tmp_catcode = substr($catcode,0,4);
if($cat_info[depthno] < 3) $cat_info[depthno]++;

$ii = 0;
$sql = "select catcode, catname, depthno, purl from wiz_category where catuse != 'N' and catcode like '$tmp_catcode%' and depthno = '".$cat_info[depthno]."' order by priorno01, priorno02, priorno03 asc";
$result = mysql_query($sql) or error(mysql_error());
while($row = mysql_fetch_array($result)){
	if($catcode == $row[catcode]) $row[catname] = "<strong>".$row[catname]."</strong>";
	if(!empty($row[purl])) $purl = "/".$row[purl];
	else $purl = $PHP_SELF;
	$catlist[$ii] = "<a href='$purl?ptype=list&catcode=".$row[catcode]."'>".$row[catname]."</a>";
	$ii++;
}


// 카테고리파일
include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/category.php";



// 상품 쿼리
if($catcode != ""){
	$catcode01 = str_replace("00","",substr($catcode,0,2));
	$catcode02 = str_replace("00","",substr($catcode,2,2));
	$catcode03 = str_replace("00","",substr($catcode,4,2));
	$tmpcode = $catcode01.$catcode02.$catcode03;
}

if($tmpcode != "") $catcode_sql = " and wc.catcode like '$tmpcode%' ";
if($searchkey != "") $search_sql = " and wp.$searchopt like '%$searchkey%' ";
$sql = "select distinct wp.prdcode,wp.prdnum,wp.prdname,wp.prdprice,wp.shortexp,wp.prdimg_R
			from wiz_product wp, wiz_cprelation wc, wiz_category wcat
			where wp.prdcode = wc.prdcode and wcat.catcode = wc.catcode and wcat.catuse != 'N' $catcode_sql $search_sql
			order by wp.prior desc, wp.prdcode desc";
$result = mysql_query($sql) or error(mysql_error());
$total = mysql_num_rows($result);

$idx = 0;

if(!empty($cat_info[prd_num])) $rows = $cat_info[prd_num];
else $rows = 20;
$lists = 5;
$page_count = ceil($total/$rows);
if(!$page || $page > $page_count) $page = 1;
$start = ($page-1)*$rows;
$no = $total-$start;

// 상단파일
include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/list_head.php";

$sql = "select distinct wp.prdcode,wp.prdnum,wp.prdname,wp.prdprice,wp.shortexp,wp.prdimg_R
			from wiz_product wp, wiz_cprelation wc, wiz_category wcat
			where wp.prdcode = wc.prdcode and wcat.catcode = wc.catcode and wcat.catuse != 'N' $catcode_sql $search_sql
			order by wp.prior desc, wp.prdcode desc limit $start, $rows";
$result = mysql_query($sql) or error(mysql_error());

while($row = mysql_fetch_array($result)){

	$prdurl = $PHP_SELF."?ptype=view&prdcode=".$row[prdcode]."&catcode=". $catcode ."&page=".$page."&".$param;
	$content = str_replace("\n","",$row[content]);
	$prdnum = $row[prdnum];
	$prdimg = "/admin/data/product/".$row[prdimg_R];
	$prdprice = number_format($row[prdprice]);
	$prdname = "<a href='".$PHP_SELF."?ptype=view&prdcode=".$row[prdcode]."&catcode=". $catcode ."&page=".$page."&".$param."'>".$row[prdname]."</a>";
	$shortexp = "<a href='".$PHP_SELF."?ptype=view&prdcode=".$row[prdcode]."&catcode=". $catcode ."&page=".$page."&".$param."'>".cut_str($row[shortexp],120)."</a>";
	$viewimg = "<a href='".$PHP_SELF."?ptype=view&prdcode=".$row[prdcode]."&catcode=". $catcode ."&page=".$page."&".$param."'><img src='$skin_dir/image/bt_view.gif' border='0'></a>";

	include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/list_body.php";

	$no--;
	$idx++;
}


// 하단파일
include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/list_foot.php";


?>
