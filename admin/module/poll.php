<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
if($ptype == "" || $ptype == "list") include "$_SERVER[DOCUMENT_ROOT]/admin/poll/list.php";
else if($ptype == "view") include "$_SERVER[DOCUMENT_ROOT]/admin/poll/view.php";
else if($ptype == "save") include "$_SERVER[DOCUMENT_ROOT]/admin/poll/save.php";
else if($ptype == "passwd") include "$_SERVER[DOCUMENT_ROOT]/admin/poll/passwd.php";

update_page("POLL");
?>
