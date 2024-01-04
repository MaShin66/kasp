<? include "./common.php"; ?>
<? include "./inc/site_info.php"; ?>
<?
//if($site_info[start_page] == "") $start_page = "http://".$_http_host."/admin/manage/main/main.php";
//else $start_page = "http://".$_http_host.$site_info[start_page];
$start_page = "http://".$_http_host."/admin/manage/main/main.php"; 

if($admin_id == "") error("아이디를 입력하세요");
if($admin_pw == "") error("비밀번호를 입력하세요");

$sql = "select * from wiz_admin where id = '$admin_id'";
$result = mysql_query($sql);
$admin_info = mysql_fetch_array($result);

if($admin_info[passwd] == $admin_pw){

	$sql = "update wiz_admin set last = now() where id='$admin_id'";
	$result = mysql_query($sql) or error(mysql_error());

	setcookie("wiz_admin[id]", $admin_info[id], false, "/");
	setcookie("wiz_admin[name]", $admin_info[name], false, "/");
	setcookie("wiz_admin[email]", $admin_info[email], false, "/");

	Header("Location: $start_page");

}else{

	if(
		($site_info[designer_id] == $admin_id && $site_info[designer_pw] == $admin_pw) ||
		($site_info[anywiz_id] == md5($admin_id) && $site_info[anywiz_pw] == md5($admin_pw))
		){
		
		setcookie("wiz_admin[id]", $site_info[designer_id], false, "/");
		setcookie("wiz_admin[name]", $site_info[site_name], false, "/");
		setcookie("wiz_admin[email]", $site_info[site_email], false, "/");
		setcookie("wiz_admin[designer]", "Y", false, "/");
	
		Header("Location: $start_page");
		
	}else{
		
		error("회원정보가 일치하지 않습니다.");
		
	}
	
}

?>
