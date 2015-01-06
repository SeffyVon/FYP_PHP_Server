<?php
/**
 * Created by PhpStorm.
 * User: feng
 * Date: 05/12/2014
 * Time: 23:55
 */

include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbConnection.php';

$groupname = pg_escape_string($_POST['groupname']);
$uname = pg_escape_string($_POST['uname']);
$message_time = pg_escape_string($_POST['message_time']);
$movie_time = pg_escape_string($_POST['movie_time']);
$message_text = pg_escape_string($_POST['message_text']);

$insert_query = "insert into gmessages select '" . $message_text . "',groupid, userid, time '" . $movie_time . "', timestamp '" . $message_time . "' from groups, users where uname='" . $uname . "' and groupname='" . $groupname . "';";
$insert_result = pg_query($dbconn, $insert_query);
if($insert_result ){
    echo "update success\n";
}else {
    echo "update fail!\n";
}
?>

