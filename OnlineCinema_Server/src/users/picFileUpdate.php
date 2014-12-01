<?php
/**
 * Created by PhpStorm.
 * User: feng
 * Date: 18/11/2014
 * Time: 10:24
     */
    $uname = $_POST["uname"];
    $target_file = $_SERVER['DOCUMENT_ROOT'] . '/user_pic/' . $uname;
    if (file_exists($target_file . '.jpg')) {
        $file = $target_file . '.jpg';
    }
    else if( file_exists($target_file . '.jpeg') ){
        $file = $target_file . '.jpeg';
    }
    else if( file_exists($target_file . '.png') ){
        $file = $target_file . '.png';
    }

    include "userLogin.php";

    if($output == "OK" ) {

        $pic_query = "insert into user_img values (". $row[0] . ", lo_import('$file'));";
        $pic_result = pg_query($dbconn, $pic_query);

        if ($pic_result) {
            echo "pic succeed!\n";
        } else {
            echo "pic fail!\n";
        }
    }

?>