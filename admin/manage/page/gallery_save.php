<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?
include_once "../../ycommon.php";
// 추가
if($mode == "insert"){

    $code = 'gallery'.$year;

    $sql = "select count(*) as cnt from dm_gallery where year = '$year'";
    $cnt = $DB->count_query($sql);

    if ($cnt > 0) {
        error("이미등록된 연도: ".$year."가 있습니다.\\n다른연도를 입력해주세요.");
    }

    $showYn = ($show == 'Y') ? '1' : '0';

    $arr_query = array(
        "year" => $year,
        "code" => $code,
        "show" => $showYn,
    );

    $DB->insert_query('dm_gallery', $arr_query);
    $last_idx= $DB->insert_id();

    $sql = "select count(*) as cnt from wiz_bbsinfo where code = '$code'";
    $cnt = $DB->count_query($sql);
    if ($cnt == 0) {
        $title = $year . '년 갤러리';
        $sql = "
        INSERT INTO `wiz_bbsinfo` (`code`, `type`, `title`, `titleimg`, `header`, `footer`, `category`, `bbsadmin`, `lpermi`, `rpermi`, `wpermi`, `apermi`, `cpermi`, `datetype_list`, `datetype_view`, `skin`, `permsg`, `perurl`, `pageurl`, `editor`, `usetype`, `privacy`, `sms`, `upfile`, `movie`, `comment`, `remail`, `imgview`, `recom`, `abuse`, `abtxt`, `simgsize`, `mimgsize`, `rows`, `lists`, `newc`, `hotc`, `line`, `subject_len`, `view_point`, `write_point`, `down_point`, `comment_point`, `recom_point`, `point_msg`, `img_align`, `btn_view`, `spam_check`, `view_list`, `name_type`, `grp`, `prior`)
        VALUES
            ('$code','BBS','$title','','','','','admin','','','0','0','0','%Y-%m-%d','%Y-%m-%d','photoBasic','권한이 없습니다.','','','N','','','',1,0,'N','N','','N','','',120,600,20,5,2,600,4,0,0,0,0,0,0,'','LEFT','N','Y','N','name',0,1);
        ";
        $DB->db_query($sql);
    }

    $sql = "select count(*) as cnt from wiz_bbsmain where code = '$code'";
    $cnt = $DB->count_query($sql);
    if ($cnt == 0) {
        $sql = "
        INSERT INTO `wiz_bbsmain` (`code`, `btype`, `purl`, `cnt`, `line`, `skin`, `subject_len`, `content_len`)
        VALUES
            ('$code','','gallery/gallery.html',5,0,'\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n[LOOP]\n<tr>\n  <td width=\"5\" height=\"20\"><img src=\"/admin/bbsmain/image/point.gif\" width=\"3\" height=\"3\"></td>\n  <td width=\"5\"></td>\n  <td align=\"left\"><a href=\"{LINK}\">{SUBJECT}</a>{NEW}</td>\n  <td align=\"right\">{DATE}</td>\n</tr>\n[/LOOP]\n</table>\n',30,80);
        ";
        $DB->db_query($sql);
    }

    $sql = "select count(*) as cnt from wiz_bbscat where code = '$code'";
    $cnt = $DB->count_query($sql);
    if ($cnt == 0) {
        $sql = "
        INSERT INTO `wiz_bbscat` (`gubun`, `code`, `catname`, `catimg`, `catimg_over`, `caticon`, `prior`)
        VALUES
            ('A','$code','전체','','','',1);
        ";
        $DB->db_query($sql);
    }

    complete("추가되었습니다.","gallery_list.php");

// 수정
}else if($mode == "update"){

    $sql = "select * from dm_gallery where idx = '$idx'";
    $rowData = $DB->fetch_assoc($sql);

    if ((int)$rowData['idx'] === 0) {
        error("잘못된 접근입니다.");
    }
    $showYn = ($show == 'Y') ? '1' : '0';
    $arr_query = array(
        "show" => $showYn,
    );
    $DB->update_query('dm_gallery', $arr_query, "idx = '".$idx."'");

    complete("수정되었습니다.","gallery_list.php?mode=update&idx=$idx&page=$page");

// 삭제
}else if($mode == "delete"){

    $sql = "select * from dm_gallery where idx = '$idx'";
    $rowData = $DB->fetch_assoc($sql);

    if ((int)$rowData['idx'] === 0) {
        error("잘못된 접근입니다.");
    }

    $code = $rowData['code'];

    $sql = "delete from wiz_bbsinfo where code = '$code'";
    mysql_query($sql) or error(mysql_error());

    $sql = "delete from wiz_bbsmain where code = '$code'";
    mysql_query($sql) or error(mysql_error());

    $sql = "delete from wiz_bbscat where code = '$code'";
    mysql_query($sql) or error(mysql_error());

    $sql = "delete from wiz_bbs where code = '$code'";
    mysql_query($sql) or error(mysql_error());

    // 첨부파일, 카테고리 디렉토리 삭제
    rm_dir("../../data/bbs/".$code); rm_dir("../../data/category/".$code);

    $sql = "delete from dm_gallery where idx = '$idx'";
    $DB->db_query($sql);

    complete("삭제되었습니다.","gallery_list.php");

}

?>
