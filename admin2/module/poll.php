<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
if($ptype == "" || $ptype == "list") include "$_SERVER[DOCUMENT_ROOT]/admin2/poll/list.php";
else if($ptype == "view") include "$_SERVER[DOCUMENT_ROOT]/admin2/poll/view.php";
else if($ptype == "save") include "$_SERVER[DOCUMENT_ROOT]/admin2/poll/save.php";
else if($ptype == "passwd") include "$_SERVER[DOCUMENT_ROOT]/admin2/poll/passwd.php";

update_page("POLL");
?>
