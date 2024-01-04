<?php
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include_once "$_SERVER[DOCUMENT_ROOT]/admin/inc/site_info.php";

$skin_dir = "/admin/sms";

if(empty($stype) || !strcmp($stype, "input")) include "$_SERVER[DOCUMENT_ROOT]/admin/sms/input.php";
else if(!strcmp($stype, "send")) include "$_SERVER[DOCUMENT_ROOT]/admin/sms/send.php";

?>
