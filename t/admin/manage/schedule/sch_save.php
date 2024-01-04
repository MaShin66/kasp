<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?

if($mode == "insert"){

	$type = "SCH";

	$sql = "insert into wiz_bbsinfo (code,type,title,titleimg,header,footer,category,bbsadmin,lpermi,rpermi,wpermi,apermi,cpermi,datetype_list,datetype_view,skin,permsg,perurl,pageurl,editor,usetype,privacy,upfile,movie,comment,remail,imgview,recom,abuse,abtxt,simgsize,mimgsize,rows,lists,newc,hotc,line,subject_len,view_point,write_point,down_point,comment_point,recom_point,point_msg,img_align,btn_view,spam_check,name_type,grp,prior) values('$code','$type','$title','$titleimg','$header','$footer','$category','$bbsadmin','$lpermi','$rpermi','$wpermi','$apermi','$cpermi','$datetype_list','$datetype_view','$skin','$permsg','$perurl','$pageurl','$editor','$usetype','$privacy','$upfile','$movie','$comment','$remail','$imgview','$recom','$abuse','$abtxt','$simgsize','$mimgsize','$rows','$lists','$newc','$hotc','$line','$subject_len','$view_point','$write_point','$down_point','$comment_point','$recom_point','$point_msg','$img_align','$btn_view','$spam_check','$name_type','$grp','$prior')";
	mysql_query($sql) or error(mysql_error());

	complete("일정을 추가 하였습니다.","sch_list.php");


}else if($mode == "update"){

	$sql = "update wiz_bbsinfo set title='$title',titleimg='$titleimg',header='$header',footer='$footer',category='$category',bbsadmin='$bbsadmin',
					lpermi='$lpermi',rpermi='$rpermi',wpermi='$wpermi',apermi='$apermi',cpermi='$cpermi',
					datetype_list='$datetype_list',datetype_view='$datetype_view',skin='$skin',
					permsg='$permsg',perurl='$perurl',editor='$editor',usetype='$usetype',privacy='$privacy',
					upfile='$upfile',movie='$movie',comment='$comment',remail='$remail',imgview='$imgview',
					recom='$recom',abuse='$abuse',abtxt='$abtxt',simgsize='$simgsize',mimgsize='$mimgsize',
					rows='$rows',lists='$lists',newc='$newc',hotc='$hotc',line='$line',subject_len='$subject_len',
					view_point='$view_point',write_point='$write_point',down_point='$down_point',
					comment_point='$comment_point',recom_point='$recom_point',point_msg='$point_msg',
					img_align='$img_align',btn_view='$btn_view',spam_check='$spam_check',name_type='$name_type',
					grp='$grp',prior='$prior' where code = '$code'";
	mysql_query($sql) or error(mysql_error());

	complete("일정 정보를 수정하였습니다.","sch_input.php?mode=update&code=$code&page=$page");

}else if($mode == "delete"){

	$sql = "delete from wiz_bbsinfo where code = '$code'";
	$result = mysql_query($sql) or error(mysql_error());

	complete("해당일정을 삭제하였습니다.","sch_list.php");


}
?>
