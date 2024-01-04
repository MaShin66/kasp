<form name="formFrm<?=$fidx?>" action="<?=$ssl?><?=$PHP_SELF?>" method="post" enctype="multipart/form-data" onSubmit="return formCheck<?=$form_info[idx]?>(this);">
<input type="hidden" name="ptype" value="save">
<input type="hidden" name="code" value="<?=$code?>">
<input type="hidden" name="fidx" value="<?=$fidx?>">
<input type="hidden" name="tmp_vcode" value="<?=md5($norobot_key)?>">

<?=$hide_agree_start?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" style="padding:10px; border:3px solid #eaeaea;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td style="padding: 5px 0px 5px 0px;"><textarea name="textarea" rows="12" style="width:97%; padding:5px;" class="textarea" readonly><?=$agreement?></textarea></td>
        </tr>
         <tr>
           <td align="right"> <input type="checkbox" name="agree"> 약관에 동의합니다.</td>
         <tr>
      </table>
    </td>
  </tr>
</table>
<br>
<?=$hide_agree_end?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="2" colspan="11" bgcolor="#a9a9a9"></td>
  </tr>
