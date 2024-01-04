<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<link href="/inc/kasp.css" rel="stylesheet" type="text/css" />
<table width=350 cellpadding=0 cellspacing=6 border=0>
<? for ($i=0; $i<count($list); $i++) { ?>

<tr>
	<td align="left"><img src="/img/bullet1.gif" align="absmiddle" />  
            <?
						$date_arr = explode(" " , $list[$i]['wr_datetime']); 
						$date_main_view = $date_arr[0];             
						
            echo $list[$i]['icon_reply'] . " ";
            echo "<a href='{$list[$i]['href']}' target=_parent>";
            if ($list[$i]['is_notice'])
                echo "{$list[$i]['subject']}";
            else
                echo "{$list[$i]['subject']}";
            echo "</a>";

            if ($list[$i]['comment_cnt']) 
                echo " <a href=\"{$list[$i]['comment_href']}\" target=_parent>{$list[$i]['comment_cnt']}</a>";

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

            echo " " . $list[$i]['icon_new'];
            // echo " " . $list[$i]['icon_file'];
            // echo " " . $list[$i]['icon_link'];
            // echo " " . $list[$i]['icon_hot'];
            // echo " " . $list[$i]['icon_secret'];
            ?>	
	</td>
</tr>

<? } ?>

<? if (count($list) == 0) { ?><tr><td colspan=2 align=center height=50>게시물이 없습니다.</td></tr><? } ?>

</table>