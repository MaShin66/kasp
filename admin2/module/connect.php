<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";

if(strlen($HTTP_COOKIE_VARS["wiz_connect"]) == 0 && check_robots($_SERVER['HTTP_USER_AGENT'])){

	setcookie("wiz_connect", "true");


	// 접속레퍼러 저장
	$referer = $_SERVER['HTTP_REFERER'];
	$parse_url = parse_url($referer);
	$host = $parse_url[host];
	$today = date('Y-m-d');

	// 현재 host와 다른 경우 저장
	if(strcmp($host, $_SERVER['HTTP_HOST'])) {

		$sql = "select referer from wiz_conrefer where wdate = '$today' and referer = '$referer'";
		$result = @mysql_query($sql);

		if(@mysql_num_rows($result) > 0){
			$sql = "update wiz_conrefer set cnt = cnt + 1 where  wdate = '$today' and referer = '$referer'";
			@mysql_query($sql);
		}else{
			$sql = "insert into wiz_conrefer(referer,host,wdate,cnt) values('$referer','$host','$today',1)";
			@mysql_query($sql);

		}

	}
	
	// 브라우저 OS저장
	$os_browser = get_osbrowser($_SERVER['HTTP_USER_AGENT']);
	$browser = $os_browser["browser"];
	$os = $os_browser["os"];
	
	$sql = "select cnt from wiz_conother where browser='$browser'";
	$result = mysql_query($sql); $total = mysql_num_rows($result);
	if($total > 0) $sql = "update wiz_conother set cnt = cnt+1 where browser='$browser'";
	else $sql = "insert into wiz_conother(browser,cnt) values('$browser','1')";
	mysql_query($sql);
	
	$sql = "select cnt from wiz_conother where os='$os'";
	$result = mysql_query($sql); $total = mysql_num_rows($result);
	if($total > 0) $sql = "update wiz_conother set cnt = cnt+1 where os='$os'";
	else $sql = "insert into wiz_conother(os,cnt) values('$os','1')";
	mysql_query($sql);


}

?>
