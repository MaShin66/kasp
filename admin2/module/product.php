<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
if($ptype == "" || $ptype == "list") include "$_SERVER[DOCUMENT_ROOT]/admin2/product/list.php";
else if($ptype == "view") include "$_SERVER[DOCUMENT_ROOT]/admin2/product/view.php";

update_page("PRD");
?>
