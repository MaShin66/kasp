<?php
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin2/inc/site_info.php";

if(empty($ptype) || !strcmp($ptype, "list")) include "$_SERVER[DOCUMENT_ROOT]/admin2/search/list.php";

update_page("SEARCH");
?>
