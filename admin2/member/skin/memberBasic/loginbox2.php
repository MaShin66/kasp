<?
/*
<?=$wiz_session[name]?>		: 회원명
<?=$msg_count?>						: 쪽지수
<?=$my_point?>						: 포인트
<?=$logout_url?>					: 로그아웃 주소
<?=$myinfo_url?>					: 회원정보 수정 주소
*/
?>
<table width="150" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="60" align="center">
    	<table width="96%" height="40" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left"><font color="red"><b><?=$wiz_session[name]?></b></font>님 로그인하셨습니다.</td>
      </tr>
      <tr>
        <td align="left"><?=$msg_count?></td>
      </tr>
      <tr>
        <td align="left"><?=$my_point?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><a href="<?=$logout_url?>"><img src="<?=$skin_dir?>/image/bt_logout.gif" border="0"></a></td>
		    <td>&nbsp;</td>
        <td><a href="<?=$myinfo_url?>"><img src="<?=$skin_dir?>/image/bt_modify.gif" border="0"></a></td>
      </tr>
    </table></td>
  </tr>
</table>



<!--
가로형 로그인
<table width="350" border="0" height="30" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
      	<td width="5"></td>
        <td align="left"><font color="red"><b><?=$wiz_session[name]?></b></font>님  <span class="s01">방문해주셔서 감사합니다.</span></td>
        <td width="60"><a href="<?=$logout_url?>"><img src="<?=$skin_dir?>/image/bt_logout.gif" border="0"></a></td>
        <td width="60"><a href="<?=$myinfo_url?>"><img src="<?=$skin_dir?>/image/bt_modify.gif" border="0"></a></td>
      </tr>
      </table>
	  </td>
 </tr>
</table>
-->
