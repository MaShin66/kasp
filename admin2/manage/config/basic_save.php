<?
include_once "../../common.php";
include_once "../../inc/admin_check.php";

// 로고등록
if($admin_logo[size] > 0){

	file_check($admin_logo[name]);
	
	$upfile_path = WIZHOME_PATH."/data/config";
	@copy($admin_logo[tmp_name], $upfile_path."/admin_logo.gif");
	@chmod($upfile_path."/admin_logo.gif", 0606);

}

for($ii=0; $ii<count($menu_use); $ii++){ $tmp_menu .= $menu_use[$ii]."/"; }

$site_key = trim($site_key);

$sql = "update wiz_siteinfo set site_key='$site_key', admin_title='$admin_title', admin_copyright='$admin_copyright',addbbs_use='$addbbs_use', ssl_use='$ssl_use', ssl_port='$ssl_port', msg_use='$msg_use', sms_use='$sms_use', sms_id='$sms_id', sms_pw='$sms_pw', namecheck_use='$namecheck_use', namecheck_id='$namecheck_id', namecheck_pw='$namecheck_pw', point_use = '$point_use', designer_id='$designer_id', designer_pw='$designer_pw', menu_use='$tmp_menu', mini_use='$mini_use'";
mysql_query($sql) or error(mysql_error());

complete("기본설정이 저장되었습니다.","basic_config.php");

?>
