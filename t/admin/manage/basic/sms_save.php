<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?

// addslashes()
$sms_id	= addslashes($sms_id);
$sms_pw = addslashes($sms_pw);

// sms 정보수정
$sms_id = "Any_".$sms_id;
$sql = "update wiz_siteinfo set sms_type='$sms_type', sms_id='$sms_id', sms_pw='$sms_pw'";
$result = mysql_query($sql) or error(mysql_error());


complete("저장되었습니다.","sms_fill.php");

?>
