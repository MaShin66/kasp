<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<?

	$level_info = level_info();

	// 입력정보 사용여부
	$sql = "select infouse from wiz_meminfo";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$info_tmp = explode("/",$row[infouse]);
	for($ii=0; $ii<count($info_tmp); $ii++){
		$info_use[$info_tmp[$ii]] = true;
	}

	$filename = str_conv("회원정보[".date('Ymd')."].xls", "euc-kr");

	header( "Content-type: application/vnd.ms-excel" );
	header( "Content-Disposition: attachment; filename=$filename" );
	header( "Content-Description: PHP4 Generated Data" );

	$excel_title = "아이디	";
	$excel_title .= "비밀번호	";
	$excel_title .= "이름	";
	$excel_title .= "회원등급	";
	if($info_use[photo] == true) $excel_title .= "회원사진	";
	if($info_use[resno] == true) $excel_title .= "주민번호	";
	if($info_use[tphone] == true) $excel_title .= "전화번호	";
	if($info_use[hphone] == true) $excel_title .= "휴대폰	";
	if($info_use[comtel] == true) $excel_title .= "회사전화	";
	if($info_use[email] == true) $excel_title .= "이메일	";
	if($info_use[reemail] == true) $excel_title .= "이메일 수신	";
	if($info_use[homepage] == true) $excel_title .= "홈페이지	";
	if($info_use[address] == true) $excel_title .= "주소	";
	if($info_use[birthday] == true) $excel_title .= "생년월일	";
	if($info_use[marriage] == true) $excel_title .= "결혼여부	";
	if($info_use[memorial] == true) $excel_title .= "결혼기념일	";
	if($info_use[job] == true) $excel_title .= "직업	";
	if($info_use[scholarship] == true) $excel_title .= "학력	";
	if($info_use[consph] == true) $excel_title .= "관심분야	";
	if($info_use[hobby] == true) $excel_title .= "취미	";
	if($info_use[income] == true) $excel_title .= "월평균소득	";
	if($info_use[car] == true) $excel_title .= "자동차소유	";
	if($info_use[intro] == true) $excel_title .= "자기소개	";
	$excel_title .= "관리자메모	";
	$excel_title .= "가입일";

	echo str_conv($excel_title, "euc-kr")."\n";

	if($slevel != "") $level_sql .= " and level = '$slevel'";
	if($searchopt != "") $search_sql .= " and $searchopt like '%$searchkey%'";
	$sql = "select * from wiz_member where id != '' $level_sql $search_sql order by idx desc";
	$result = mysql_query($sql) or error(mysql_error());

	while($row = mysql_fetch_array($result)){

		$excel_data = "";
		$excel_data .= $row[id]."	";
		$excel_data .= $row[passwd]."	";
		$excel_data .= $row[name]."	";
		$excel_data .= $level_info[$row[level]][name]."	";
		if($info_use[photo] == true) $excel_data .= $row[photo]."	";
		if($info_use[resno] == true) $excel_data .= $row[resno]."	";
		if($info_use[tphone] == true) $excel_data .= $row[tphone]."	";
		if($info_use[hphone] == true) $excel_data .= $row[hphone]."	";
		if($info_use[comtel] == true) $excel_data .= $row[comtel]."	";
		if($info_use[email] == true) $excel_data .= $row[email]."	";
		if($info_use[reemail] == true) $excel_data .= $row[reemail]."	";
		if($info_use[homepage] == true) $excel_data .= $row[homepage]."	";
		if($info_use[address] == true) $excel_data .= $row[post]." ".$row[address1]." ".$row[address2]."	";
		if($info_use[birthday] == true) $excel_data .= $row[birthday]."	";
		if($info_use[marriage] == true) $excel_data .= $row[marriage]."	";
		if($info_use[memorial] == true) $excel_data .= $row[memorial]."	";
		if($info_use[job] == true) $excel_data .= $row[job]."	";
		if($info_use[scholarship] == true) $excel_data .= $row[scholarship]."	";
		if($info_use[consph] == true) $excel_data .= $row[consph]."	";
		if($info_use[hobby] == true) $excel_data .= $row[hobby]."	";
		if($info_use[income] == true) $excel_data .= $row[income]."	";
		if($info_use[car] == true) $excel_data .= $row[car]."	";
		if($info_use[intro] == true) $excel_data .= str_replace("\r\n", " ", $row[intro])."	";
		$excel_data .= $row[memo]."	";
		$excel_data .= $row[wdate];

		echo str_conv($excel_data, "euc-kr")."\n";
	}

?>
