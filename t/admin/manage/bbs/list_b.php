<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<?
$param = "code=$code&category=$category&searchopt=$searchopt&searchkey=$searchkey";
?>
<? include "../head.php"; ?>

<script language="JavaScript" type="text/javascript">
<!--

// 체크박스 전체선택
function selectAll(){
	var i;
	for(i=0;i<document.forms.length;i++){
		if(document.forms[i].idx != null){
			if(document.forms[i].select_checkbox){
				document.forms[i].select_checkbox.checked = true;
			}
		}
	}
	return;
}

// 체크박스 선택해제
function selectCancel(){
	var i;
	for(i=0;i<document.forms.length;i++){
		if(document.forms[i].select_checkbox){
			if(document.forms[i].idx != null){
				document.forms[i].select_checkbox.checked = false;
			}
		}
	}
	return;
}

// 체크박스선택 반전
function selectReverse(form){
	if(form.select_tmp.checked){
		selectAll();
	}else{
		selectCancel();
	}
}

// 체크박스 선택리스트
function selectValue(){
	var i;
	var selbbs = "";
	for(i=0;i<document.forms.length;i++){
		if(document.forms[i].idx != null){
			if(document.forms[i].select_checkbox){
				if(document.forms[i].select_checkbox.checked)
					selbbs = selbbs + document.forms[i].idx.value + "|";
				}
			}
	}
	return selbbs;
}

//선택게시물 삭제
function delBbs(){

	selbbs = selectValue();

	if(selbbs == ""){
		alert("삭제할 게시물을 선택하세요.");
		return false;
	}else{
		if(confirm("선택한 게시물을 정말 삭제하시겠습니까?")){
			document.location = "save.php?mode=delbbs&selbbs=" + selbbs + "&<?=$param?>";
		}
	}
}

//게시물이동
function moveBbs(){
	selbbs = selectValue();

	if(selbbs == ""){
		alert("이동할 게시물을 선택하세요.");
		return false;
	}else{
		var uri = "/admin/bbs/move.php?code=<?=$code?>&selbbs=" + selbbs;
		window.open(uri,"moveBbs","width=300,height=80");
	}
}

