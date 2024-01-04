<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
if($ptype == "" || $ptype == "list") include "$_SERVER[DOCUMENT_ROOT]/admin/product/list.php";
else if($ptype == "view") include "$_SERVER[DOCUMENT_ROOT]/admin/product/view.php";

update_page("PRD");
?>
