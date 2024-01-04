<?
/*
$no					: 글 넘버
$catname		: 카테고리
$re_space		: 답글 깊이
$re_icon		: 답글 아이콘
$subject		: 제목
$lock_icon	: 비밀글 아이콘
$new_icon		: 새글 아이콘
$hot_icon		: 인기글 아이콘
$name				: 이름
$email			: 이메일
$wdate			: 작성일
$count			: 조회수
$comment		: 댓글수
$recom			: 추천
$content		: 글내용
$address		: 홈페이지 주소
*/

//".$re_space.$re_icon."
if(!empty($re_space)) {
	$re_padding = "<td width='".(20*$row[depno])."' valign='top' algin='right'></td>";
} else {
	$re_padding = "";
}

// 버튼설정
// 수정권한 체크
if($wpermi >= $mem_level){
	$modify_btn = "<img src='".$skin_dir."/image/bt_modify.gif'onclick=\"layerchk('modify', '".$row[idx]."')\" style='cursor:pointer'></a>";
	$delete_btn = "<a href='$PHP_SELF?ptype=passwd&mode=delete&idx=".$row[idx]."&$param'><image src='$skin_dir/image/bt_del.gif' border='0'></a>";
} else {
	$modify_btn = "";
	$delete_btn = "";
}

if($apermi >= $mem_level && $row[depno] < 1){

	if(!check_point($wiz_session[id], $bbs_info[write_point])) {
		$reply_btn = "<img src='$skin_dir/image/btn_reply.gif' border='0' onClick=\"alert('$bbs_info[point_msg]');\" style='cursor:pointer'>";
	} else {
		$reply_btn = "<img src='$skin_dir/image/btn_re.gif' onclick=\"layerchk('reply', '".$row[idx]."')\" style='cursor:pointer' alt='답변' width='20' height='17'>";
	}

} else {

	if(!strcmp($bbs_info[btn_view], "Y")) {
		if(!empty($bbs_info[perurl])) $perurl = " document.location='".$bbs_info[perurl]."'; ";
		$reply_btn = "<img src='$skin_dir/image/btn_re.gif' border='0' onClick=\"alert('$bbs_info[permsg]'); $perurl \" style='cursor:pointer' alt='답변'>";
	} else {
		$reply_btn = "";
	}

}

if($row[depno] < 1) {
	$guest_re_start = "<!--"; $guest_re_end = "-->";
	$guest_start = ""; $guest_end = "";
} else {
	$guest_start = "<!--"; $guest_end = "-->";
	$guest_re_start = ""; $guest_re_end = "";
}