// 게시물복사
function copyBbs(){
	selbbs = selectValue();
	if(selbbs == ""){
		alert("복사할 게시물을 선택하세요.");
		return false;
	}else{
		var uri = "/admin/bbs/copy.php?code=<?=$code?>&selbbs=" + selbbs;
		window.open(uri,"copyBbs","width=300,height=80,resizable=yes");
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
      <form name="searchForm" action="list.php" method="get">
        <tr>
          <td width="100" class="tit_sub"><img src="../image/ics_tit.gif"> 선택게시판 : </td>
          <td>
          <select name="code" onChange="this.form.submit();">
          <?
          	$no = 0;
            $sql = "select * from wiz_bbsinfo where type = 'BBS'";
            $result = mysql_query($sql) or error(mysql_error());
            while($row = mysql_fetch_array($result)){
            	if($code == "" && $no == 0) $code = $row[code];
            	if($row[code] == $code) $bbs_info = $row;
            	echo "<option value='".$row[code]."'>".$row[title]."</option>";
          		$no++;
            }
          ?>
          </select>
          <?
          $sql = "select idx, catname from wiz_bbscat where code = '$code' and gubun != 'A' order by idx asc";
          $result = mysql_query($sql) or error(mysql_error());
          $total = mysql_num_rows($result);
          if($total > 0) {
					?>
          <select name="category" onChange="this.form.submit();">
          <option value="">:: 분류 ::</option>
					<?
						while($row = mysql_fetch_array($result)) {
							if($category == $row[idx]) $selected = "selected";
							else $selected = "";
          		echo "<option value='".$row[idx]."'>".$row[catname]."</option>";
						}
					}
					?>
					</select>
          </td>
          <td align="right">
          	<table border="0" cellpadding="0" cellspacing="0">
          		<tr>
          			<td>
          				<select name="searchopt">
			            <option value="subject">제목
			            <option value="content">내용
			            </select>
          			</td>
          			<td><input type="text" size="13" name="searchkey" value="<?=$searchkey?>" class="input"></td>
          			<td width="2"></td>
          			<td><input type="image" src="../image/btn_search.gif"></td>
          		</tr>
          	</table>
					</td>
        </tr>
        <tr><td height="3"></td></tr>
      </form>
      </table>
      <script language="javascript">
      <!--
      code = document.searchForm.code;
      for(ii=0; ii<code.length; ii++){
        if(code.options[ii].value == "<?=$code?>")
        code.options[ii].selected = true;
      }
      if(document.searchForm.category != null){
      category = document.searchForm.category;
      for(ii=0; ii<category.length; ii++){
        if(category.options[ii].value == "<?=$category?>")
        category.options[ii].selected = true;
      }
    	}
      searchopt = document.searchForm.searchopt;
      for(ii=0; ii<searchopt.length; ii++){
        if(searchopt.options[ii].value == "<?=$searchopt?>")
        searchopt.options[ii].selected = true;
      }
      -->
      </script>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="layout:fixed;">
      	<form>
      	<tr><td colspan=20 class="t_rd"></td></tr>
        <tr class="t_th">
        	<th width="5%"><input type="checkbox" name="select_tmp" onClick="selectReverse(this.form)"></th>
          <th width="7%">번호</th>
          <th>제목</th>
          <th width="10%">작성자</th>
          <th width="10%">작성일</th>
          <th width="5%">조회</th>
        </tr>
        <tr><td colspan=20 class="t_rd"></td></tr>
        </form>
      <?
      // 공지글 가져오기
      $sql = "select wb.idx,wb.name,wb.subject,wb.notice, wb.wdate as wtime,date_format(from_unixtime(wb.wdate), '%Y-%m-%d') as wdate,wb.count, wc.catname as category 
      				from wiz_bbs as wb left join wiz_bbscat as wc on wb.category = wc.idx
      				where wb.code = '$code' and wb.notice = 'Y'";
      $result = mysql_query($sql) or error(mysql_error());
      $n_total = mysql_num_rows($result);

      while($row = mysql_fetch_array($result)){
      ?>
        <form>
		    <input type="hidden" name="idx" value="<?=$row->idx?>">
        <tr>
        	<td height="30" align="center"><input type="checkbox" name="select_checkbox"></td>
          <td align="center"><font color='red'>[공지]</font></td>
          <td style="word-break:break-all;"> <a href="view.php?code=<?=$code?>&idx=<?=$row[idx]?>&page=<?=$page?>"><?=$row[subject]?></a></td>
          <td align="center"><?=$row[name]?></td>
          <td align="center"><?=$row[wdate]?></td>
          <td align="center"><?=$row[count]?></td>
        </tr>
         <tr><td colspan="20" class="t_line"></td></tr>
        </form>
      <?
      }

			if($category) $category_sql = " and category = '$category' ";
			if($searchopt) $search_sql = " and $searchopt like '%$searchkey%' ";
			
			$sql = "select wb.*, wb.wdate as wtime, from_unixtime(wb.wdate, '%Y-%m-%d') as wdate, wc.catname
							from wiz_bbs as wb left join wiz_bbscat as wc on wb.category = wc.idx 
							where wb.code = '$code' $category_sql $search_sql order by wb.prino desc";
							
			$result = mysql_query($sql) or error(mysql_error());
			$total = mysql_num_rows($result);

      $rows = 20;
      $lists = 5;
      $ttime = mktime(0,0,0,date('m'),date('d'),date('Y'));
    	$page_count = ceil($total/$rows);
    	if(!$page || $page > $page_count) $page = 1;
    	$start = ($page-1)*$rows;
    	$no = $total-$start;

			$sql = "select wb.*, wb.wdate as wtime, from_unixtime(wb.wdate, '%Y-%m-%d') as wdate, wc.catname as category 
							from wiz_bbs as wb left join wiz_bbscat as wc on wb.category = wc.idx 
							where wb.code = '$code' $category_sql $search_sql 
							order by wb.prino desc limit $start, $rows";
			$result = mysql_query($sql) or error(mysql_error());
			
			while($row = mysql_fetch_array($result)){
				
				$name = $row[name]; $wdate = $row[wdate]; $count = $row[count];
				$tno = "<a href='view.php?idx=$row[idx]&page=$page&$param'>$no</a>";
				$subject = "<a href='view.php?idx=$row[idx]&page=$page&$param'>$row[subject]</a>";			//subject

				$comment=""; $category=""; $lock=""; $re=""; $new=""; $hot=""; $file=""; $re_space="";
				if($bbs_info[comment] == "Y") $comment = "(".$row[comment].")";
				if($row[category] != "") $category = "[".$row[category]."]";																// category
				if($row[privacy] == "Y") $lock = "<img src='../image/bbs/lock.gif' border='0' align='absmiddle'>";							// privacy
				if($row[depno] != 0) $re = "<img src='../image/bbs/re.gif' border='0' align='absmiddle'>";																		// re
				//$wtime = mktime(0,0,0,substr($row[wdate],5,2),substr($row[wdate],8,2),substr($row[wdate],0,4));
				$wtime = $row[wtime];
				if(($ttime-$wtime)/86400 <= $bbs_info[newc]) $new = "<img src='../image/bbs/new.gif' border='0' align='absmiddle'>";	// new
				if($row[count] > $bbs_info[hotc]) $hot = "<img src='../image/bbs/hot.gif' border='0' align='absmiddle'>";	// hot
				if(!empty($row[upfile1])) $file = "<img src='../image/bbs/file.gif' border='0' align='absmiddle'>";	// file
		    for($ii=0; $ii < $row[depno]; $ii++) $re_space .= "&nbsp;&nbsp;";						// respace

			?>
		    <form>
		    <input type="hidden" name="idx" value="<?=$row[idx]?>">
		    <tr>
		  	  <td height="30" align="center"><input type="checkbox" name="select_checkbox"></td>
          <td align="center"><?=$tno?></td>
          <td style="word-break:break-all;"><?=$re_space?><?=$re?><?=$category?><?=$subject?> <?=$comment?> <?=$lock?> <?=$new?> <?=$hot?> <?=$file?></td>
          <td align="center"><?=$name?></td>
          <td align="center"><?=$wdate?></td>
          <td align="center"><?=$count?></td>
        </tr>
         <tr><td colspan="20" class="t_line"></td></tr>
        </form>
			<?
			$no--;
      }
      if($total <= 0 && $n_total <= 0){
      ?>
         <tr><td height=25 colspan=5 align=center>작성된 글이 없습니다.</td></tr>
         <tr><td height="1" colspan="10" bgcolor="EBEBEB"></td></tr>
      <?
      }
      ?>
      </table>

      <table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
      	<tr><td height="5"></td></tr>
        <tr>
          <td width="30%">
            <img src="../image/btn_bbswrite.gif" style="cursor:hand" onClick="document.location='input.php?code=<?=$code?>';">
            <img src="../image/btn_seldel.gif" style="cursor:hand" onClick="delBbs();">
          </td>
          <td width="30%"><? print_pagelist($page, $lists, $page_count, $param); ?></td>
          <td width="30%" align="right">
          	<img src="../image/btn_bbsmove.gif" style="cursor:hand" onClick="moveBbs();">
            <img src="../image/btn_bbscopy.gif" style="cursor:hand" onClick="copyBbs();">
          </td>
        </tr>
      </table>

<? include "../foot.php"; ?>
