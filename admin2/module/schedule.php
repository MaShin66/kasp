<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
if($ptype == "" || $ptype == "list") include "$_SERVER[DOCUMENT_ROOT]/admin2/schedule/list.php";
else if($ptype == "view") include "$_SERVER[DOCUMENT_ROOT]/admin2/schedule/view.php";
else if($ptype == "input") include "$_SERVER[DOCUMENT_ROOT]/admin2/schedule/input.php";
else if($ptype == "passwd") include "$_SERVER[DOCUMENT_ROOT]/admin2/schedule/passwd.php";
else if($ptype == "save") include "$_SERVER[DOCUMENT_ROOT]/admin2/schedule/save.php";

update_page("SCH");
?>
