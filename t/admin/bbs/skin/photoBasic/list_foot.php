</div
<!-- 게시물 끝 -->   
  
<!-- 페이지 번호 -->
<div class="paging">
			<? print_pagelist($page, $lists, $page_count, $param); ?>
</div>
<!-- 페이지 번호끝 -->

<!-- 버튼 -->
<div class="admin_area">
  	<?=$sel_delete_btn?>
    <?=$sel_copy_btn?>
    <?=$sel_move_btn?>
    <?=$order_btn?>
    <?=$write_btn?>
</div>
<!-- 버튼 끝 -->