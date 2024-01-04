<?php

if(!function_exists("sql_quote")) {
    function sql_quote($strSql) {
        $return = "'".str_replace("'", "\'", stripslashes($strSql))."'";

        return $return;
    }
}

if(!function_exists("set_sql_quote")) {
    function set_sql_quote(&$val, $key)
    {
        if (is_null($val)) {
        } else {
            $val = trim($val);
        }

        if (strtolower($val) == "now()" || strtolower(substr($val, 0, 13)) == "from_unixtime" || strtolower(substr($val, 0, 8)) == "date_add" || $key == "num_file") {
            $val = $val;
        } else if (is_null($val)) {
            $val = 'null';
        } else {
            $val = sql_quote($val);
        }
    }
}

//if (! function_exists("array_key_last")) {
//    function array_key_last($array) {
//        if (!is_array($array) || empty($array)) {
//            return NULL;
//        }
//
//        return array_keys($array)[count($array)-1];
//    }
//}

/**
 * db object
 */
class DB {

    var $connect = '';
    function __construct($connect) {

//        var_dump($connect);
        $this->connect = $connect;
    }

    function db_query($query,$debug=0) {
        if($debug=="1") {
            echo $query."<br/>";
            exit;
        }
        $result = mysql_query($query);

        if(!$result){
            echo $query."<br/>".mysql_error();
            exit;
        }

//        $result = mysql_query($query) or error(mysql_error());

        return $result;
    }

    function insert_id() {
        $id = mysql_insert_id($this->connect);

        return $id;
    }

    function fetch_query($query,$debug=0) {
        if($debug=="1") {
            echo $query."<br/>";
            exit;
        }
        $return = mysql_fetch_array($this->db_query($query));

        return $return;
    }

    function fetch_assoc($query,$debug=0) {
        if($debug=="1") {
            echo $query."<br/>";
            exit;
        }
        $return = mysql_fetch_assoc($this->db_query($query));

        return $return;
    }

    function count_query($query,$debug=0) {
        $query_ex = explode("from", $query);
        $query = "select count(*) as cnt from ".$query_ex[1];
        if($debug=="1") {
            echo $query."<br/>";
            exit;
        }
        $data = $this->fetch_query($query);
        return $data[cnt];
    }

    function select_rows($query,$debug=0) {
        if($debug=="1") {
            echo $query."<br/>";
            exit;
        }
        $cnt = mysql_num_rows($this->db_query($query));

        return $cnt;
    }

    function select_rows2($result) {
        return mysql_num_rows($result);
    }

    function select_query($query,$debug=0) {
        if($debug=="1") {
            echo $query."<br/>";
            exit;
        }
        $result = $this->db_query($query);
        while ($data = mysql_fetch_array($result)) $return[] = $data;

        return $return;
    }

    function select_query_row($query,$debug=0) {
        if($debug=="1") {
            echo $query."<br/>";
            exit;
        }
        $result = $this->db_query($query);
        while ($data = mysql_fetch_row($result)) $return[] = $data;

        return $return;
    }

    function select_assoc_query($query,$debug=0) {
        if($debug=="1") {
            echo $query."<br/>";
            exit;
        }
        $result = $this->db_query($query);
        while ($data = mysql_fetch_assoc($result)) $return[] = $data;

        return $return;
    }

    function select_assoc_query2($query,$debug=0) {
        if($debug=="1") {
            echo $query."<br/>";
            exit;
        }
        $result = $this->db_query($query);
        $returnData = array();
        $return = array();

        while ($data = mysql_fetch_assoc($result)) $return[] = $data;

        $total = mysql_num_rows($result);
        $returnData = array(
            'data' => $return,
            'total' => $total,
        );

        return $returnData;
    }

    function insert_query($table, $arr, $debug=0) {
        array_walk($arr, "set_sql_quote");

        $query = "insert into `".$table."` (`".implode("`,`", array_keys($arr))."`) value (".implode(",", array_values($arr)).")";
        if($debug=="1") {
            echo $query."<br/>";
            exit;
        }
        $result = $this->db_query($query);

        return $result;
    }

//    function insert_query2($table, $arr, $up_arr=[], $is_ignore=false, $debug=0) {
//        array_walk($arr, "set_sql_quote");
//        array_walk($up_arr, "set_sql_quote");
//
//        $ignore = "";
//        if ($is_ignore) $ignore = "ignore";
//        $query = "insert ".$ignore." into ".$table." (".implode(",", array_keys($arr)).") value (".implode(",", array_values($arr)).")";
//        if (count($up_arr) > 0 && !$is_ignore) {
//            $query .= " on duplicate key update ";
//            foreach ($up_arr as $k => $l) {
//                $end = ",";
//                if (array_key_last($up_arr) === $k) $end = ";";
//                $query .= $k . "=" . $l . $end;
//            }
//        }
//
//        if($debug=="1") {
//            echo $query."<br/>";
//            exit;
//        }
////            vardump($query);
//        $result = $this->db_query($query);
//
//        return $result;
//    }

    function update_query($table, $arr, $where_query, $debug=0) {
        array_walk($arr, "set_sql_quote");
        $arr_val = array();
        foreach($arr as $key => $val) {
            $arr_val[] = "`".$key."` = ".$val;
        }
        $query = "update `".$table."` set ".implode(', ', $arr_val)." where ".$where_query;
        if($debug=="1") {
            echo $query."<br/>";
            exit;
        }
        //echo "<script>alert('".$val."');</script>";
        $result = $this->db_query($query);
        return $result;
    }

