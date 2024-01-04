<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?
include_once "../../ycommon.php";
// 추가
if($mode == "insert"){

    $showYn = ($show == 'Y') ? '1' : '0';
    $target = ($blank == '1') ? '1' : '0';

    $arr_query = array(
        "type" => $type,
        "title" => $title,
        "contents" => $contents,
        "link" => $link,
        "target" => $target,
        "rank" => $rank,
        "show" => $showYn,
        "alt" => $alt,
    );

//    yprint($arr_query);

    $DB->insert_query('dm_main_banner', $arr_query);
    $last_idx= $DB->insert_id();

    for($q=1;$q<4;$q++) {
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
                @unlink($main_banner_upload_dir."/".$_POST[$temp_img_on_txt]);
                $_POST[$temp_img_on_txt] = "picture_".$last_idx."_".$q.".".get_file_ext($picture_name);
                upload_file($picture, $_POST[$temp_img_on_txt], $main_banner_upload_dir."/");
//                $img_width_t = 350;
//                $img_height_t = 250;
//                scale_image_fill($history_upload_dir."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $history_upload_dir."/", $img_width_t, $img_height_t);
            }
        } else {
            if($_POST[$temp_img_del_txt]) {
                unlink($main_banner_upload_dir."/".$_POST[$temp_img_del_txt]);
                $picture_name='1';
            }
        }

        if($picture_name) {
            $arr_query_img['file'.$q] = $_POST['picture'.$q.'_on'];
        }
    }

    if($arr_query_img) {
        $where_query = "idx = '" . $last_idx . "'";
        $DB->update_query('dm_main_banner', $arr_query_img, $where_query);
    }

    complete("추가되었습니다.","banner_list.php");

// 수정
}else if($mode == "update"){

    $sql = "select * from dm_main_banner where idx = '$idx'";
    $rowData = $DB->fetch_assoc($sql);

    if ((int)$rowData['idx'] === 0) {
        error("잘못된 접근입니다.");
    }

    $last_idx = $idx;

    $showYn = ($show == 'Y') ? '1' : '0';
    $target = ($blank == '1') ? '1' : '0';
    $arr_query = array(
        "type" => $type,
        "title" => $title,
        "contents" => $contents,
        "link" => $link,
        "target" => $target,
        "rank" => $rank,
        "show" => $showYn,
        "alt" => $alt,
    );
    $DB->update_query('dm_main_banner', $arr_query, "idx = '".$idx."'");

    for($q=1;$q<4;$q++) {
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
                @unlink($main_banner_upload_dir."/".$_POST[$temp_img_on_txt]);
                $_POST[$temp_img_on_txt] = "picture_".$last_idx."_".$q.".".get_file_ext($picture_name);
                upload_file($picture, $_POST[$temp_img_on_txt], $main_banner_upload_dir."/");
//                $img_width_t = 350;
//                $img_height_t = 250;
//                scale_image_fill($history_upload_dir."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $history_upload_dir."/", $img_width_t, $img_height_t);
            }
        } else {

            if($_POST[$temp_img_del_txt]) {
                unlink($main_banner_upload_dir."/".$_POST[$temp_img_del_txt]);
                $picture_name='1';
            }
        }

        if($picture_name) {
            $arr_query_img['file'.$q] = $_POST['picture'.$q.'_on'];
        }
    }

    if($arr_query_img) {
        $where_query = "idx = '" . $last_idx . "'";
        $DB->update_query('dm_main_banner', $arr_query_img, $where_query);
    }

    complete("수정되었습니다.","banner_list.php?mode=update&idx=$idx&page=$page");

// 삭제
}else if($mode == "delete"){

    $sql = "select * from dm_main_banner where idx = '$idx'";
    $rowData = $DB->fetch_assoc($sql);

    if ((int)$rowData['idx'] === 0) {
        error("잘못된 접근입니다.");
    }

    //이미지 삭제
    @unlink($main_banner_upload_dir."/".$rowData['file1']);
    @unlink($main_banner_upload_dir."/".$rowData['file2']);
    @unlink($main_banner_upload_dir."/".$rowData['file3']);

    $sql = "delete from dm_main_banner where idx = '$idx'";
    $DB->db_query($sql);

    complete("삭제되었습니다.","banner_list.php");

}