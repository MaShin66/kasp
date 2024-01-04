<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
if($ptype == "" || $ptype == "myout") include "$_SERVER[DOCUMENT_ROOT]/admin/member/myout.php";
else if($ptype == "save")  include "$_SERVER[DOCUMENT_ROOT]/admin/member/myout_save.php";
?>
