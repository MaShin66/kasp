<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/inc/site_info.php";

$passwd = md5($passwd);

// 회원로그인
$sql = "select id,passwd,name,hphone,tphone,email,level from wiz_member where id='$id' and passwd='$passwd'";
$result = mysql_query($sql) or error(mysql_error());
if($mem_info = mysql_fetch_array($result)){

	$level_info = level_info();
	$level = $mem_info[level];
	$level_value = $level_info[$level][level];

	$sql = "update wiz_member set visit = visit+1 , visit_time = now() where id='$id'";
	$result = mysql_query($sql) or error(mysql_error());

	// 미니홈피 사용 시 미니홈피 자동생성
	if(!strcmp($site_info[mini_use], "Y")) {

		$sql = "select count(idx) as cnt from wiz_mini_info where memid = '$id'";
		$result = mysql_query($sql) or error(mysql_error());
		$row = mysql_fetch_array($result);

		if($row[cnt] < 1) {
			$title = $id."님의 미니홈피";
			$menu_use = "PRO/BBS/DATA/PHOTO/MOVIE/GUEST/";
			$sql = "insert into wiz_mini_info(memid, title, menu_use, wdate) values('$id', '$title', '$menu_use', now())";
			mysql_query($sql) or error(mysql_error());
		}

	}

	save_point("LOGIN", $id);

// 관리자 로그인
}else{

   $sql = "select id,passwd,name,hphone,tphone,email from wiz_admin where id='$id' and passwd='$passwd'";
   $result = mysql_query($sql) or error(mysql_error());
   if($mem_info = mysql_fetch_array($result)){

      $level = 0;
      $level_value = 0;

   }else{
   		error("회원정보가 일치하지 않습니다.", "");
      exit;
   }

}
/*
if(!empty($save_check)) {

	$time = time() + (60*60*24*10); // 현재시간 + 60초 * 60분 * 24시간 * 10일 (합이 10일 후)
	setcookie("save_id", $mem_info[id], $time, "/");

}
*/

//php5 이상 세션등록
$_SESSION['wiz_session']['id'] = $mem_info['id'];
$_SESSION['wiz_session']['passwd'] = $_POST['passwd'];
$_SESSION['wiz_session']['name'] = $mem_info['name'];
$_SESSION['wiz_session']['email'] = $mem_info['email'];
$_SESSION['wiz_session']['hphone'] = $mem_info['hphone'];
$_SESSION['wiz_session']['tphone'] = $mem_info['tphone'];
$_SESSION['wiz_session']['level'] = $level;
$_SESSION['wiz_session']['level_value'] = $level_value;

if($prev == "") $prev = "http://".$_http_host;
else $prev = "http://".$_http_host.urldecode($prev);
echo "<script>document.location='$prev';</script>";

?>
