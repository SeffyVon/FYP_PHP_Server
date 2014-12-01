<?php

    include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbConnection.php';

    $uname = pg_escape_string($_POST['uname']);

    $result = pg_query($dbconn, "SELECT groupname, moviename, u2.uname, starttime, endtime, brief FROM groups, ingroup, users u1, movies, users u2 WHERE movies.movieid = groups.movieid AND groups.groupid=ingroup.groupid AND movies.ownerid = u2.userid AND ingroup.userid = u1.userid AND u1.uname = '" . $uname . "';");

    if(!$result){
        echo "0";
    }
    else{
        while ($row = pg_fetch_row($result)) {

            echo json_encode(
                array ( "groupname"=> $row[0],
                        "moviename"=> $row[1],
                        "owner"    => $row[2],
                        "starttime"=> $row[3],
                        "endtime"  => $row[4],
                        "brief" => $row[5],)
            );
        }
    }

/**
 * Created by PhpStorm.
 * User: feng
 * Date: 27/10/2014
 * Time: 13:50
 */

?>