<?
$sql = "select * from wiz_pollinfo where code = '$code'";
$result = mysql_query($sql) or error(mysql_error());
$poll_info = mysql_fetch_array($result);

if($poll_info[perurl] != "") $poll_info[perurl] .= "?prev=".urlencode($_SERVER[REQUEST_URI]);

// 설문조사 접근권한
$level_info = level_info();
$mem_level = $level_info[$wiz_session[level]][level];

$lpermi = $level_info[$poll_info[lpermi]][level];
$rpermi = $level_info[$poll_info[rpermi]][level];
$apermi = $level_info[$poll_info[apermi]][level];
$cpermi = $level_info[$poll_info[cpermi]][level];

// 스킨위치
$skin_dir = "/admin/poll/skin/".$poll_info[skin];
?>
