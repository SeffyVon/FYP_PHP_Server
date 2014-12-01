<?php
    $target_dir = '/user_pic/';
    //$target_dir = $target_dir . basename( $_FILES["uploadFile"]["name"]);
    echo $target_dir;
    $uploadOk = 1;

    $tmpName = $_FILES["uploadFile"]["tmp_name"];

    $fp      = fopen($tmpName, 'r');
    $content = fread($fp, filesize($tmpName));
    $content = addslashes($content);
    fclose($fp);

/*
    if (file_exists($target_dir . $_FILES["uploadFile"]["name"])) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if (file_exists($target_dir . $_FILES["uploadFile"]["name"])) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if (!($uploadFile_type == "image/jpg")) {
        echo $uploadFile_type;
        echo "Sorry, only jpg files are allowed.";
        $uploadOk = 0;
    }*/
?>