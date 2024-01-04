<?
@header("Content-Type: text/html; charset=UTF-8");

// 라이센스키 업데이트
// 해당파일을 수정 삭제 하시면 저작권법에 의해 법적 제제를 받으실수 있습니다.
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($_POST[mode] == "keyupdate"){

	include "$_SERVER[DOCUMENT_ROOT]/admin/dbcon.php";
	$connect = @mysql_connect($db_host, $db_user, $db_pass) or error("DB 접속시 에러가 발생했습니다.");
	@mysql_select_db($db_name, $connect) or error("DB Select 에러가 발생했습니다");

	$site_key = trim($_POST[site_key]);
	$auth_sql = " site_key = '".$site_key."'";

	$sql = "update wiz_siteinfo set $auth_sql";
	mysql_query($sql);
	echo "<script>document.location='/admin/';</script>";

// 위즈홈 설치하기
//////////////////////////////////////////////////////////////////////////////////////////////////////
}else{

	function alert($msg,$url=""){
		if($url == ""){
			echo "<script>alert('$msg');history.go(-1);</script>";
		}else{
			echo "<script>alert('$msg');document.location='$url';</script>";
		}
		exit;
	}

	@extract($_GET);
	@extract($_POST);
	@extract($_SERVER);
	@extract($_ENV);
	@extract($_SESSION);
	@extract($_COOKIE);
	@extract($_REQUEST);
	@extract($_FILES);

	// 입력값 체크
	if($_REQUEST[db_host] == "") alert("Mysql host 를 입력하세요.");
	if($_REQUEST[db_name] == "") alert("Mysql name 를 입력하세요");
	if($_REQUEST[db_user] == "") alert("Mysql id 를 입력하세요");
	if($_REQUEST[db_pass] == "") alert("Mysql passwd 를 입력하세요");
	if($_REQUEST[admin_id] == "") alert("관리자 아이디를 입력하세요");
	if($_REQUEST[admin_pw] == "") alert("관리자 비밀번호를 입력하세요");
	if($_REQUEST[designer_id] == "") alert("디자이너 아이디를 입력하세요");
	if($_REQUEST[designer_pw] == "") alert("디자이너 비밀번호를 입력하세요");

	// 설치확인
	if(file_exists("./dbcon.php")) alert("이미 위즈홈이 설치되었습니다. \\n\\n재설치하려면 해당 파일(dbcon.php)을 지우세요","install.php");

	// mysql 접속테스트
	$connect = @mysql_connect($db_host, $db_user, $db_pass) or alert("DB 접속시 에러가 발생했습니다.\\n\\nDB정보를 확인하세요","install.php");
	@mysql_select_db($db_name, $connect) or alert("DB Select 에러가 발생했습니다.\\n\\nDB정보를 확인하세요","install.php");

	@mysql_query( "set names utf8;" );

	


	// DB 백업
	$array = file("dbdump.sql");
	$sql = "";
	for($ii = 0; $ii < count($array); $ii++) {

		$tmp1 = substr($array[$ii], 0, 3);
		$tmp2 = substr($array[$ii], strlen($array[$ii]) - 3, 3);

		if(strcmp($tmp1, "/*!") && strcmp($tmp2, "*/;")) {
			$sql .= $array[$ii];
		}
	}

	// UTF-8 ;\n → ;\r\n
	$sql_array = explode(";\r\n", $sql);

	if(count($sql_array) <= 1) {
		$sql_array = explode(";\n", $sql);
	}

	for($ii = 0; $ii < count($sql_array); $ii++) {
		$sql_array[$ii] = trim($sql_array[$ii]);
		if(!empty($sql_array[$ii])) {
			$result = mysql_query($sql_array[$ii]) or die(mysql_error());

		}

	}



	// 디자이너,관리자 아이디/비번 세팅
	$site_date = time();
	$site_key = trim($site_key);

	$auth_sql = " site_key = '".$site_key."'";

	$sql = "update wiz_siteinfo set site_date='$site_date', $sitekey_sql designer_id='$designer_id', designer_pw='$designer_pw'";
	mysql_query($sql) or alert("디비생성에 실패하였습니다. 애니위즈에 문의하세요");
	$sql = "update wiz_admin set id='$admin_id', passwd='$admin_pw'";
	mysql_query($sql);


	// 디비접속 파일생성
	$file=@fopen("dbcon.php","w") or alert("dbcon.php 파일 생성 실패\\n\\n디렉토리의 퍼미션을 707로 주십시요","install.php");
	@fwrite($file,"<?\n\$db_host = \"$db_host\";\n\$db_user = \"$db_user\";\n\$db_pass = \"$db_pass\";\n\$db_name = \"$db_name\";\n?>\n") or alert("dbcon.php 파일 생성 실패\\n\\n디렉토리의 퍼미션을 707로 주십시요","install.php");
	@fclose($file);
	chmod("dbcon.php", 0707);


	// 업로드 폴더생성
	@mkdir("data",0707);
	@mkdir("data/bbs",0707);
	@mkdir("data/category",0707);
	@mkdir("data/config",0707);
	@mkdir("data/connect",0707);
	@mkdir("data/form",0707);
	@mkdir("data/member",0707);
	@mkdir("data/popup",0707);
	@mkdir("data/product",0707);
	@mkdir("data/banner",0707);
	@mkdir("data/session",0707);

	// 관리자로고 복사 (수정권한을 위해 복사)
	@copy("manage/image/admin_logo.gif", "data/config/admin_logo.gif");
	@chmod("data/config/admin_logo.gif", 0606);

	// 설치완료
	alert("정상적으로 설치가 완료되었습니다. 로그인페이지로 이동합니다.","/admin/");

}

?>
