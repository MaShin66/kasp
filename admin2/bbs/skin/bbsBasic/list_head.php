
<!-- 검색 -->
<div class="search_box">
  <form name="sfrm" action="<?=$PHP_SELF?>">
    <input type="hidden" name="code" value="<?=$code?>">
    <input type="hidden" name="category" value="<?=$category?>">
    <select name="searchopt" class="select">
      <option value="subject">제 목</option>
      <option value="content">내 용</option>
      <option value="subcon">제목 + 내용</option>
      <option value="name">작성자</option>
      <option value="memid">아이디</option>
    </select>	

    <div class="input_box">
      <input type="text" name="searchkey" class="search_input" value="<?=$searchkey?>" size="50">
      <input type="image" class="search_btn" src="/common/images/default/icon_search.png">
    </div>
    <script language="javascript">
    <!--
    searchopt = document.sfrm.searchopt;
    for(ii=0; ii<searchopt.length; ii++){
      if(searchopt.options[ii].value == "<?=$searchopt?>")
        searchopt.options[ii].selected = true;
    }
    -->
    </script>
  </form>
</div>
<!-- 검색 끝 --> 

<!-- 게시물 시작 -->
<table class="table_style table_style1">
  <caption><?=$catlist?></caption>
  <colgroup>
    <col style="width:1%">
    <col class="num" style="width:8%">
    <col style="width:auto">
    <col style="width:12%">
    <col style="width:18%">
    <col class="hit" style="width:10%">
    <?=$hide_recom_start?>
    <col style="width:10%">
    <?=$hide_recom_end?>
  </colgroup>
  <thead>
    <tr>
      <th scope="col">&nbsp;</th>
      <th scope="col">번호</th>
      <th scope="col">제목</th>
      <th scope="col">작성자</th>
      <th scope="col">작성일</th>
      <th scope="col">조회</th>
      <?=$hide_recom_start?>
      <th scope="col">추천</th>
      <?=$hide_recom_end?>
    </tr>
  </thead>
	<tbody>-