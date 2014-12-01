<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbConnection.php';

    $uname = $_POST["uname"];
    $hashOfPw = $_POST["hashOfPw"];

    $result = pg_query($dbconn, "SELECT userid FROM users WHERE uname= '" . pg_escape_string($uname) . "'");
    if(!pg_fetch_row($result)){
        $insert_array = array(
            'userid' => 6,
            'uname' => pg_escape_string($uname),
            'hashofpw' => pg_escape_string($hashOfPw),
        );
        $insert_result = pg_insert($dbconn,'users', $insert_array);
        $file = $_SERVER['DOCUMENT_ROOT'] . '/user_pic/scaled.jpg';
       /* $insert_pic = array(
            'userid' => 4,
            'img' => pg_lo_import('$file'),
        );
        $insert_pic_result = pg_insert($dbconn,'user_img', $insert_pic);*/

        $pic_query = "insert into user_img values (6, lo_import('$file'));";
        $pic_result = pg_query($dbconn, $pic_query);

        if($insert_result ){
            echo "registration succeed!\n";
        }else{
            echo "registration fail!\n";
        }
        if($pic_result){
            echo "pic succeed!\n";
        }else{
            echo "pic fail!\n";
        }
    }
    else
        echo "username". $uname . " is already in use";
?>