    function del_query($table,$query,$debug=0) {
        $query = "delete from `".$table."` where ".$query;
        //echo $query;
        if($debug=="1") {
            echo $query."<br/>";
            exit;
        }
        $result = $this->db_query($query);

        return $result;
    }

    function close($connect=0) {
        if(!$this->free()) {
            return false;
        }

        if(!$connect) {
            $connect = $this->connect;
        }

        if($connect) {
            if(!@mysql_close($connect)) {
                return false;
            }
        }

        $this->remove();

        return true;
    }

    function free($result=0) {
        if($result) {
            @mysql_free_result($result);
        }

        return true;
    }

    function remove() {
        unset($this->connect);
    }
}

$DB = new DB($connect);

/**
 * config
 */
$dm_upload_dir = $_SERVER['DOCUMENT_ROOT']."/admin/data";
$dm_img_dir = "/admin/data";
$history_upload_dir = $dm_upload_dir . "/history";
$history_img_dir = $dm_img_dir . "/history";
$company_logo_upload_dir = $dm_upload_dir . "/company_logo";
$company_logo_img_dir = $dm_img_dir . "/company_logo";
$main_banner_upload_dir = $dm_upload_dir . "/main_banner";
$main_banner_img_dir = $dm_img_dir . "/main_banner";

$mem_com_type = array(
    '1' => '일반회원사',
    '2' => '임원사',
    '3' => '부회장사',
    '4' => '회장사',
);

$main_banner_type = array(
    '1' => '큰배너1',
    '2' => '큰배너2',
    '3' => '큰배너1 오른쪽 작은배너1',
    '4' => '큰배너1 오른쪽 작은배너2',
    '5' => '큰배너2 오른쪽 중간배너',
    '6' => '롤링배너',
);

function yprint($str) {
    echo "<pre>";
    var_dump($str);
    echo "</pre>";
}
function yprint2($str) {
    echo "<pre>";
    print_r($str);
    echo "</pre>";
}

function get_file_ext($filename) {
    if($filename == "") return "";
    $type = explode(".", $filename);
    $ext = strtolower($type[count($type)-1]);

    return $ext;
}

function upload_file($srcfile, $destfile, $dir) {
    if($destfile == "") return false;
    move_uploaded_file($srcfile, $dir.$destfile);
    chmod($dir.$destfile, 0666);

    return true;
}

function scale_image_fill($src_image, $save_filename, $save_path, $max_width, $max_height) {
    $img_info = getimagesize($src_image);

    if($img_info[2] == 1) {
        $src = ImageCreateFromGif($src_image);
    } else if($img_info[2] == 2) {
        $src = ImageCreateFromJPEG($src_image);
    } else if($img_info[2] == 3) {
        $src = ImageCreateFromPNG($src_image);
    } else {
        return 0;
    }

    $dst = imagecreatetruecolor($max_width, $max_height);
    imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));

    $src_width = imagesx($src);
    $src_height = imagesy($src);

    $dst_width = imagesx($dst);
    $dst_height = imagesy($dst);

    $new_width = $dst_width;
    $new_height = round($new_width*($src_height/$src_width));
    $new_x = 0;
    $new_y = round(($dst_height-$new_height)/2);

    $next = $new_height < $dst_height;

    if($next) {
        $new_height = $dst_height;
        $new_width = round($new_height*($src_width/$src_height));
        $new_x = round(($dst_width - $new_width)/2);
        $new_y = 0;
    }

    imagecopyresampled($dst, $src , $new_x, $new_y, 0, 0, $new_width, $new_height, $src_width, $src_height);

    if($img_info[2] == 1) {
        ImageInterlace($dst);
        ImageGif($dst, $save_path.$save_filename);
    } else if($img_info[2] == 2) {
        ImageInterlace($dst);
        ImageJPEG($dst, $save_path.$save_filename);
    } else if($img_info[2] == 3) {
        ImagePNG($dst, $save_path.$save_filename);
    }

    @ImageDestroy($dst);
    @ImageDestroy($src);
}

//디비 조회 한행 반환
function get_row($select='*', $table='', $where="", $order="", $extra="", $debug=false) {
    global $DB;
    $q="select ".$select." from ".$table." ";
    if (is_array($where) && count($where) > 0) {
        $q .= ' where ';
        $qw = '';
        foreach ($where as $k => $l) {
            if ($qw != '') $qw .= " and ";
            $qw .= " ".$k." = '".$l."'";
        }
        $q .= $qw;
    } else if ($where != "") {
        $q .= ' where '.$where;
    }

    if ($order != "") {
        $q .= " ".$order;
    }

    if ($extra != "") {
        $q .= " ".$extra;
    }

    if ($debug) var_dump($q);
    return $DB->fetch_assoc($q);
}

//디비 조회 여러행 반환
function get_rows($select='*', $table='', $where="", $order="", $extra="", $debug=false) {
    global $DB;
    $q="select ".$select." from ".$table." ";
    if (is_array($where) && count($where) > 0) {
        $q .= ' where ';
        $qw = '';
        foreach ($where as $k => $l) {
            if ($qw != '') $qw .= " and ";
            $qw .= " ".$k." = '".$l."'";
        }
        $q .= $qw;
    } else if ($where != "") {
        $q .= ' where '.$where;
    }

    if ($order != "") {
        $q .= " ".$order;
    }

    if ($extra != "") {
        $q .= " ".$extra;
    }

    if ($debug) vardump($q);
    return $DB->select_assoc_query($q);
}

