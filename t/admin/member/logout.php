<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/inc/mem_info.php";

if(!empty($wiz_session[id])){
	session_unregister("wiz_session"); 
}

$go_url = "/";
if($mem_info[out_url] != "") $go_url = "/".$mem_info[out_url];
Header("Location: $go_url");

?>
