<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin2/inc/prdmain_info.php";

$mainskin = str_replace("[/LOOP]","[LOOP]",$mainskin);
list($header,$body,$footer) = explode("[LOOP]",$mainskin);

echo $header;

$idx = 0;

$recom_sql = "";
if($maintype == "recom") $recom_sql = " and wp.recom='Y' ";

// ī�װ���
$prdcat_sql = "";
if($prdcat != "") {
	$catcode01 = str_replace("00","",substr($prdcat,0,2));
	$catcode02 = str_replace("00","",substr($prdcat,2,2));
	$catcode03 = str_replace("00","",substr($prdcat,4,2));
	$tmpcode = $catcode01.$catcode02.$catcode03;
	$prdcat_sql = " and wc.catcode like '$tmpcode%' ";
}

$sql = "select wp.*, wc.purl
				from wiz_product as wp left join wiz_cprelation as wcp on wp.prdcode = wcp.prdcode
				left join wiz_category as wc on wcp.catcode = wc.catcode
				where wc.catuse != 'N' $recom_sql $prdcat_sql
				order by wp.prior desc, wp.prdcode desc
				limit ".$prdcnt;
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){

	$body_tmp = $body;

	if($prdline!=0 && ($idx%$prdline)==0) echo "<tr>";

	$purl = $row[purl];
	if($purl == "") {
		$p_sql = "select purl from wiz_category where catuse != 'N' and purl != '' order by catcode asc limit 1";
		$p_result = mysql_query($p_sql) or die(mysql_error());
		$p_row = mysql_fetch_array($p_result);
		$purl = $p_row[purl];
	}

	$prdname = cut_str($row[prdname],$prdname_len);
	$prdprice = number_format($row[prdprice]);
	$prdnum = $row[prdnum];
	$shortexp = cut_str($row[shortexp],$prdexp_len);
	if(file_exists(WIZHOME_PATH."/data/product/".$row[prdimg_R])) $prdimg = "/admin2/data/product/".$row[prdimg_R];		// img

	if($purl != "") $prdlink = "/".$purl."?ptype=view&prdcode=".$row[prdcode];
	else $prdlink = "javascript:alert('��ǰ �������� ����� ���������� �ʽ��ϴ�.');";

	$body_tmp = str_replace("{PRDNAME}",$prdname,$body_tmp);
  $body_tmp = str_replace("{PRDPRICE}",$prdprice,$body_tmp);
  $body_tmp = str_replace("{PRDCODE}",$prdnum,$body_tmp);
  $body_tmp = str_replace("{PRDIMG}",$prdimg,$body_tmp);
  $body_tmp = str_replace("{PRDLINK}",$prdlink,$body_tmp);
  $body_tmp = str_replace("{PRDEXP}",$shortexp,$body_tmp);

	echo $body_tmp;
	$idx++;
}

echo $footer;

$pidx = "";
$prdcat = "";
?>
