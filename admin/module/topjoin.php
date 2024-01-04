<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include_once "$_SERVER[DOCUMENT_ROOT]/admin/inc/mem_info.php";

$join_menu = "회원가입"; $myinfo_menu = "회원정보수정";
if($mem_info[join_img] != "") $join_menu = "<img src='/".$mem_info[join_img]."' border='0'>";
if($mem_info[myinfo_img] != "") $myinfo_menu = "<img src='/".$mem_info[myinfo_img]."' border='0'>";

if($wiz_session[id] == "")
   echo "<a href='".$join_url."'>".$join_menu."</a>";
else
   echo "<a href='".$myinfo_url."'>".$myinfo_menu."</a>";
?>
