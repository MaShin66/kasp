<?php
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/inc/site_info.php";

$skin_dir = "/admin2/sms";

if(empty($stype) || !strcmp($stype, "input")) include "$_SERVER[DOCUMENT_ROOT]/admin2/sms/input.php";
else if(!strcmp($stype, "send")) include "$_SERVER[DOCUMENT_ROOT]/admin2/sms/send.php";

?>
