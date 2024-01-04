<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include_once "$_SERVER[DOCUMENT_ROOT]/admin/inc/prd_info.php";

$sql = "select upfile1,upfile2,upfile3,upfile4,upfile5,upfile1_name,upfile2_name,upfile3_name,upfile4_name,upfile5_name from wiz_product where prdcode = '$prdcode'";
$result = mysql_query($sql) or error(mysql_error());
$row = mysql_fetch_array($result);

$file = "../data/product/$code/".$row[upfile.$no]; $filename = str_conv($row[upfile.$no._name], "euc-kr");

if(file_exists($file)) {

   if( strstr($HTTP_USER_AGENT,"MSIE 5.5")){
       Header("Content-Type: doesn/matter");
       Header("content-length: ". filesize("$file"));
       Header("Content-Disposition: attachment; filename=$filename");
       Header("Content-Transfer-Encoding: binary");
       Header("Cache-Control: cache,must-revalidate");
       Header("Pragma: cache");
       Header("Expires: 0");
   }else{
       Header("Content-type: file/unknown");
       Header("content-length: ". filesize("$file"));
       Header("Content-Disposition: attachment; filename=$filename");
       Header("Content-Description: PHP3 Generated Data");
       Header("Cache-Control: cache,must-revalidate");
       Header("Pragma: cache");
       Header("Expires: 0");
   }

   if(is_file("$file")){
       $fp = fopen("$file","r");
       if(!fpassthru($fp)) {
           fclose($fp);
       }
   }

}else{
   echo "<script>alert('첨부파일이 존재하지 않습니다.');history.go(-1);</script>";
}

?>
