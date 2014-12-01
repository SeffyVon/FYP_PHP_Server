<?php

    include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbConnection.php';

    $uname = pg_escape_string($_POST['uname']);

    $result = pg_query($dbconn, "SELECT groupname, moviename FROM groups, ingroup, users, movies WHERE movies.movieid = groups.movieid AND groups.groupid=ingroup.groupid AND ingroup.userid = users.userid AND users.uname = '" . $uname . "';");

    if(!$result){
        echo "0";
    }
    else{
        while ($row = pg_fetch_row($result)) {
            echo "group name: $row[0]\nmovie name: $row[1]\n";
        }
    }

/**
 * Created by PhpStorm.
 * User: feng
 * Date: 27/10/2014
 * Time: 13:50
 */

?>