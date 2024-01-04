<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?
include_once "../../ycommon.php";
// 추가
if($mode == "insert"){

    $sql = "select count(*) as cnt from dm_history where year = '$year'";
    $cnt = $DB->count_query($sql);

    if ($cnt > 0) {
        error("이미등록된 연도: ".$year."가 있습니다.\\n다른연도를 입력해주세요.");
    }
    $showYn = ($show == 'Y') ? '1' : '0';

    $arr_query = array(
        "year" => $year,
        "show" => $showYn,
    );

    $DB->insert_query('dm_history', $arr_query);
    $last_idx= $DB->insert_id();

    if (is_array($date) && count($date) > 0) {
        foreach ($date as $k => $d) {
            if ($d === '') continue;
            $dText = (isset($text[$k])) ? $text[$k] : '';
            $d = $year.str_replace(substr($d, 0, 4), '', $d);
            $DB->insert_query('dm_history_txt', array(
                "date" => $d,
                "text" => $dText,
                "order" => (isset($order[$k])) ? (int)$order[$k] : 0,
            ));
        }
    }

    for($q=1;$q<2;$q++) {
        $temp_img_txt = "picture".$q;
        $temp_img_on_txt = "picture".$q."_on";
        $temp_img_temp_on_txt = "picture".$q."_temp_on";
        $temp_img_del_txt = "picture".$q."_del";
        $picture_name = '';

        if($_FILES[$temp_img_txt]['name']) {
            $picture = $_FILES[$temp_img_txt]['tmp_name'];
            $picture_name = $_FILES[$temp_img_txt]['name'];
            $picture_size = $_FILES[$temp_img_txt]['size'];
            $picture_type = $_FILES[$temp_img_txt]['type'];

            if($picture_name!="") {
                @unlink($history_upload_dir."/".$_POST[$temp_img_on_txt]);
                $_POST[$temp_img_on_txt] = "picture_".$last_idx."_".$q.".".get_file_ext($picture_name);
                upload_file($picture, $_POST[$temp_img_on_txt], $history_upload_dir."/");
//                $img_width_t = 350;
//                $img_height_t = 250;
//                scale_image_fill($history_upload_dir."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $history_upload_dir."/", $img_width_t, $img_height_t);
            }
        } else {
            if($_POST[$temp_img_del_txt]) {
                unlink($history_upload_dir."/".$_POST[$temp_img_del_txt]);
                $picture_name='1';
            }
        }

        if($picture_name) {
            $arr_query_img['picture'.$q] = $_POST['picture'.$q.'_on'];
        }
    }

    if($arr_query_img) {
        $where_query = "idx = '" . $last_idx . "'";
        $DB->update_query('dm_history', $arr_query_img, $where_query);
    }

    complete("추가되었습니다.","history_list.php");

// 수정
}else if($mode == "update"){

    $sql = "select * from dm_history where year = '$year'";
    $rowData = $DB->fetch_assoc($sql);

    if ((int)$rowData['idx'] === 0) {
        error("잘못된 접근입니다.");
    }
    $showYn = ($show == 'Y') ? '1' : '0';
    $arr_query = array(
        "show" => $showYn,
    );
    $DB->update_query('dm_history', $arr_query, "idx = '".$idx."'");

    $last_idx = $idx;

    $sql="select * from dm_history_txt where left(date, 4) = '".$rowData['year']."' order by date asc";
    $old_txt = $DB->select_assoc_query($sql);

    $DB->del_query('dm_history_txt',"left(date, 4) = '".$rowData['year']."'");
    if (is_array($date) && count($date) > 0) {
        foreach ($date as $k => $d) {
            if ($d === '') continue;
            $dText = (isset($text[$k])) ? $text[$k] : '';
            $d = $year.str_replace(substr($d, 0, 4), '', $d);
            $DB->insert_query('dm_history_txt', array(
                "date" => $d,
                "text" => $dText,
                "order" => (isset($order[$k])) ? (int)$order[$k] : 0,
            ));
        }
    }

    for($q=1;$q<2;$q++) {
        $temp_img_txt = "picture".$q;
        $temp_img_on_txt = "picture".$q."_on";
        $temp_img_temp_on_txt = "picture".$q."_temp_on";
        $temp_img_del_txt = "picture".$q."_del";
        $picture_name = '';

        if($_FILES[$temp_img_txt]['name']) {
            $picture = $_FILES[$temp_img_txt]['tmp_name'];
            $picture_name = $_FILES[$temp_img_txt]['name'];
            $picture_size = $_FILES[$temp_img_txt]['size'];
            $picture_type = $_FILES[$temp_img_txt]['type'];

            if($picture_name!="") {
                @unlink($history_upload_dir."/".$_POST[$temp_img_on_txt]);
                $_POST[$temp_img_on_txt] = "picture_".$last_idx."_".$q.".".get_file_ext($picture_name);
                upload_file($picture, $_POST[$temp_img_on_txt], $history_upload_dir."/");
//                $img_width_t = 350;
//                $img_height_t = 250;
//                scale_image_fill($history_upload_dir."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $history_upload_dir."/", $img_width_t, $img_height_t);
            }
        } else {
            if($_POST[$temp_img_del_txt]) {
                unlink($history_upload_dir."/".$_POST[$temp_img_del_txt]);
                $picture_name='1';
            }
        }

        if($picture_name) {
            $arr_query_img['picture'.$q] = $_POST['picture'.$q.'_on'];
        }
    }

    if($arr_query_img) {
        $where_query = "idx = '" . $last_idx . "'";
        $DB->update_query('dm_history', $arr_query_img, $where_query);
    }

    complete("수정되었습니다.","history_list.php?mode=update&idx=$idx&page=$page");

// 삭제
}else if($mode == "delete"){

    $sql = "select * from dm_history where idx = '$idx'";
    $rowData = $DB->fetch_assoc($sql);

    if ((int)$rowData['idx'] === 0) {
        error("잘못된 접근입니다.");
    }

    //이미지 삭제
    @unlink($history_upload_dir."/".$rowData['picture1']);


    $sql = "delete from dm_history where idx = '$idx'";
    $DB->db_query($sql);

    $sql = "delete from dm_history_txt where left(date, 4) = '" . $rowData['year'] . "'";
    $DB->db_query($sql);

    complete("삭제되었습니다.","history_list.php");

}

?>
