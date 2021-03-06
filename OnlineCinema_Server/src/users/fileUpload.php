<?php
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/user_pic/';
    $uname = $_POST['uname'];

    $target_file_2 = basename( $_FILES["uploadFile"]["name"]);
    echo $target_file ;
    $uploadOk = 1;
    $tmp_file = $_FILES["uploadFile"]["tmp_name"];
    $imageFileType = pathinfo($target_file_2, PATHINFO_EXTENSION);
    $target_file = $target_dir . $uname . "." . $imageFileType;

    $check = getimagesize($tmp_file);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
//    if (file_exists($target_file)) {
//        echo "Sorry, file already exists.";
//        $uploadOk = 0;
//    }

    // Check file size
    if ($_FILES["uploadFile"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
     //Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. This is an ".$imageFileType. ".";
        $uploadOk = 0;
    }

    /*processing target_file*/


    if ($uploadOk == 1 && move_uploaded_file($tmp_file, $target_file)) {

        echo "The file ". basename( $_FILES["uploadFile"]["name"]). " has been uploaded.";

    }
    else {

        echo "Sorry, there was an error uploading your file.";

    }

?>
