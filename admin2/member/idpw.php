<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin2/inc/site_info.php";
include "$_SERVER[DOCUMENT_ROOT]/admin2/inc/mem_info.php";

echo "<link href=\"".$skin_dir."/style.css\" rel=\"stylesheet\" type=\"text/css\">";

if($search == "ok"){

	if(!strcmp($submode, "id")) {

		$subname = "아이디";
		$mailtype = "mem_id";

	} else if(!strcmp($submode, "passwd")) {

		$subname = "비밀번호";
		$mailtype = "mem_pw";

		$id_sql = " and id = '$id' ";

	}

	$resno = $resno1."-".$resno2;
	$sql = "select id,passwd,name,email,hphone from wiz_member where name = '$name' and email = '$email' $id_sql";
	$result = mysql_query($sql) or error(mysql_error());

	if($row = mysql_fetch_array($result)){

		// 비밀번호인 경우 새로운 비밀번호로 update
		if($submode == "passwd") {

			$row[passwd] = get_rand_str(10);

			$sql = "update wiz_member set passwd = '".md5($row[passwd])."' where id = '$id'";
			mysql_query($sql) or error(mysql_error());

		}

		if(!strcmp($mem_info[method], "A")) {

			for($ii = 0; $ii < strlen($row[id]); $ii++) {
				if($ii < 2) $id .= substr($row[id], $ii, 1);
				else $id .= "*";
			}
			for($ii = 0; $ii < strlen($row[passwd]); $ii++) {
				if($ii < 2) $passwd .= substr($row[passwd], $ii, 1);
				else $passwd .= "*";
			}

			alert("회원님의 ".$subname." 입니다. \\n\\".$subname." : ".${$submode}."");

		} else {
			$re_info = $row;
			send_mailsms($mailtype, $re_info);
			alert("회원님의 ".$subname."를 이메일 (".$row[email].") 로 보내드렸습니다.");
		}

	}else{

		error("회원정보가 일치하지 않습니다.");

	}

}else{

	if(!strcmp($mem_info[method], "A")) {
		$msg_id = "이름과 이메일을 입력하시면 경고창으로 아이디를 알려드립니다.<br>아이디의 2글자만 보여지며 나머지는 *로 치환됩니다.";
		$msg_pw = "아이디와 이름과 이메일을 입력하시면 경고창으로 비밀번호를 알려드립니다.<br>비밀번호의 2글자만 보여지며 나머지는 *로 치환됩니다.";
	} else {
		$msg_id = "이름과 이메일을 입력하시면 가입시 작성하신 이메일로<br>아이디를 보내 드립니다.";
		$msg_pw = "아이디와 이름과 이메일을 입력하시면 가입시 작성하신 이메일로<br>비밀번호를 보내 드립니다.";
	}

	if(!strcmp($stype, "id")) { $pw_hidden_start = "<!--"; $pw_hidden_end = "-->"; }
	if(!strcmp($stype, "pw")) { $id_hidden_start = "<!--"; $id_hidden_end = "-->"; }

	include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/idpw.php";

}

?>
