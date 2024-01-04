<?
@extract($_SESSION);
@extract($_COOKIE);

if(!empty($wiz_admin[id])){

	setcookie("wiz_admin[id]", "", time()-3600, "/");
   setcookie("wiz_admin[name]", "", time()-3600, "/");
   setcookie("wiz_admin[email]", "", time()-3600, "/");
   setcookie("wiz_admin[designer]", "", time()-3600, "/");

}
echo "<script>document.location='./';</script>";
?>