// 홈페이지
if(!empty($row[address])) {
	$home_icon = "<a href='http://".$row[address]."' target='_blank'><img src='".$skin_dir."/image/ic_home.gif' border='0'></a>";
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="layout:fixed;">
	<tr><td height="10"></td></tr>
	<tr>
	  <td>
	  	<div id="view<?=$row[idx]?>">
	  		<table width="100%" border="0" cellpadding="0" cellspacing="0">
	  			<tr>
	  				<?=$re_padding?>
	  				<td>
	  					<!-- 부모글 -->
	  					<?=$guest_start?>
					  	<table width="100%" border="0" cellpadding="3" cellspacing="0">
					    <tr bgcolor="#efefef">
					      <td width=12><?=$checkbox_body?></td>
					      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					        <tr>
					          <td align="left"  class="test" height="28"><strong><font color="000000"><?=$name?></font></strong> <?=$home_icon?></td>
					          <td align="right"><strong><?=$wdate?></strong> (<?=$ip?>) <?=$reply_btn?> <?=$modify_btn?> <?=$delete_btn?>&nbsp;</td>
					        </tr>
					      </table></td>
					    </tr>
					    <tr>
					      <td height="30"><img src="<?=$skin_dir?>/image/ic_txt.gif"></td>
					      <td colspan="2" align="left" style="padding-left:10px"><table><tr><td><?=$content?></td></tr></table></td>
					    </tr>
						<tr><td height=10></td></tr>
						<tr>
						  <td colspan="3" background="<?=$skin_dir?>/image/dot_bg.gif" height="1"></td>
						</tr>

					  </table>
					  <?=$guest_end?>

					  <!-- 자식글 -->
					  <?=$guest_re_start?>
					  <table width="98%" border="0" cellspacing="0" cellpadding="2">
					  	<tr><td colspan="4" bgcolor="#efefef"></td></tr>
					  	<tr><td height="5"></td></tr>
						  <tr>
					      <td width="1"><?=$checkbox_body?></td>
						    <td width="15%" height="28" align="left" style="padding-left:10px"><b><?=$name?></b><br/>
						    <span class="list_small"><?=$ip?></span></td>
						    <td align="left" style="padding-left:10px"><?=$content?></td>
						    <td align="right" class="num" style="padding-right:5px"><?=$wdate?> <?=$reply_btn?> <?=$modify_btn?> <?=$delete_btn?></td>
						  </tr>
						</table>
					  <?=$guest_re_end?>

					</td>
				</tr>
				</table>
			</div>

			<!-- 방명록 수정폼 -->
			<div id="modify<?=$row[idx]?>" style="display:none;">
			<?
			$confirm_btn = "<input type='image' src='$skin_dir/image/bt_register.gif' border='0'>";
			$cancel_btn = "<img src='$skin_dir/image/btn_cancel.gif' border='0' onClick='layerchk(\"view\", \"$row[idx]\")' style='cursor:hand'>";

			// 비밀번호 숨김
			if($wiz_session[id] != ""){
				$hide_passwd_start = "<!--"; $hide_passwd_end = "-->";
			}

			if($row[ctype] != "H"){
				$content = str_replace("<br>", "\n", $content);
			}
			?>
			<script language="javascript">
			function bbsCheck<?=$row[idx]?>(frm){

			  if(frm.name.value == ""){
			    alert("작성자를 입력하세요.");
			    frm.name.focus();
			    return false;
			  }
			  if(frm.passwd != null && frm.passwd.value == ""){
			    alert("비밀번호를 입력하세요.");
			    frm.passwd.focus();
			    return false;
			  }
			  if(frm.content.value == ""){
			    alert("내용을 입력하세요.");
			    frm.content.focus();
			    return false;
			  }
			}
			</script>

  		<table width="100%" border="0" cellpadding="0" cellspacing="0">
  			<tr>
  				<?=$re_padding?>
  				<td style="padding-top:10px">
				  	<table cellspacing="0" cellpadding="0" width="100%" border="0">
						<form name="frm" action="<?=$PHP_SELF?>" method="post" enctype="multipart/form-data" onSubmit="return bbsCheck(this)">
						<input type="hidden" name="ptype" value="save">
						<input type="hidden" name="code" value="<?=$code?>">
						<input type="hidden" name="mode" value="modify">
						<input type="hidden" name="idx" value="<?=$row[idx]?>">
						<input type="hidden" name="page" value="<?=$page?>">
						<input type="hidden" name="searchopt" value="<?=$searchopt?>">
						<input type="hidden" name="searchkey" value="<?=$searchkey?>">
						<input type="hidden" name="subject" value="방명록입니다.">
				      <tbody>
				        <tr>
				          <td align="left"  class="test">
				          	<table cellspacing="0" cellpadding="0" border="0">
				              <tbody>
				                <tr>
				                  <td>이름</td>
				                  <td style="PADDING-LEFT: 10px"><input class="input" name="name" value="<?=$name?>" style="width:100px" /></td>
				                </tr>
				                <?=$hide_passwd_start?>
				                <tr>
				                  <td>비밀번호</td>
				                  <td style="PADDING-LEFT: 10px"><input class="input" type="password" name="passwd" style="width:100px" /></td>
				                </tr>
				                <?=$hide_passwd_end?>
				                <tr>
				                  <td>이메일</td>
				                  <td style="PADDING-LEFT: 10px"><input class="input" type="text" name="email" value="<?=$email?>" style="width:200px" /></td>
				                </tr>
				                <tr>
				                  <td>홈페이지</td>
				                  <td style="PADDING-LEFT: 10px"><input class="input" type="text" name="address" value="<?=$address?>" style="width:200px" /></td>
				                </tr>
				                <tr>
				                	<td colspan="2">
				                		<table cellspacing="0" cellpadding="0" width="100%" border="0">
								              <tbody>
								                <tr>
								                  <td>
								                  	<textarea class="input" style="WIDTH: 350px; HEIGHT: 50px; word-break:break-all;" name="content" cols="10"><?=$content?></textarea> <?=$confirm_btn?>
								                  </td>
								                </tr>
								              </tbody>
								          	</table>
								        	</td>
								      	</tr>
								      	<tr><td height="5"></td></tr>
				              </tbody>
				          </table></td>
				        </tr>
				      </tbody>
				    </form>
				  	</table>
				  </td>
				</tr>
			</table>
			</div>

			<!-- 방명록 답변폼 -->
			<div id="reply<?=$row[idx]?>" style="display:none">
  		<table width="100%" border="0" cellpadding="0" cellspacing="0">
  			<tr>
  				<?=$re_padding?>
  				<td style="padding-top:10px">
				  	<table cellspacing="0" cellpadding="0" width="100%" border="0">
						<form name="frm" action="<?=$PHP_SELF?>" method="post" enctype="multipart/form-data" onSubmit="return bbsCheck(this)">
						<input type="hidden" name="ptype" value="save">
						<input type="hidden" name="code" value="<?=$code?>">
						<input type="hidden" name="mode" value="reply">
						<input type="hidden" name="idx" value="<?=$row[idx]?>">
						<input type="hidden" name="page" value="<?=$page?>">
						<input type="hidden" name="searchopt" value="<?=$searchopt?>">
						<input type="hidden" name="searchkey" value="<?=$searchkey?>">
						<input type="hidden" name="tmp_vcode" value="<?=md5($norobot_key)?>">
						<input type="hidden" name="subject" value="방명록입니다.">
				      <tbody>
				        <tr>
				          <td align="left"><table cellspacing="0" cellpadding="0" border="0">
				              <tbody>
				                <tr>
				                  <td>이름</td>
				                  <td style="PADDING-LEFT: 10px"><input class="input" name="name" value="<?=$wiz_session[name]?>" style="width:100px" /></td>
				                </tr>
				                <?=$hide_passwd_start?>
				                <tr>
				                  <td>비밀번호</td>
				                  <td style="PADDING-LEFT: 10px"><input class="input" type="password" name="passwd" style="width:100px" /></td>
				                </tr>
				                <?=$hide_passwd_end?>
				                <tr>
				                  <td>이메일</td>
				                  <td style="PADDING-LEFT: 10px"><input class="input" type="text" name="email" value="<?=$wiz_session[email]?>" style="width:200px" /></td>
				                </tr>
				                <tr>
				                  <td>홈페이지</td>
				                  <td style="PADDING-LEFT: 10px"><input class="input" type="text" name="address" value="http://" style="width:200px" /></td>
				                </tr>
				                <?=$hide_spam_check_start?>
				                <tr>
				                  <td>자동등록<br>방지코드</td>
				                  <td style="PADDING-LEFT: 10px"><?=$spam_check?> </td>
				                </tr>
				                <?=$hide_spam_check_end?>
				                <tr>
				                	<td colspan="2">
				                		<table cellspacing="0" cellpadding="0" width="100%" border="0">
									              <tbody>
									                <tr>
									                  <td>
									                  	<textarea class="input" style="WIDTH: 350px; HEIGHT: 50px; word-break:break-all;" name="content" cols="10"></textarea> <?=$confirm_btn?>
									                  </td>
									                </tr>
									              </tbody>
									          </table>
				                	</td>
				                </tr>
				                <tr><td height="5"></td></tr>
				              </tbody>
				          </table></td>
				        </tr>
				      </tbody>
				    </form>
				  	</table>
				  </td>
				</tr>
			</table>
			</div>

		</td>
	</tr>
</table>
</div>
