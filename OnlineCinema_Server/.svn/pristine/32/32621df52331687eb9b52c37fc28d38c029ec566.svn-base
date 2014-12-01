<?php
/**
 * Created by PhpStorm.
 * User: feng
 * Date: 28/10/2014
 * Time: 14:38
 */

    include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbConnection.php';
    $uname = $_POST["uname"];
    $tmp = '/Users/postgres/' . $uname;
    //echo $tmp;
    //$uname = pg_escape_string($_POST["uname"]);

    $pic_query = "SELECT lo_export(user_img.img,'$tmp') FROM user_img,users WHERE user_img.userid = users.userid AND users.uname = '$uname';";
    $pic_result = pg_query($pic_query);

    // the pic should be saved to $tmp;
    //echo "<IMG SRC=http://127.0.0.1:63342/OnlineCinema_Server/src/users/showUserPic.php>";
    header("Content-Type: image/jpg");
    readfile($tmp);

/* http://www.sumedh.info/articles/store-upload-image-postgres-php.html*/

?>

