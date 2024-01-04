<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
if($ptype == "" || $ptype == "list") include "$_SERVER[DOCUMENT_ROOT]/admin/schedule/list.php";
else if($ptype == "view") include "$_SERVER[DOCUMENT_ROOT]/admin/schedule/view.php";
else if($ptype == "input") include "$_SERVER[DOCUMENT_ROOT]/admin/schedule/input.php";
else if($ptype == "passwd") include "$_SERVER[DOCUMENT_ROOT]/admin/schedule/passwd.php";
else if($ptype == "save") include "$_SERVER[DOCUMENT_ROOT]/admin/schedule/save.php";

update_page("SCH");
?>
