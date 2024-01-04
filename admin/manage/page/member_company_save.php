<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?
include_once "../../ycommon.php";
// 추가
if($mode == "insert"){

    $showYn = ($show == 'Y') ? '1' : '0';

    $arr_query = array(
        "type" => $type,
        "com_name" => $com_name,
        "boss_name" => $boss_name,
        "adress" => $adress,
        "head_adress" => $head_adress,
        "company_type" => $company_type,
        "year" => $year,
        "take" => $take,
        "space_take" => $space_take,
        "employer" => $employer,
        "rnd_scale" => $rnd_scale,
        "capital" => $capital,
        "contact" => $contact,
        "homepage" => $homepage,
        "vision" => $vision,
        "business" => $business,
        "major_customer" => $major_customer,
        "products" => $products,
        "product_advantages" => $product_advantages,
        "projects" => $projects,
        "show" => $showYn,
        "order" => $order,
        "member_type" => $member_type,
        "responsible" => $responsible,
        "participation" => $participation,
        "homepage2" => $homepage2,
        "industry" => $industry,
    );

//    yprint($arr_query);

    $DB->insert_query('dm_member_company', $arr_query);
    $last_idx= $DB->insert_id();

    for($q=1;$q<=2;$q++) {
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
                @unlink($company_logo_upload_dir."/".$_POST[$temp_img_on_txt]);
                $_POST[$temp_img_on_txt] = "picture_".$last_idx."_".$q.".".get_file_ext($picture_name);
                upload_file($picture, $_POST[$temp_img_on_txt], $company_logo_upload_dir."/");
//                $img_width_t = 350;
//                $img_height_t = 250;
//                scale_image_fill($history_upload_dir."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $history_upload_dir."/", $img_width_t, $img_height_t);
            }
        } else {
            if($_POST[$temp_img_del_txt]) {
                unlink($company_logo_upload_dir."/".$_POST[$temp_img_del_txt]);
                $picture_name='1';
            }
        }

        if($picture_name) {
            $arr_query_img['logo_path'.$q] = $_POST['picture'.$q.'_on'];
        }
    }

    if($arr_query_img) {
        $where_query = "idx = '" . $last_idx . "'";
        $DB->update_query('dm_member_company', $arr_query_img, $where_query);
    }

    complete("추가되었습니다.","member_company_list.php");

// 수정
}else if($mode == "update"){

    $sql = "select * from dm_member_company where idx = '$idx'";
    $rowData = $DB->fetch_assoc($sql);

    if ((int)$rowData['idx'] === 0) {
        error("잘못된 접근입니다.");
    }

    $last_idx = $idx;

    $showYn = ($show == 'Y') ? '1' : '0';
    $arr_query = array(
        "type" => $type,
        "com_name" => $com_name,
        "boss_name" => $boss_name,
        "adress" => $adress,
        "head_adress" => $head_adress,
        "company_type" => $company_type,
        "year" => $year,
        "take" => $take,
        "space_take" => $space_take,
        "employer" => $employer,
        "rnd_scale" => $rnd_scale,
        "capital" => $capital,
        "contact" => $contact,
        "homepage" => $homepage,
        "vision" => $vision,
        "business" => $business,
        "major_customer" => $major_customer,
        "products" => $products,
        "product_advantages" => $product_advantages,
        "projects" => $projects,
        "show" => $showYn,
        "order" => $order,
        "member_type" => $member_type,
        "responsible" => $responsible,
        "participation" => $participation,
        "homepage2" => $homepage2,
        "industry" => $industry,
    );

    $DB->update_query('dm_member_company', $arr_query, "idx = '".$idx."'");

    for($q=1;$q<=2;$q++) {
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
                @unlink($company_logo_upload_dir."/".$_POST[$temp_img_on_txt]);
                $_POST[$temp_img_on_txt] = "picture_".$last_idx."_".$q.".".get_file_ext($picture_name);
                upload_file($picture, $_POST[$temp_img_on_txt], $company_logo_upload_dir."/");
//                $img_width_t = 350;
//                $img_height_t = 250;
//                scale_image_fill($history_upload_dir."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $history_upload_dir."/", $img_width_t, $img_height_t);
            }
        } else {
            if($_POST[$temp_img_del_txt]) {
                unlink($company_logo_upload_dir."/".$_POST[$temp_img_del_txt]);
                $picture_name='1';
            }
        }

        if($picture_name) {
            $arr_query_img['logo_path'.$q] = $_POST['picture'.$q.'_on'];
        }
    }

    if($arr_query_img) {
        $where_query = "idx = '" . $last_idx . "'";
        $DB->update_query('dm_member_company', $arr_query_img, $where_query);
    }

    complete("수정되었습니다.","member_company_list.php?mode=update&idx=$idx&page=$page");

// 삭제
}else if($mode == "delete"){

    $sql = "select * from dm_member_company where idx = '$idx'";
    $rowData = $DB->fetch_assoc($sql);

    if ((int)$rowData['idx'] === 0) {
        error("잘못된 접근입니다.");
    }

//    yprint($rowData);

    //이미지 삭제
    @unlink($company_logo_upload_dir."/".$rowData['logo_path1']);

    $sql = "delete from dm_member_company where idx = '$idx'";
    $DB->db_query($sql);

    complete("삭제되었습니다.","member_company_list.php");

}