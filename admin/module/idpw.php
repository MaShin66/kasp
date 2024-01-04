<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/member/idpw.php";

if(!strcmp($stype, "id") || empty($stype)) update_page("MEM_IDPW");
?>
