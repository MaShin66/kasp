<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$sql = " select * from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' ";
$result = sql_query($sql);
while ($row = sql_fetch_array($result))
    @unlink("$g4[path]/data/file/$bo_table/thumbs/$row[bf_file]");
?>
