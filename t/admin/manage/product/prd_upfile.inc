<?
// ���ε� ���丮 ����
$upfile_max = "5";
$upfile_path = "../../data/product";
if(!is_dir($upfile_path)) mkdir($upfile_path, 0707);

if($prdcode != "" && !strcmp($mode, "update")){
	$sql = "select upfile1,upfile2,upfile3,upfile4,upfile5,upfile1_name,upfile2_name,upfile3_name,upfile4_name,upfile5_name,upfile1,upfile2,upfile3,upfile4,upfile5 from wiz_product where prdcode = '$prdcode'";
	$result = mysql_query($sql) or error(mysql_error());
	$prd_row = mysql_fetch_array($result);
}

for($ii = 0; $ii < count($delupfile); $ii++) {
	if($prd_row[$delupfile[$ii]] != ""){
		@unlink($upfile_path."/".$prd_row[$delupfile[$ii]]);
	}
	$upfile_sql .= " $delupfile[$ii]='', $delupfile[$ii]_name='',";
}

for($ii = 1; $ii <= $upfile_max; $ii++) {

	$upfile_size = $_FILES['upfile'.$ii]['size'];
	$upfile_name = $_FILES['upfile'.$ii]['name'];
	$upfile = $_FILES['upfile'.$ii]['tmp_name'];

	if($upfile_size > 0){

		if(fileperms($upfile_path) != 16837 && fileperms($upfile_path) != 16839 && fileperms($upfile_path) != 16895){
			error("���Ͼ��ε�� ������ �߻��Ͽ����ϴ�.\\n\\ndata ���丮 ���ϴ� ��� ��������� �־���մϴ�.","");
		}

		file_check($upfile_name);

		$upfile_tmp = $prdcode."_".$ii.".".substr($upfile_name,-3);
		@copy($upfile, $upfile_path."/".$upfile_tmp);
		@chmod($upfile_path."/".$upfile_tmp, 0606);

		$upfile_sql .= " upfile".$ii."='$upfile_tmp', upfile".$ii."_name='$upfile_name' ,";

		${upfile.$ii._tmp} = $upfile_tmp;
		${upfile.$ii._name} = $upfile_name;

	}

}
?>