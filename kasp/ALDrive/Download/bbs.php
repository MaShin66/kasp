<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
if($ptype == "" || $ptype == "list") include "$_SERVER[DOCUMENT_ROOT]/admin2/bbs/list.php";
else if($ptype == "view") include "$_SERVER[DOCUMENT_ROOT]/admin2/bbs/view.php";
else if($ptype == "input") include "$_SERVER[DOCUMENT_ROOT]/admin2/bbs/input.php";
else if($ptype == "passwd") include "$_SERVER[DOCUMENT_ROOT]/admin2/bbs/passwd.php";
else if($ptype == "save") include "$_SERVER[DOCUMENT_ROOT]/admin2/bbs/save.php";
update_page("BBS");
?>
