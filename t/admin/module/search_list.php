<?php
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/inc/site_info.php";

if(empty($ptype) || !strcmp($ptype, "list")) include "$_SERVER[DOCUMENT_ROOT]/admin/search/list.php";

update_page("SEARCH");
?>
