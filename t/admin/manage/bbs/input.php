<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include_once "../../inc/bbs_info.php"; ?>
<?
// 검색 파라미터
$param = "code=$code&page=$page&category=$category&searchopt=$searchopt&searchkey=$searchkey";

if($mode == "insert" || $mode == ""){

	$mode = "insert";
	$bbs_row[name] = $wiz_admin[name];
	$bbs_row[email] = $wiz_admin[email];
	$bbs_row[wdate] = date('Y-m-d H:i:s');
	$bbs_row[passwd] = date('is');
	$bbs_row[count] = 0;

}else if($mode == "modify"){

	$sql = "select *,from_unixtime(wdate, '%Y-%m-%d %H:%i:%s') as wdate from wiz_bbs where code = '$code' and idx='$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$bbs_row = mysql_fetch_array($result);

}else if($mode == "reply"){

	$sql = "select subject, content, privacy, passwd from wiz_bbs where code = '$code' and idx='$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$bbs_row = mysql_fetch_array($result);

	$bbs_row[name] 	= $wiz_admin[name];
  $bbs_row[email] = $wiz_admin[email];
  $bbs_row[wdate] = date('Y-m-d');
  $bbs_row[count] = 0;
	$bbs_row[content] = $bbs_row[content]."\n\n==================== 답 변 ====================\n\n";

}

?>
<? include "../head.php"; ?>

      <script language="JavaScript" type="text/javascript">
      <!--
        function inputCheck(frm){

        if(frm.name.value == ""){
          alert("이름을 입력하세요.");
          frm.name.focus();
          return false;
        }
        if(frm.subject.value == ""){
          alert("제목을 입력하세요.");
          frm.subject.focus();
          return false;
        }
				try{ content.outputBodyHTML(); } catch(e){ }
				if(frm.content.value == ""){
					alert("내용을 입력하세요.");
					return false;
				}
        if(frm.passwd.value == ""){
          alert("비밀번호를 입력하세요.");
          frm.passwd.focus();
          return false;
        }

      }

      //-->
      </script>
      
      <table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">게시물관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">게시판의 게시물을 관리합니다.</td>
        </tr>
      </table>
      
      <br>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <form action="list.php" method="post">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> <?=$bbs_info[title]?></td>
        </tr>
        <tr><td height="3"></td></tr>
      </form>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <form name="frm" action="save.php" method="post" enctype="multipart/form-data" onSubmit="return inputCheck(this)">
      <input type="hidden" name="code" value="<?=$code?>">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <input type="hidden" name="idx" value="<?=$idx?>">
      <input type="hidden" name="page" value="<?=$page?>">
      <input type="hidden" name="ctype" value="<?=$ctype ?>">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td width="15%" class="t_name">작성자</td>
                <td width="35%" class="t_value"><input name="name" type="text" value="<?=$bbs_row[name]?>" class="input"></td>
                <td width="15%" class="t_name">이메일</td>
                <td width="35%" class="t_value"><input name="email" type="text" value="<?=$bbs_row[email]?>" size="30" class="input"></td>
              </tr>
              <tr>
                <td class="t_name">작성일</td>
                <td class="t_value"><input name="wdate" type="text" value="<?=$bbs_row[wdate]?>" class="input"></td>
                <td class="t_name">조회수</td>
                <td class="t_value"><input name="count" type="text" value="<?=$bbs_row[count]?>" class="input"></td>
              </tr>
              <tr>
                <td class="t_name">제목</td>
                <td class="t_value" colspan="3">
								<?
			          $sql = "select idx, catname from wiz_bbscat where code = '$code' and gubun != 'A' order by idx asc";
			          $result = mysql_query($sql) or error(mysql_error());
			          $total = mysql_num_rows($result);
			          if($total > 0) {
                  echo "<select name='category'>";
                  echo "<option value=''>분류</option>";
									while($row = mysql_fetch_array($result)) {
										if($bbs_row[category] == $row[idx]) $selected = "selected";
										else $selected = "";
			          		echo "<option value='".$row[idx]."'".$selected.">".$row[catname]."</option>";
									}
                	echo "</select>";
								}
								?>

                <input type="checkbox" name="notice" value="Y" <? if($bbs_row[notice] == "Y") echo "checked"; ?>>공지글
                <input type="checkbox" name="privacy" value="Y" <? if($bbs_row[privacy] == "Y" || ($mode != "modify" && $bbs_info[privacy] == "Y")) echo "checked"; ?>>비밀글
                <input type="checkbox" name="ctype" value="H" <? if($bbs_row[ctype] == "H") echo "checked"; ?>>HTML사용<br>
                <input type="text" name="subject"  value="<?=$bbs_row[subject]?>" size="70" class="input" style="word-break:break-all;">
                </td>
              </tr>
              <tr>
                <td class="t_name">내용</td>
                <td class="t_value" colspan="3">
                <?
					 			if($bbs_info[editor] == "Y"){
									$edit_content = $bbs_row[content];
									include "../../webedit/WIZEditor.html";
								}else{
								?>
                  <textarea name="content" rows="16" cols="80" class="textarea" style="width:100%;word-break:break-all;"><?=$bbs_row[content]?></textarea>
								<?
								}
								?>
				    		</td>
              </tr>
              <tr>
                <td class="t_name">비밀번호</td>
                <td width="275" class="t_value" colspan="3"><input name="passwd" type="text" value="<?=$bbs_row[passwd]?>" class="input"></td>
              </tr>
							<?php
							for($ii = 1; $ii <= $upfile_max; $ii++) {
								$upfile = "upfile".$ii;
								$upfile_name = "upfile".$ii."_name";
							?>
              <tr>
                <td class="t_name">파일첨부<?=$ii?></td>
                <td class="t_value" colspan="3"><input name="upfile<?=$ii?>" type="file" value="" class="input">
                <? if($bbs_row[$upfile] != ""){ ?>
                	<input type="checkbox" name="delupfile[]" value="upfile<?=$ii?>"> 삭제
                	<!--a href="save.php?mode=delfile&code=<?=$code?>&idx=<?=$idx?>&file=upfile3">[삭제]</a//-->
                	&nbsp;<a href='../../data/bbs/<?=$code?>/<?=$bbs_row[$upfile]?>' target='_blank'><?=$bbs_row[$upfile_name]?></a>
                <? } ?>
                </td>
              </tr>
							<?php
							}
							?>
              <tr>
                <td class="t_name">동영상1</td>
                <td class="t_value" colspan="3">
                <input name="movie1" type="file" value="" class="input">
                <? if($bbs_row[movie1] != ""){ ?>
                	<input type="checkbox" name="delupfile[]" value="movie1"> 삭제
                	&nbsp;<a href='../../data/bbs/<?=$code?>/<?=$bbs_row[movie1]?>' target='_blank'><?=$bbs_row[movie1]?></a>
                <? } ?>
                </td>
              </tr>
              <tr>
                <td class="t_name">동영상2</td>
                <td width="275" class="t_value" colspan="3"><input name="movie2" size="50" type="text" value="<?=$bbs_row[movie2]?>" class="input"></td>
              </tr>
              <tr>
                <td class="t_name">동영상3</td>
                <td width="275" class="t_value" colspan="3"><input name="movie3" size="50" type="text" value="<?=$bbs_row[movie3]?>" class="input"></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

			<br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center">
          	<input type="image" src="../image/btn_confirm_l.gif"> &nbsp; 
          	<img src="../image/btn_list_l.gif" style="cursor:hand" onClick="document.location='list.php?<?=$param?>';">
          </td>
        </tr>
      </form>
      </table>

<? include "../foot.php"; ?>
