<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include "../head.php"; ?>
<?php
$param = "&analy_type=$analy_type&search_engin=$search_engin&prev_year=$prev_year&prev_month=$prev_month&prev_day=$prev_day";
$param .= "&next_year=$next_year&next_month=$next_month&next_day=$next_day";
?>
<script language="javascript">
<!--

function delConnect(){
	if(confirm("접속경로분석 모든 데이타가 삭제됩니다. 초기화 하시겠습니까?")){
		document.location = 'connect_save.php?mode=delrefer';
	}
}

-->
</script>

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">접속경로분석</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">접속경로를 분석합니다.</td>
        </tr>
      </table>
      
      <br>
	  <form name="frm" action="<?=$PHP_SELF?>" method="get">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td bgcolor="ffffff">
          <table width="100%" cellspacing="1" cellpadding="3" border="0" class="t_style">
          <tr>
          <td width="15%" class="t_name">분석방법</td>
          <td width="85%" class="t_value">
          <input type="radio" name="analy_type" value="RA" onClick="this.form.search_engin.value='';this.form.submit();" <? if($analy_type == "RA" || $analy_type == "") echo "checked"; ?>>접속경로
          <input type="radio" name="analy_type" value="RB" onClick="this.form.search_engin.value='';this.form.submit();" <? if($analy_type == "RB") echo "checked"; ?>>검색엔진,링크사이트
          </td>
          </tr>
          <tr>
          <td class="t_name">기간</td>
          <td class="t_value">
          
          <select name="prev_year" class="select2">
         <? 
						if($analy_type == ""){   
							if(empty($prev_year)) $prev_year = "2007";
							if(empty($prev_month)) $prev_month = "01";
							if(empty($prev_day)) $prev_day = "01";
						}
            if(empty($next_year)) $next_year = date("Y");
            if(empty($next_month)) $next_month = date("m");
            if(empty($next_day)) $next_day = date("d");

            for($ii=2004; $ii <= 2020; $ii++){
              if($ii == $prev_year) echo "<option value=$ii selected>$ii";
              else echo "<option value=$ii>$ii";
            }
         ?>
           </select>년 
           <select name="prev_month" class="select2">
             <?
            for($ii=1; $ii <= 12; $ii++){
              if($ii<10) $ii = "0".$ii;
              if($ii == $prev_month) echo "<option value=$ii selected>$ii";
              else echo "<option value=$ii>$ii";
            }
         ?>
           </select>월 
           <select name="prev_day" class="select2">
             <?
            for($ii=1; $ii <= 31; $ii++){
              if($ii<10) $ii = "0".$ii;
              if($ii == $prev_day) echo "<option value=$ii selected>$ii";
              else echo "<option value=$ii>$ii";
            }
         ?>
           </select>일 ~ 
           <select name="next_year" class="select2">
             <?
            for($ii=2004; $ii <= 2020; $ii++){
              if($ii == $next_year) echo "<option value=$ii selected>$ii";
              else echo "<option value=$ii>$ii";
            }
         ?>
           </select>년 
           <select name="next_month" class="select2">
             <?
            for($ii=1; $ii <= 12; $ii++){
              if($ii<10) $ii = "0".$ii;
              if($ii == $next_month) echo "<option value=$ii selected>$ii";
              else echo "<option value=$ii>$ii";
            }
         ?>
           </select>월 
           <select name="next_day" class="select2">
             <?
            for($ii=1; $ii <= 31; $ii++){
              if($ii<10) $ii = "0".$ii;
              if($ii == $next_day) echo "<option value=$ii selected>$ii";
              else echo "<option value=$ii>$ii";
            }
         ?>
           </select>일
          <tr>
          <td class="t_name">검색엔진</td>
          <td class="t_value">
            <select name="search_engin">
            <option value="">:: 검색엔진 선택 ::
            <option value="yahoo" <? if($search_engin == "yahoo") echo "selected"; ?>>Yahoo
            <option value="naver" <? if($search_engin == "naver") echo "selected"; ?>>Naver
            <option value="empas" <? if($search_engin == "empas") echo "selected"; ?>>Empas
            <option value="daum" <? if($search_engin == "daum") echo "selected"; ?>>Daum
            <option value="msn" <? if($search_engin == "msn") echo "selected"; ?>>Msn
            <option value="google" <? if($search_engin == "google") echo "selected"; ?>>Google
            <option value="nate" <? if($search_engin == "nate") echo "selected"; ?>>Nate
            <option value="korea" <? if($search_engin == "korea") echo "selected"; ?>>Korea.com
            <option value="dreamwiz" <? if($search_engin == "dreamwiz") echo "selected"; ?>>DreamWiz
            <option value="netian" <? if($search_engin == "netian") echo "selected"; ?>>Netian
            </select>
            <input type="image" src="../image/btn_search.gif" align="absmiddle">
            <img src="../image/btn_conreset2.gif" align="absmiddle" style="cursor:hand" onClick="delConnect();">
          </td>
          </tr>
          </table>
          </td>
        </tr>
      </table>
	  </form>
      <table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
        <tr><td></td></tr>
      </table> 
      <?

			$prev_period = $prev_year."-".$prev_month."-".$prev_day;
			$next_period = $next_year."-".$next_month."-".$next_day;
			$period_sql = " wdate >= '$prev_period' and wdate <= '$next_period' ";
	
			$sql = "select sum(cnt) as total_cnt from wiz_conrefer where $period_sql";
	    	$result = mysql_query($sql) or error(mysql_error());
	    	$row = mysql_fetch_object($result);
	    	$total_cnt = $row->total_cnt;
      	

			// 접속시간별
			if($analy_type == "RA" || $analy_type == ""){

				echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' style='layout:fixed;'>\n";
				echo "<tr><td class='t_rd' colspan=20></td></tr>\n";
				echo "  <tr class='t_th'> \n";
				echo "    <th width='8%'>번호</th>";
				echo "    <th>방문경로</th>\n";
				echo "    <th width='10%'>접속자수</th>\n";
				echo "    <th width='10%'>비율</th>\n";
				echo "  </tr>\n";
				echo "<tr><td class='t_rd' colspan=20></td></tr>\n";

				$sql = "select sum(cnt) as cnt,referer from wiz_conrefer where host like '%$search_engin%' and $period_sql group by referer order by cnt desc";;
				$result = mysql_query($sql) or error(mysql_error());
				$total = mysql_num_rows($result);
				
				$lists = 5;
				$rows = 20;
				if(empty($page)) $page = 1;
				$page_count = ceil($total/$rows);
				$start = ($page-1)*$rows;
				$no = $total-$start;
				
				$sql = "select sum(cnt) as cnt,referer from wiz_conrefer where host like '%$search_engin%' and $period_sql group by referer order by cnt desc limit $start, $rows";
				$result = mysql_query($sql) or error(mysql_error());
				
				while($row = mysql_fetch_object($result)){
				
					$percent = ceil(($row->cnt/$total_cnt)*100);
				
					if($row->referer == "") $row->referer = "즐겨찾기나 직접방문";
					else $row->referer = "<a href='$row->referer' target='_blank'>$row->referer</a>";
				
					echo "<tr> \n";
					echo "  <td align='center'>$no</td>";
					echo "  <td height='30' style='word-break:break-all;'>$row->referer</td>\n";
					echo "  <td align='center'>".$row->cnt."</td>\n";
					echo "  <td align='center'>".$percent."%</td>\n";
					echo "</tr>\n";
					echo "<tr><td colspan='20' class='t_line'></td></tr>\n";
					
      		$no--;
        }
        if($total <= 0){
    		 echo "<tr><td height='30' colspan=10 align=center>접속경로 정보가 없습니다.</td></tr>";
    		 echo "<tr><td colspan='20' class='t_line'></td></tr>\n";
    	  }
        echo "</table>\n";
      
      
      }else if($analy_type == "RB"){
      	
				echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' style='layout:fixed;'>\n";
				echo "<tr><td class='t_rd' colspan=20></td></tr>\n";
				echo "  <tr class='t_th'> \n";
				echo "    <th width='8%'>번호</th>";
				echo "    <th width='30%'>검색엔진</th>\n";
				echo "    <th width='10%'>접속자수</th>\n";
				echo "    <th width='10%'>비율</th>\n";
				echo "    <th>그래프</th>\n";
				echo "  </tr>\n";
				echo "<tr><td class='t_rd' colspan=20></td></tr>\n";

         $sql = "select sum(cnt) as cnt, host, referer from wiz_conrefer where host like '%$search_engin%' and $period_sql group by host order by cnt desc";
         $result = mysql_query($sql) or error(mysql_error());
         $total = mysql_num_rows($result);
         
         $lists = 5;
         $rows = 20;
         $page_count = ceil($total/$rows);
         if(!$page || $page > $page_count) $page = 1;
         $start = ($page-1)*$rows;
         $no = $total-$start;
         
       $sql = "select sum(cnt) as cnt, host, referer from wiz_conrefer where host like '%$search_engin%' and $period_sql group by host order by cnt desc";
       $result = mysql_query($sql) or error(mysql_error());
       
       	while($row = mysql_fetch_object($result)){
       	
         	if($row->host == "") $row->host = "즐겨찾기나 직접방문";
					else $row->host = "<a href='http://$row->host' target='_blank'>http://$row->host</a>";
					
         	$percent = ceil(($row->cnt/$total_cnt)*100);

            echo "<tr> \n";
            echo "  <td align='center'>$no</td>";
            echo "  <td height='30' style='word-break:break-all;'>$row->host</td>\n";
            echo "  <td align='center'>$row->cnt</td>\n";
            echo "  <td align='center'>".$percent."%</td>\n";
            echo "  <td><img src='../image/mark_bar.gif' width='".($percent*2)."' height='10'></td>\n";
            echo "</tr>\n";
            echo "<tr><td colspan='20' class='t_line'></td></tr>\n";
           
      		$no--;
        }
        if($total <= 0){
    		 echo "<tr><td height='30' colspan=10 align=center>접속경로 정보가 없습니다.</td></tr>";
    		 echo "<tr><td colspan='20' class='t_line'></td></tr>\n";
    	  }
        echo "</table>\n";
      	
      
      
      }else if($analy_type == "RC"){
      	
				// 분석할 파라메터 가져오기
				$sql = "select con_parameter from wiz_siteinfo";
				$result = mysql_query($sql) or error(mysql_error());
				$row = mysql_fetch_object($result);
				
				$parameter = explode(",",$row->con_parameter);

				echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' style='layout:fixed;'>\n";
				echo "<tr><td class='t_rd' colspan=20></td></tr>\n";
				echo "  <tr class='t_th'> \n";
				echo "    <th width='8%'>번호</th>";
				echo "    <th width='10%'>키워드</th>\n";
				echo "    <th width='10%'>접속자수</th>\n";
				echo "    <th width='10%'>비율</th>\n";
				echo "    <th>그래프</th>\n";
				echo "  </tr>\n";
				echo "<tr><td class='t_rd' colspan=20></td></tr>\n";
				
      	$sql = "select * from wiz_conrefer where host like '%$search_engin%' and $period_sql order by cnt desc";
      	$result = mysql_query($sql) or error(mysql_error());
      	$key_list_tmp = "";
				$no = 0;
      	while($row = mysql_fetch_object($result)){

      		if($row->referer != ""){
      			
      			for($ii=0; $ii < count($parameter) && $parameter[$ii] != ""; $ii++){

         			$key_start = strpos($row->referer, $parameter[$ii]."=");
         			if($key_start > 0){
         				$key_start = $key_start + strlen($parameter[$ii]."=");
         				$key_end =  strpos($row->referer, "&", $key_start);
         				if($key_end <= 0) $key_end = strlen($row->referer);
         				
         				$keyword = substr($row->referer, $key_start, $key_end-$key_start);
         				$keyword = urldecode($keyword);

         				$key_list_tmp[$no][name] = $keyword;
         				$key_list_tmp[$no][cnt] = $row->cnt;
         				
         			}
      				
      				$no++;
      			}
      			
      		}
      		
      		
      	}

      	if(count($key_list_tmp) > 1) sort($key_list_tmp);
      	
      	$key_name_tmp = "";
      	$key_cnt_tmp = 0;
      	$no = -1;
      	
      	for($ii=0; $ii < count($key_list_tmp); $ii++){
      		
      		if($key_name_tmp != $key_list_tmp[$ii][name]){
      			$no++;
      			$key_name_tmp = $key_list_tmp[$ii][name];
      			$key_list[$no][cnt] = $key_list_tmp[$ii][cnt];
      			$key_list[$no][name] = $key_list_tmp[$ii][name];
      		}else{
      			$key_list[$no][cnt] += $key_list_tmp[$ii][cnt];
      		}
      	}
      	
      	if(count($key_list) > 0) rsort($key_list);
      	$no = count($key_list);
      	
      	$lists = 5;
         $rows = 20;
         if(empty($page)) $page = 1;
         $total = count($key_list);
         $page_count = ceil($total/$rows);
         $start = ($page-1)*$rows;
         $no = $total-$start;

         if(count($key_list) > 1){
         	
	      	for($ii=$start; $ii < count($key_list) && $rows > 0; $ii++){
	      		
	      		if(!empty($key_list[$ii][name])){
	      			
	      			$percent = ceil(($key_list[$ii][cnt]/$total_cnt)*100);
	
	      			echo "<tr> \n";
	            	echo "  <td align='center'>$no</td>";
	            	echo "  <td height='30' style='word-break:break-all;'>".$key_list[$ii][name]."</td>\n";
	            	echo "  <td align='center'>".$key_list[$ii][cnt]."</td>\n";
	            	echo "  <td align='center'>".$percent."%</td>\n";
	            	echo "  <td><img src='../image/mark_bar.gif' width='".($percent*2)."' height='10'></td>\n";
	            	echo "</tr>\n";
	            	echo "<tr><td colspan='20' class='t_line'></td></tr>\n";
	            }
	            
	            $rows--;
	            $no--;
	      	}
      	
      	}else{
    		  echo "<tr><td height='30' colspan=10 align=center>검색키워드가 없습니다.</td></tr>";
    		  echo "<tr><td colspan='20' class='t_line'></td></tr>\n";
    	   }
         echo "</table>\n";

      }
   	?>
      <table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td></td>
        </tr>
      </table>
      
      <? print_pagelist($page, $lists, $page_count, $param); ?>
      
<? include "../foot.php"; ?>
