<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include_once "$_SERVER[DOCUMENT_ROOT]/admin/module/msg_count.php";
include_once "$_SERVER[DOCUMENT_ROOT]/admin/module/point.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/inc/mem_info.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/inc/site_info.php";

if($prev != "") $self_page = $prev;
else $self_page = $_SERVER[PHP_SELF];

if($wiz_session[id] == "") include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/loginbox1.php";
else include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/loginbox2.php";

?>