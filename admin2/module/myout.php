<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
if($ptype == "" || $ptype == "myout") include "$_SERVER[DOCUMENT_ROOT]/admin2/member/myout.php";
else if($ptype == "save")  include "$_SERVER[DOCUMENT_ROOT]/admin2/member/myout_save.php";
?>
