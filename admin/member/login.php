<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/inc/site_info.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/inc/mem_info.php";

echo "<link href=\"".$skin_dir."/style.css\" rel=\"stylesheet\" type=\"text/css\">";

include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/login.php";
?>
