<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php"; ?>
<?
$sql = "select * from wiz_page where code='$code'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

echo $row[content];
?>
