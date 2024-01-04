<? include_once "../../common.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?
if($message == "") error("보내는 내용이 없습니다.");
if($se_num == "") error("보내는이 전화번호가 없습니다.");

$sql = "select hphone from wiz_member where id != '' ";
if($sdate != "")	$sql .= " and wdate > '$sdate'";
if($edate != "")	$sql .= " and wdate <= '$edate 23:59:59'";
if($searchkey != "")	$sql .= " and $searchopt like '%$searchkey%'";
if($level != "")	$sql .= " and level = '$level'";
if($birthday == "Y")	$sql .= " and birthday like '%$today'";
if($memorial == "Y")	$sql .= " and memorial like '%$today'";
if($age != "")	$sql .= " and resno > '$age_syear' and resno < '$age_eyear'";
if($address != "")	$sql .= " and address like '%$address%'";
if($job != "")	$sql .= " and job = '$job'";
if($marriage != "")	$sql .= " and marriage = '$marriage'";
if($resms == "N")	$sql .= " and resms != 'N'";
$sql .=" order by wdate desc";
$result = mysql_query($sql);

while($row = mysql_fetch_array($result)){
	if($row[hphone] != "") send_sms($se_num, $row[hphone], $message);
}

alert("SMS발송을 정상적으로 완료하였습니다.","sms_send.php");

?>
