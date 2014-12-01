<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbConnection.php';

    $uname = $_POST["uname"];
    $hashOfPw = $_POST["hashOfPw"];

    $target_dir = '/user_pic/';
    //$target_dir = $target_dir . basename( $_FILES["uploadFile"]["name"]);
    echo $target_dir;
    $uploadOk = 1;

    $tmpName = $_FILES["uploadFile"]["tmp_name"];

    $fp      = fopen($tmpName, 'r');
    $content = fread($fp, filesize($tmpName));
    $content = addslashes($content);
    fclose($fp);

    $result = pg_query($dbconn, "SELECT userid FROM users WHERE uname= '" . pg_escape_string($uname) . "'");
    if(!$result){
        $insert_array = array(
            'userid' => 4,
            'uname' => pg_escape_string($uname),
            'hashofpw' => pg_escape_string($hashOfPw),
            'pic' => $content,
        );
        $insert_result = pg_insert($dbconn,'users', $insert_array);
        if($insert_result){
            echo "registration succeed!\n";
        }else{
            echo "registration fail!\n";
        }
    }


?>