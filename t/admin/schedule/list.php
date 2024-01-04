<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/inc/sch_info.php";

echo "<link href=\"".$skin_dir."/style.css\" rel=\"stylesheet\" type=\"text/css\">";

// 목록보기 권한체크
if($lpermi < $mem_level) error($sch_info[permsg],$sch_info[perurl]);

if (!$year) { $year	= date("Y"); $month	= date("m"); }

$prev = date("Y-m",mktime(0,0,0,$month-1,1,$year));
$prevArray = split("-",$prev);
$prevYear = $prevArray[0];
$prevMonth = $prevArray[1];

$next = date("Y-m",mktime(0,0,0,$month+1,1,$year));
$nextArray = split("-",$next);
$nextYear = $nextArray[0];
$nextMonth = $nextArray[1];

$nnext = date("Y-m",mktime(0,0,0,$month+2,1,$year));
$nnextArray = split("-",$nnext);
$nnextYear = $nnextArray[0];
$nnextMonth = $nnextArray[1];

$day = "";
$first_day	= date("w",mktime(0,0,0,$month,1,$year)) + 1;
$total_day	= date("t", mktime(0, 0, 0, $month, 1, $year));

$start_month	= $year."-".$month."-01";
$last_month = $year."-".$month."-".$total_day;

// 스케쥴 가져오기
$sql = "select *, from_unixtime(wdate, '%e') as day_idx from wiz_bbs where code='$code' and from_unixtime(wdate, '%Y-%m-%d') between '$start_month' and '$last_month' order by wdate";
$result = mysql_query($sql);

$day_bak = "";
while ($row = mysql_fetch_array($result)) {

	//$day_idx = str_replace("0","",substr($row[wdate],8,2));
	$day_idx = $row[day_idx];
	if($day_bak == $day_idx) $seq_idx++;
	else $seq_idx = 0;
	$day_bak = $day_idx;

	$schedule_list[$day_idx][$seq_idx][subject] = cut_str($row[subject],8);
	$schedule_list[$day_idx][$seq_idx][idx] = $row[idx];

}

// 버튼설정
if($wpermi >= $mem_level) {

	if(!check_point($wiz_session[id], $sch_info[write_point])) {
		$write_btn = "<img src='$skin_dir/image/btn_write.gif' border='0' onClick=\"alert('$sch_info[point_msg]');\" style='cursor:pointer'>";
	} else {
		$write_btn = "<a href='$PHP_SELF?ptype=input&mode=insert&code=$code'><img src='$skin_dir/image/btn_write.gif' border='0'></a>";
	}

} else {

	if(!strcmp($sch_info[btn_view], "Y")) {
		if(!empty($sch_info[perurl])) $perurl = " document.location='".$sch_info[perurl]."'; ";
		$write_btn = "<img src='$skin_dir/image/btn_write.gif' border='0' onClick=\"alert('$sch_info[permsg]'); $perurl \" style='cursor:pointer'>";
	}

}

$prev_btn = "<a href='".$PHP_SELF."?year=".$prevYear."&month=".$prevMonth."'><img border=0 src='".$skin_dir."/image/l_prev.gif'></a>";
$next_btn = "<a href='".$PHP_SELF."?year=".$nextYear."&month=".$nextMonth."'><img border=0 src='".$skin_dir."/image/l_next.gif'></a>";

@include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/list_head.php";

if(($first_day > 5) && ((floor($total_day / 5) == 6) || (floor($total_day / 5) == 7))) {
	$line = 6;
	if($total_day == 30 && $first_day == 6) $line--;
} else if(($first_day == 1) && ($total_day == 28)) {
	$line = 4;
} else {
	$line = 5;
}

$k = 0;

for ($i=1; $i<=$line; $i++) {

	echo "<tr height='".$cell_height."'>";

	for ($j=1; $j<=7; $j++) {

		$day_sch = "";
		if ((!$day) && ($j == $first_day)) $day = 1;

		$day_color = "";
		if ($j == 7) $day_color = "blue";
		if ($j == 1) $day_color = "red";

		if ($day > 0){

		  //if($day < 10) $day = "0".$day;
		  if($schedule_list[$day]) $td_color = "#A1DE8D";
			else $td_color = "#FFFFFF";

		  $day_img = "<img src='/admin/manage/image/schedule/day".$day."-".$day_color.".gif'>";
		  $day_sch = "";
		  for($k=0;$k<count($schedule_list[$day]);$k++){
			  $day_sch .= "&nbsp;<a href='$PHP_SELF?ptype=view&idx=".$schedule_list[$day][$k][idx]."'>".$schedule_list[$day][$k][subject]."</a><br>";
			}

		}else{
			$day_img = "";
		}

		$tmp_day = $day;
		if(!strcmp($day, date('j')) && !strcmp($month, date('m'))) $day = "<b>".$day."</b>";

		@include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/list_body.php";

		$day = $tmp_day;

		if ($day != $total_day) {
			if (($day > 0) && ($day < $total_day)) $day++;
		} else {
			$day = "&nbsp;";
		}
	}
	echo "</tr>";
}

@include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/list_foot.php";
$schedule_list = null;
?>
