<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/inc/site_info.php";
include "$_SERVER[DOCUMENT_ROOT]/admin2/inc/mem_info.php";

echo "<link href=\"".$skin_dir."/style.css\" rel=\"stylesheet\" type=\"text/css\">";

if($site_info[namecheck_use] != "Y"){
	$namecheck_start = "<!--";
	$namecheck_end = "-->";
}

include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/join_agree.php";
?>
