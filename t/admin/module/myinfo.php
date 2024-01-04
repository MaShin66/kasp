<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
if($ptype == "" || $ptype == "myinfo") include "$_SERVER[DOCUMENT_ROOT]/admin/member/myinfo.php";
else if($ptype == "save")  include "$_SERVER[DOCUMENT_ROOT]/admin/member/myinfo_save.php";
update_page("MEM_INFO");
?>
