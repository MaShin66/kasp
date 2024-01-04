<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/inc/prd_info.php";

if($_GET[catcode] != "") $catcode = $_GET[catcode];

$param = "searchopt=$searchopt&searchkey=$searchkey";

// 상품정보
$sql = "select wp.*, wc.catcode, wcat.prd_skin
				from wiz_product as wp left join wiz_cprelation as wc on wp.prdcode = wc.prdcode
				left join wiz_category as wcat on wc.catcode = wcat.catcode
				where wp.prdcode='$prdcode'";
$result = mysql_query($sql) or error(mysql_error());
$row = mysql_fetch_array($result);

// 스킨위치
if(!empty($row[prd_skin])) $skin_dir = "/admin/product/skin/".$row[prd_skin];

echo "<link href=\"".$skin_dir."/style.css\" rel=\"stylesheet\" type=\"text/css\">";

$shortexp = nl2br($row[shortexp]);
$content = $row[content];
$prdimg = "/admin/data/product/".$row[prdimg_M1];
$prdname = $row[prdname];

$prdimg_S1 = $row[prdimg_S1];
$prdimg_S2 = $row[prdimg_S2];
$prdimg_S3 = $row[prdimg_S3];
$prdimg_S4 = $row[prdimg_S4];
$prdimg_S5 = $row[prdimg_S5];
$prdimg_S6 = $row[prdimg_S6];
$prdimg_S7 = $row[prdimg_S7];
$prdimg_S8 = $row[prdimg_S8];
$prdimg_S9 = $row[prdimg_S9];
$prdimg_S10 = $row[prdimg_S10];
$prdimg_S11 = $row[prdimg_S11];
$prdimg_S12 = $row[prdimg_S12];

$info_name1 = $row[info_name1];
$info_value1 = $row[info_value1];
$info_name2 = $row[info_name2];
$info_value2 = $row[info_value2];
$info_name3 = $row[info_name3];
$info_value3 = $row[info_value3];
$info_name4 = $row[info_name4];
$info_value4 = $row[info_value4];
$info_name5 = $row[info_name5];
$info_value5 = $row[info_value5];

$info_name6 = $row[info_name6];
$info_value6 = $row[info_value6];
$info_name7 = $row[info_name7];
$info_value7 = $row[info_value7];
$info_name8 = $row[info_name8];
$info_value8 = $row[info_value8];
$info_name9 = $row[info_name9];
$info_value9 = $row[info_value9];
$info_name10 = $row[info_name10];
$info_value10 = $row[info_value10];

$upfile1 = $row[upfile1];
$upfile2 = $row[upfile2];
$upfile3 = $row[upfile3];
$upfile4 = $row[upfile4];
$upfile5 = $row[upfile5];

$upfile1_name = $row[upfile1_name];
$upfile2_name = $row[upfile2_name];
$upfile3_name = $row[upfile3_name];
$upfile4_name = $row[upfile4_name];
$upfile5_name = $row[upfile5_name];

if($prdimg_max < 12) $prdimg_hide_max = 12;
else $prdimg_hide_max = $prdimg_max;
for($ii = 1; $ii <= $prdimg_hide_max; $ii++) {
	if(!is_file("$_SERVER[DOCUMENT_ROOT]/admin/data/product/".${prdimg_S.$ii})){
		${prdimg_hide_start.$ii} = "<!--"; ${prdimg_hide_end.$ii} = "-->";
	}
}
for($ii = 1; $ii <= $prdfile_max; $ii++) {
	if(!is_file("$_SERVER[DOCUMENT_ROOT]/admin/data/product/".${upfile.$ii})){
		${upfile_hide_start.$ii} = "<!--"; ${upfile_hide_end.$ii} = "-->";
		${upfile.$ii._click} = " onClick=\"alert('첨부파일이 존재하지 않습니다.');\" style=\"cursor:pointer\" ";
	} else {
		${upfile.$ii} = "<a href='/admin/product/down.php?prdcode=".$prdcode."&no=".$ii."'>".${upfile.$ii._name}."</a>";
		${upfile.$ii._click} = " onClick=\"document.location='/admin/product/down.php?prdcode=".$prdcode."&no=".$ii."';\">";
	}
}

if(empty($catcode)) $catcode = $row[catcode];

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

while($cat_row = mysql_fetch_array($result)){
	if($catcode == $cat_row[catcode]){
		$cat_info = $cat_row;
		$catname = $cat_row[catname];
	}
	if(is_file(WIZHOME_PATH."/data/product/".$cat_row[catimg])) $catimg = "<img src='/admin/data/product/".$cat_row[catimg]."'>";
	$position .= " &gt; <a href='$PHP_SELF?ptype=list&catcode=".$cat_row[catcode]."'>".$cat_row[catname]."</a>";

}

if($cat_info[depthno] == 1) $tmp_catcode = substr($catcode,0,2);
else if($cat_info[depthno] == 2) $tmp_catcode = substr($catcode,0,4);
else if($cat_info[depthno] == 3) $tmp_catcode = substr($catcode,0,4);
if($cat_info[depthno] < 3) $cat_info[depthno]++;

