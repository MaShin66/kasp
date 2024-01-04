<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
if($ptype == "" || $ptype == "list") include "$_SERVER[DOCUMENT_ROOT]/admin/bbs/list.php";
else if($ptype == "view") include "$_SERVER[DOCUMENT_ROOT]/admin/bbs/view.php";
else if($ptype == "input") include "$_SERVER[DOCUMENT_ROOT]/admin/bbs/input.php";
else if($ptype == "passwd") include "$_SERVER[DOCUMENT_ROOT]/admin/bbs/passwd.php";
else if($ptype == "save") include "$_SERVER[DOCUMENT_ROOT]/admin/bbs/save.php";
update_page("BBS");
?>
