<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 8/11/2016
 * Time: 10:20 AM
 */?>
<?php
//Hàm tương tự array_column nhưng key có kiểu string
function a_column($array, $col, $key){
    $kq = array();
    foreach($array as $chitiet){
        $k = (string)$chitiet[$key];
        $kq[$k] = $chitiet[$col];
    }
    $keys = array_keys($kq);
    $values = array_values($kq);
    $stringKeys = array_map('strval', $keys);
    //dd($stringKeys);
    $kq = array_combine($stringKeys, $values);
    //dd(array_combine($values, $values));
    return $kq;
}

//Hàm tạo mảng mới bằng cách lấy 1 số cột trong mảng cũ
function a_split($array,$field){
    $kq = array();
    foreach ($array as $ar) {
        $holding = array();
        foreach ($ar as $k => $v) {
            if (in_array($k, $field)) {
                $holding[$k] = $v;
            }
        }
        $kq[] = $holding;
    }
    return $kq;
}

//Hàm tạo mảng mới bằng cách gộp những giá trị trùng nhau trong mảng cũ lại
function a_unique($array){
    //return array_unique($array,SORT_REGULAR);
    //return array_map('unserialize', array_unique(array_map('serialize', $array)));
    $tmp = array ();
    foreach ($array as $row)
        if(!in_array($row,$tmp)){
            array_push($tmp,$row);
        }
    return $tmp;
}

/*
 * Hàm tạo mảng mới bằng cách gộp 2 mảng vào với nhau
 * Ko dùng array_merge() do mảng có key là dạng số (ví dụ: 9099824) sẽ tự chuyển về số nên khi gộp với mảng string sẽ lỗi
*/

function a_merge($array1, $array2){
    foreach ($array2 as $key=>$val){
        $array1[$key] = $val;
    }
    return $array1;
}

//Hàm tạo mảng mới bằng cách lấy ra những dòng thỏa mãn điều kiện trong mảng cũ
//điều kiện tìm kiềm: contain
//$justvals = chỉ lấy phần tử đầu tiên tìm đc
function a_getelement($array, $indexs, $justvals = false){
    $newarray = array();
    if(is_array($array) && count($array)>0){
        if(is_array($indexs) && count($indexs)>0) {
            //Tổng số điều kiện
            $ninds = count($indexs);
        }
        else return $newarray;

        foreach(array_keys($array) as $key){
            //số phần tử thỏa mãn điều kiện
            $count = 0;
            foreach($indexs as $indx => $val){
                if($array[$key][$indx] == $val || strpos(strtolower($array[$key][$indx]), strtolower($val))!==FALSE){
                    $count++;
                }
            }

            if($count == $ninds){
                if($justvals) return $array[$key];
                else $newarray[$key] = $array[$key];
            }
        }
    }
    return $newarray;
}

function unset_key ($data, $array_key){
    $a_kq = array();
    foreach($data as $dt){
        foreach($array_key as $value){
            if(array_key_exists($value,$dt)){
                unset($dt[$value]);
            }
        }
        $a_kq[]=$dt;
    }

    return $a_kq;
}

//Hàm tạo mảng mới bằng cách lấy ra những dòng thỏa mãn điều kiện trong mảng cũ
//điều kiện tìm kiếm: ==
function a_getelement_equal($array, $indexs, $justvals = false){
    $newarray = array();
    if(is_array($array) && count($array)>0){
        if(is_array($indexs) && count($indexs)>0) {
            //Tổng số điều kiện
            $ninds = count($indexs);
        }
        else return $newarray;

        foreach(array_keys($array) as $key){
            //số phần tử thỏa mãn điều kiện
            $count = 0;
            foreach($indexs as $indx => $val){
                if($array[$key][$indx] == $val){
                    $count++;
                }
            }

            if($count == $ninds){
                if($justvals) return $array[$key];
                else $newarray[$key] = $array[$key];
            }
        }
    }
    return $newarray;
}
?>