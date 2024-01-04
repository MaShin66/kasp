<script language="javascript">
<!--
function viewImg(img){
   var url = "/admin/bbs/view_img.php?code=<?=$code?>&img=" + img;
   window.open(url, "viewImg", "height=100, width=100, menubar=no, scrollbars=no, resizable=yes, toolbar=no, status=no");
}
//-->
</script>

<table class="table_style table_style2">
  <caption>테이블형식 2</caption>
  <colgroup>
    <col class="th_col" style="width:100px">
    <col class="td_col" style="width:581px">
    <col class="th_col" style="width:100px">
    <col class="td_col" style="width:*">
  </colgroup>
  <tbody>
    <tr>
      <th scope="row">이름</th>
      <td><?=$name?></td>
      <th scope="row">이메일</th>
      <td><?=$email?></td>
    </tr>
    <tr>
      <th scope="row">작성일</th>
      <td><?=$wdate?></td>
      <th scope="row">조회수</th>
      <td style="color:#999"><?=$count?></td>
    </tr>
    <?=$hide_upfile_start?>
    <tr>
      <th scope="row">파일첨부</th>
      <td colspan="3" class="file_list"><?=$upfile1?> <?=$upfile2?> <?=$upfile3?> <?=$upfile4?> <?=$upfile5?> <?=$upfile6?> <?=$upfile7?> <?=$upfile8?> <?=$upfile9?> <?=$upfile10?> <?=$upfile11?> <?=$upfile12?></td>
    </tr>
    <?=$hide_upfile_end?>
    <tr>
      <th scope="row">제목</th>
      <td colspan="3" class="tit"><b><?=$catname?><?=$subject?></b></td>
      <?=$hide_recom_start?><br>추천:<?=$recom?><?=$hide_recom_end?>
    </tr>
    <tr>
      <td colspan="4">
        <?=$upimg1?><?=$upimg2?><?=$upimg3?><?=$upimg4?><?=$upimg5?><?=$upimg6?>
        <?=$upimg7?><?=$upimg8?><?=$upimg9?><?=$upimg10?><?=$upimg11?><?=$upimg12?>
        <?=$movie1?><?=$movie2?><?=$movie3?>
        <?=$content?>
      </td>
    </tr>
  </tbody>
</table>

<table class="table_style table_style2" style="margin-top:40px;border-top:1px solid #ddd">
  <caption>테이블형식 2</caption>
  <colgroup>
    <col class="th_col" style="width:100px">
    <col class="td_col" style="width:581px">
    <col class="th_col" style="width:100px">
    <col class="td_col" style="width:*">
  </colgroup>
  <tbody>
    <tr>
      <th scope="row">이전글</th>
      <td colspan="3"><?=$prev?></td>
    </tr>
    <tr>
      <th scope="row">다음글</th>
      <td colspan="3"><?=$next?></td>
    </tr>
  </tbody>
</table>