$ii=0;
$sql = "select catcode, catname, depthno from wiz_category where catuse != 'N' and catcode like '$tmp_catcode%' and depthno = '".$cat_info[depthno]."' order by priorno01, priorno02, priorno03 asc";
$result = mysql_query($sql) or error(mysql_error());
while($cat_row = mysql_fetch_array($result)){
	if($catcode == $cat_row[catcode]) $cat_row[catname] = "<strong>".$cat_row[catname]."</strong>";
	$catlist[$ii] .= "<a href='$PHP_SELF?ptype=list&catcode=".$cat_row[catcode]."'>".$cat_row[catname]."</a>";
	$ii++;
}

// 카테고리파일
include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/category.php";

if($info_name1 == ""){
	$info_hide_start1 = "<!--"; $info_hide_end1 = "-->";
}
if($info_name2 == ""){
	$info_hide_start2 = "<!--"; $info_hide_end2 = "-->";
}
if($info_name3 == ""){
	$info_hide_start3 = "<!--"; $info_hide_end3 = "-->";
}
if($info_name4 == ""){
	$info_hide_start4 = "<!--"; $info_hide_end4 = "-->";
}
if($info_name5 == ""){
	$info_hide_start5 = "<!--"; $info_hide_end5 = "-->";
}
if($info_name6 == ""){
	$info_hide_start6 = "<!--"; $info_hide_end6 = "-->";
}
if($info_name7 == ""){
	$info_hide_start7 = "<!--"; $info_hide_end7 = "-->";
}
if($info_name8 == ""){
	$info_hide_start8 = "<!--"; $info_hide_end8 = "-->";
}
if($info_name9 == ""){
	$info_hide_start9 = "<!--"; $info_hide_end9 = "-->";
}
if($info_name10 == ""){
	$info_hide_start10 = "<!--"; $info_hide_end10 = "-->";
}

$list_btn = "<a href='".$PHP_SELF."?ptype=list&page=".$page."&catcode=".$catcode."&".$param."'><img src='".$skin_dir."/image/btn_list.gif' border='0'></a>";
$print_btn = "<img src='".$skin_dir."/image/btn_print.gif' border='0' onClick=\"prdPrint()\" style='cursor:pointer'>";

?>
<script language="javascript">
<!--

var prdimg = "<?=$row[prdimg_L1]?>";

function chgImage(idx){
<?php
for($ii = 1; $ii <= $prdimg_max; $ii++) {
?>
	if(idx == "<?=$ii?>"){
		prdimg = "<?=$row[prdimg_L.$ii]?>";
		document.prdimg.src = "/admin/data/product/<?=$row[prdimg_M.$ii]?>";
	}
<?php
}
?>

}

function prdImg(){
   var url = "/admin/product/prdimg.php?prdimg=" + prdimg;
   window.open(url,"prdImg","width=100,height=100,scrollbars=no,resizable=yes");
}

function prevAlert(){
	alert("이전상품이 없습니다.");
}

function nextAlert(){
	alert("다음상품이 없습니다.");
}

// 프린트
function prdPrint(){
   var url = "/admin/product/print.php?prdcode=<?=$prdcode?>";
   window.open(url,"prdPrint","width=100,height=100,scrollbars=yes,resizable=yes");
}

-->
</script>

<?

// 다음이전 상품
$catcode01 = str_replace("00","",substr($catcode,0,2));
$catcode02 = str_replace("00","",substr($catcode,2,2));
$catcode03 = str_replace("00","",substr($catcode,4,2));
$tmp_catcode = $catcode01.$catcode02.$catcode03;
$sql = "select wp.prdcode from wiz_cprelation wc, wiz_product wp, wiz_category as wcat where wc.catcode like '$tmp_catcode%' and wc.prdcode = wp.prdcode and wc.catcode = wcat.catcode and wcat.catuse != 'N' and wp.showset != 'N' and wp.prdcode > '$prdcode' order by wp.prdcode asc limit 1";
$result = mysql_query($sql) or error(mysql_error());
if($row = mysql_fetch_object($result)) $prev = "<a href='$PHP_SELF?ptype=view&prdcode=$row->prdcode&catcode=$catcode'>이전</a>";
else $prev = "<a href=javascript:prevAlert();>이전</a>";

$sql = "select wc.prdcode from wiz_cprelation wc, wiz_product wp, wiz_category as wcat where wc.catcode like '$tmp_catcode%' and wc.prdcode = wp.prdcode and wc.catcode = wcat.catcode and wcat.catuse != 'N' and wp.showset != 'N' and wp.prdcode < '$prdcode' order by wp.prdcode desc limit 1";
$result = mysql_query($sql) or error(mysql_error());
if($row = mysql_fetch_object($result)) $next = "<a href='$PHP_SELF?ptype=view&prdcode=$row->prdcode&catcode=$catcode'>다음</a>";
else $next = "<a href=javascript:nextAlert();>다음</a>";

// 상단파일
include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/view_head.php";

// 관련상품
include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/relation.php";

// 하단파일
include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/view_foot.php";
?>
