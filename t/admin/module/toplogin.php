<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include_once "$_SERVER[DOCUMENT_ROOT]/admin/inc/mem_info.php";

$login_menu = "로그인"; $logout_menu = "로그아웃";
if($mem_info[login_img] != "") $login_menu = "<img src='/".$mem_info[login_img]."' border='0'>";
if($mem_info[logout_img] != "") $logout_menu = "<img src='/".$mem_info[logout_img]."' border='0'>";

if($wiz_session[id] == "")
   echo "<a href='".$login_url."?prev=".$PHP_SELF."'>".$login_menu."</a>";
else
   echo "<a href='".$logout_url."'>".$logout_menu."</a>";
?>
