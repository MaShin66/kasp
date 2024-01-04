<!-- jQuery UI CSS����  --> 
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />
<!-- jQuery �⺻ js���� --> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<!-- jQuery UI ���̺귯�� js���� --> 
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
<style type="text/css">
<!--
.ui-datepicker { font:12px dotum; }
.ui-datepicker select.ui-datepicker-month, 
.ui-datepicker select.ui-datepicker-year { width: 70px;}
.ui-datepicker-trigger { margin:0 0 -5px 2px; }
-->
</style>
<script language="JavaScript">
$( document ).ready(function() {
	//����ٹ��� selectbox 
	$("#zipcode").val("<?=$zipcode?>");
	$("#gender").val("<?=$addinfo1[1]?>");
	$("#w_type").val("<?=$addinfo2[1]?>");
	$("#w_field").val("<?=$addinfo2[0]?>");
	$.datepicker.regional['ko'] = {
		closeText: '�ݱ�',
		prevText: '������',
		nextText: '������',
		currentText: '����',
		monthNames: ['1��(JAN)','2��(FEB)','3��(MAR)','4��(APR)','5��(MAY)','6��(JUN)',
		'7��(JUL)','8��(AUG)','9��(SEP)','10��(OCT)','11��(NOV)','12��(DEC)'],
		monthNamesShort: ['1��','2��','3��','4��','5��','6��',
		'7��','8��','9��','10��','11��','12��'],
		dayNames: ['��','��','ȭ','��','��','��','��'],
		dayNamesShort: ['��','��','ȭ','��','��','��','��'],
		dayNamesMin: ['��','��','ȭ','��','��','��','��'],
		weekHeader: 'Wk',
		dateFormat: 'yymmdd',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ko']);
	//input[id*='period']	
  $('#eadd').click(function(){
	  //edutable ���� tr ����� id �� addtr�� ����ִ� ����� length
		var edu = $("#edutable tr[id*='addtr']").length;
		//length
		edu--;
		if(edu>4){
			alert('�з��߰��� ���̻� �Ҽ������ϴ�.');
		} else {
			if(edu > 1){
					$('#removeline'+edu).hide();
				}
			//�з»��� ���� üũ 
			$('#educhk').val(edu+1);
			$('#addtr'+edu).after(				
				"<tr id='line"+(edu+1)+"'><td colspan='5' height='1' bgcolor='#d7d7d7'></td></tr>"+
				"<tr height='30' id='addtr"+(edu+1)+"'>"+
				"<td align='left' style='padding-left:5px;border-right:1px solid #d7d7d7;'><input name='period"+(edu+1)+"_1' id='period"+(edu+1)+"_1' onClick='datepic(this)' readonly type='text' size='10' class='input'/> ~ <input name='period"+(edu+1)+"_2' id='period"+(edu+1)+"_2' onClick='datepic(this)' readonly type='text' size='10' class='input'/></td>"+
				"<td align='left' style='padding-left:5px;border-right:1px solid #d7d7d7;'><input name='s_name"+(edu+1)+"' id='s_name"+(edu+1)+"' type='text' size='15' class='input'></td>"+
				"<td align='left' style='padding-left:5px;border-right:1px solid #d7d7d7;'><input name='s_area"+(edu+1)+"' id='s_area"+(edu+1)+"' type='text' size='10' class='input'></td>"+
				"<td align='left' style='padding-left:5px;border-right:1px solid #d7d7d7;'><input name='major"+(edu+1)+"' id='major"+(edu+1)+"' type='text' size='10' class='input'></td>"+
				"<td align='left' style='padding-left:5px;border-right:1px solid #d7d7d7;'><input name='score"+(edu+1)+"_1' id='score"+(edu+1)+"_1' type='text' size='5' class='input'> / <input name='score"+(edu+1)+"_2' id='score"+(edu+1)+"_2' type='text' size='5' class='input'>&nbsp;<img id='removeline"+(edu+1)+"' width='12' height='12' onClick=trremove('addtr"+(edu+1)+"','line"+(edu+1)+"') style='cursor:hand' src='<?=$skin_dir?>/image/btn_minus.png'/></td></tr>"
			);
		}
  });
});

function datepic(obj){ 	
	$(obj).datepicker({
		changeMonth: true, 
        changeYear: true,
        yearRange: 'c-100:c+10',
		minDate: '-100y', 
		nextText: '���� ��',
         prevText: '���� ��',
		 closeText: '�ݱ�',
		 dateFormat: "yy-mm-dd"
	}).datepicker("show");
}
//tr ���� function �ش� ��ü�� ���� �� �ٷ� ���� ��ü�� removeline�� hidden => show
function trremove(obj,line){
	var num = obj.charAt(obj.length-1);
	num--;
	//�з»��� ���� üũ
	$('#educhk').val($('#educhk').val()-1);
	$('#'+obj).remove();
	$('#'+line).remove();
	$('#removeline'+num).show();
}
<!--
function bbsCheck(frm){

  if(frm.name.value == ""){
    alert("�ۼ��ڸ� �Է��ϼ���.");
    frm.name.focus();
    return false;
  }
  if(frm.passwd != null && frm.passwd.value == ""){
    alert("��й�ȣ�� �Է��ϼ���.");
    frm.passwd.focus();
    return false;
  }
  if(frm.subject.value == ""){
    alert("������ �Է��ϼ���.");
    frm.subject.focus();
    return false;
  }
  try{ content1.outputBodyHTML(); } catch(e){ }
  if(frm.content1.value == ""){
		alert("��»����� �Է��ϼ���.");
		frm.content1.focus();
		return false;
  }
  try{ content2.outputBodyHTML(); } catch(e){ }
  if(frm.content2.value == ""){
		alert("�ڱ�Ұ����� �Է��ϼ���.");
		frm.content2.focus();
		return false;
  }
  if(frm.h_salary.value == "" || !check_Num(frm.h_salary.value)){
	alert("��������� �ùٸ��� �Է��ϼ���.");
	frm.h_salary.focus();
	return false;
  }
  if(frm.gender.value == ""){
	alert("������ �����ϼ���.");
	frm.gender.focus();
	return false;
  }
  if(frm.zipcode.value == ""){
	alert("����ٹ����� �����ϼ���.");
	frm.zipcode.focus();
	return false;
  }
  if(frm.w_field.value == ""){
	alert("�����о߸� �����ϼ���.");
	frm.w_field.focus();
	return false;
  }
  if(frm.career.value == ""){
	alert("����� �Է��ϼ���.");
	frm.career.focus();
	return false;
  }
  if(frm.w_type.value == ""){
	alert("�ٹ����¸� �����ϼ���.");
	frm.w_type.focus();
	return false;
  }
  if (frm.vcode != undefined && (hex_md5(frm.vcode.value) != md5_norobot_key)) {
  	alert("�ڵ���Ϲ����ڵ带 ��Ȯ�� �Է����ּ���.");
    frm.vcode.focus();
    return false;
	}

}

// ���� üũ
function check_Num(tocheck)
{
	//if (tocheck == null || tocheck == "")
	//{
	//	return false;
	//}
	tocheck = tocheck.replace(".","");
	for(var j = 0 ; j < tocheck.length; j++)
	{
		if ( tocheck.substring(j, j + 1) != "0"
			&&   tocheck.substring(j, j + 1) != "1"
			&&   tocheck.substring(j, j + 1) != "2"
			&&   tocheck.substring(j, j + 1) != "3"
			&&   tocheck.substring(j, j + 1) != "4"
			&&   tocheck.substring(j, j + 1) != "5"
			&&   tocheck.substring(j, j + 1) != "6"
			&&   tocheck.substring(j, j + 1) != "7"
			&&   tocheck.substring(j, j + 1) != "8"
			&&   tocheck.substring(j, j + 1) != "9" )
		{
			return false;
		}
	}	
	return true;
}
-->
</script>
<form name="bbsFrm" id="bbsFrm" action="<?=$PHP_SELF?>" method="post" enctype="multipart/form-data" onSubmit="return bbsCheck(this)">
<input type="hidden" name="ptype" value="save">
<input type="hidden" name="code" value="<?=$code?>">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="searchopt" value="<?=$searchopt?>">
<input type="hidden" name="searchkey" value="<?=$searchkey?>">
<input type="hidden" name="tmp_vcode" value="<?=md5($norobot_key)?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" align="right" height="25"><font color="#000000">*</font> ǥ�ô� �ʼ��Է� �������� �� �ۼ��� �ݵ�� �����ؾ� �ϴ� �׸��Դϴ�.</td>
  </tr>
  <tr>
    <td colspan="4" height="2" bgcolor="#a9a9a9"></td>
  </tr>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>���� *</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><?=$catlist?><input name="subject" value="<?=$subject?>" type="text" size="60" class="input" /></td>
  </tr>
    <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>�ۼ��� *</strong></td>
    <td width="35%" align="left" colspan="3"  style="padding-left:10px;"><input name="name" value="<?=$name?>" type="text" size="20" class="input" /></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?=$hide_admin_start?>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>�ۼ���</strong></td>
    <td align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;"><input name="wdate" value="<?=$wdate?>" type="text" size="20" class="input" /></td>
    <td align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>��ȸ��</strong></td>
    <td align="left" style="padding-left:10px;"><input name="count" value="<?=$count?>" type="text" size="20" class="input" /></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?=$hide_admin_end?>
  <?=$hide_passwd_start?>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>��й�ȣ *</strong></td>
  	<td align="left" colspan="3" style="padding-left:10px;"><input name="passwd" value="<?=$passwd?>" type="password" size="20" class="input" /> * �� ���� ������ �ʿ��Ͻ� �� ������ �ֽñ� �ٶ��ϴ�.</td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?=$hide_passwd_end?>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>������</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><input name="address" id="address" value="<?=$address?>" type="text" size="60" class="input" /></td>
  </tr>
    <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>�������</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;"><input name="birth" id="birth" onClick="datepic(this)" readonly value="<?=$addinfo1[0]?>" type="text" size="20" class="input" /></td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>���� *</strong></td>
    <td width="35%" align="left" style="padding-left:10px;">
		<select class="select" name="gender" id="gender">
			<option value="">����</option>
			<option value="1" <?if($addinfo[1]=="1") echo "selected";?>>��</option>
			<option value="2" <?if($addinfo[1]=="2") echo "selected"?>>��</option>
		</select>
	</td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  
 <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>����ó</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center" height="30" style="padding-left:5px;"><strong>�� �Ϲ���ȭ&nbsp;:&nbsp;</strong></td>
			<td align="left" style="padding-left:5px;"><input name="tphone" id="tphone" value="<?=$tphone?>" type="text" size="20" class="input"></td>			
		</tr>
		<tr>
			<td align="center" height="30" style="padding-left:5px;"><strong>�� �̵���ȭ&nbsp;:&nbsp;</strong></td>
			<td align="left" style="padding-left:5px;"><input name="hphone" id="hphone" value="<?=$hphone?>" type="text" size="20" class="input"></td>
		</tr>
		<tr>
			<td align="center" height="30" style="padding-left:5px;"><strong>�� E - mail&nbsp;:&nbsp;</strong></td>
			<td align="left" style="padding-left:5px;"><input name="email" id="email" value="<?=$email?>" type="text" size="20" class="input"></td>
		</tr>
		</table>
	</td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>��� *</strong></td>
    <td width="35%" align="left" style="padding-left:10px;"><input name="career" id="career" value="<?=$addinfo1[2]?>" placeholder="��) ���� / ��� (0��)"  type="text" size="20" class="input"></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
   
  <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>�ٹ����� *</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;">
		<select class="select" name="w_type" id="w_type">
			<option value="">����</option>
			<option value="0">����</option>
			<option value="1">������</option>
			<option value="2">�����</option>
			<option value="3">����� �� ������ ��ȯ</option>
			<option value="4">����Ư��</option>
			<option value="5">������</option>
			<option value="6">���� �� ������ ��ȯ</option>								
		</select>
	</td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>����ٹ��� *</strong></td>
    <td width="35%" align="left" style="padding-left:10px;">
		<select class="select" name="zipcode" id="zipcode">
				<option value="">����</option>
				<option value="����">����</option>
				<option value="����">����</option>
				<option value="���">���</option>
				<option value="����">����</option>
				<option value="���">���</option>
				<option value="�泲">�泲</option>
				<option value="����">����</option>
				<option value="����">����</option>
				<option value="��õ">��õ</option>
				<option value="�뱸">�뱸</option>
				<option value="�λ�">�λ�</option>
				<option value="����">����</option>
				<option value="���">���</option>
				<option value="�泲">�泲</option>
				<option value="����">����</option>
		</select>
	</td>
  </tr>  
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
    <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>�����о�</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;">
		<select class="select" name="w_field" id="w_field">
			<option value="">����</option>
			<option value="�߻�ü">�߻�ü</option>
			<option value="����ü">����ü</option>
			<option value="����Ȱ��">����Ȱ��</option>
			<option value="�������">�������</option>
			<option value="���п���">���п���</option>
			<option value="����Ž��">����Ž��</option>
			<option value="��Ÿ">��Ÿ</option>
		</select>
	</td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>�������</strong></td>
	<td align="left" style="padding-left:5px;"><input name="h_salary" id="h_salary" value="<?=$addinfo2[2]?>" type="text" size="20" class="input"></td>
  </tr> 
   <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
    <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>Ư�����</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><input name="addinfo3" id="addinfo3" value="<?=$addinfo3?>" type="text" size="60" class="input" /></td>
  </tr>
   <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
    <td colspan="4" align="center">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td valign="top" align="left">
			<input type="checkbox" name="ctype" value="H" <?=$ctype_checked?>>HTML���
			<input type="checkbox" name="privacy" value="Y" <?=$privacy_checked?>> ��б�
			<?=$hide_notice_start?>
			<input type="checkbox" name="notice" value="Y" <?=$notice_checked?>> ������
			<?=$hide_notice_end?>
		</td>
		</tr>
		 <tr>
			<td colspan="4" height="4" bgcolor="#a9a9a9"></td>
		  </tr>
		  <tr>
			<td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>�з»���</strong></td>
		  </tr>
		  <tr>
			<td colspan="4" height="2" bgcolor="#a9a9a9"></td>
		  </tr>
		<tr>
		<td align="left" valign="top">
		<input type="hidden" id="educhk" name="educhk" value="1"/>
			<table width="100%" id="edutable" cellspacing="0" cellpadding="0" style="border:1px solid #d7d7d7;">
				<tr height="30" id="addtr">
					<th style="padding-left:10px; border-right:1px solid #d7d7d7;width:28%">���бⰣ</th>
					<th style="padding-left:10px; border-right:1px solid #d7d7d7;">�б���</th>
					<th style="padding-left:10px; border-right:1px solid #d7d7d7;">������</th>
					<th style="padding-left:10px; border-right:1px solid #d7d7d7;">����</th>
					<th style="padding-left:10px; border-right:1px solid #d7d7d7;width:20%;">����</th>
				</tr>
				 <tr>
					<td colspan="5" height="1" bgcolor="#d7d7d7"></td>
	 			  </tr>
				<tr height="30" id="addtr1">
					<td align="left" style="padding-left:5px;border-right:1px solid #d7d7d7;">
						<input name="period1_1" id="period1_1" value="<?=$addinfo4[0]?>" onClick="datepic(this)" readonly type="text" size="10" class="input">
						~
						<input name="period1_2" id="period1_2" value="<?=$addinfo4[1]?>" onClick="datepic(this)" readonly type="text" size="10" class="input">
					</td>
					<td align="left" style="padding-left:5px;border-right:1px solid #d7d7d7;"><input name="s_name1" id="s_name1" value="<?=$addinfo4[2]?>" type="text" size="15" class="input"></td>
					<td align="left" style="padding-left:5px;border-right:1px solid #d7d7d7;"><input name="s_area1" id="s_area1" value="<?=$addinfo4[3]?>" type="text" size="10" class="input"></td>
					<td align="left" style="padding-left:5px;border-right:1px solid #d7d7d7;"><input name="major1" id="major1" value="<?=$addinfo4[4]?>" type="text" size="10" class="input"></td>
					<td align="left" style="padding-left:5px;border-right:1px solid #d7d7d7;">
					<input name="score1_1" id="score1_1" value="<?=$addinfo4[5]?>" type="text" size="5" class="input"> / <input name="score1_2" id="score1_2" value="<?=$addinfo4[6]?>" type="text" size="5" class="input">
					</td>
				</tr>
				  <tr>
					<td colspan="5" height="1" bgcolor="#d7d7d7"></td>
	 			  </tr>
				 <tr>
					<td align="right" colspan="5"><b id="eadd" style="cursor:hand">�з��߰�&nbsp;<img width="12" height="12" src='<?=$skin_dir?>/image/btn_plus.png'/></b>&nbsp;&nbsp;</td>
	 			</tr>
			</table>
		</td>
		</tr>
		 <tr>
			<td colspan="4" height="4" bgcolor="#a9a9a9"></td>
		  </tr>
		  <tr>
			<td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>��»���</strong></td>
		  </tr>
		  <tr>
			<td colspan="4" height="2" bgcolor="#a9a9a9"></td>
		  </tr>
		<tr>
		<td align="left" valign="top">
			<?
			if($bbs_info[editor] == "Y"){
				$edit_name = "content1";
				$edit_content = $content[0];
				include WIZHOME_PATH."/webedit/WIZEditor.html";
			}else{?>
				<textarea name="content1" id="content1" cols="86" rows="13" class="input" style="width:100%;word-break:break-all;"><?=$content[0]?></textarea>
			<?}?>
		</td>
		</tr>
		  <tr>
			<td colspan="4" height="4" bgcolor="#a9a9a9"></td>
		  </tr>
		  <tr>
			<td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>�ڱ�Ұ���</strong></td>
		  </tr>
		  <tr>
			<td colspan="4" height="2" bgcolor="#a9a9a9"></td>
		  </tr>
		<tr>
		<td align="left" valign="top">
			<?
			if($bbs_info[editor] == "Y"){
				$edit_name = "content2";
				$edit_content = $content[1];
				include WIZHOME_PATH."/webedit/WIZEditor.html";
			}else{?>
				<textarea name="content2" id="content2" cols="86" rows="13" class="input" style="width:100%;word-break:break-all;"><?=$content[1]?></textarea>
			<?}?>
			
		</td>
		</tr>
		</table>
    </td>
  </tr>
  <tr>
     <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>

  <?
  for($ii=1;$ii<=5;$ii++){
  	echo ${"hide_upfile".$ii."_start"};
  ?>
  <tr>
    <td align="center"height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>÷������<?=$ii?></strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><input type="file" name="upfile<?=$ii?>" size="20" class="input" /> <?=${"upfile".$ii}?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?
		echo ${"hide_upfile".$ii."_end"};
	}
	?>

  <?
  for($ii=1;$ii<=3;$ii++){
  	echo ${"hide_movie".$ii."_start"};
  	if($ii == 1) $input_type = "file";
  	else $input_type = "text";
  ?>
  <tr>
    <td align="center"height="30" colspan="1" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>������<?=$ii?></strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><input type="<?=$input_type?>" name="movie<?=$ii?>" size="20" class="input" /> <?=${"movie".$ii}?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?
		echo ${"hide_movie".$ii."_end"};
	}
	?>

	<?=$hide_spam_check_start?>
	<tr>
    <td align="center"height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>�ڵ���Ϲ���</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><?=$spam_check?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
	<?=$hide_spam_check_end?>

</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" style="padding-top:10px"><?=$list_btn?></td>
    <td align="right"><?=$confirm_btn?>&nbsp;<?=$cancel_btn?></td>
  </tr>
</table>
</form>
