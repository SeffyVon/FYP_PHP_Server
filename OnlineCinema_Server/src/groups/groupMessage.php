<?php
/**
 * Created by PhpStorm.
 * User: feng
 * Date: 05/12/2014
 * Time: 14:03
 */

class GMessage{
    public $message_text;
    public $groupname;
    public $uname;
    public $movie_time;
    public $message_time;


    public function __construct($message_text, $groupname, $uname, $movie_time, $message_time)
    {
        $this->message_text = $message_text;
        $this->groupname = trim($groupname);
        $this->uname = trim($uname);
        $this->movie_time = $movie_time;
        $this->message_time = $message_time;
    }
}


include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbConnection.php';

$gmessage = array();

$groupname = pg_escape_string($_POST['groupname']);
$lasttime = $_POST['lasttime'];

$result = pg_query($dbconn, "SELECT message_text, groupname, uname, movie_time, message_time FROM gmessages,groups,users WHERE message_userid = userid AND message_groupid = groupid AND groupname='" . $groupname . "' AND message_time > TIMESTAMP '" . $lasttime . "' ORDER BY message_time;"  );
if(!$result){
    echo json_encode($gmessage);
}
else{
    while ($row = pg_fetch_row($result)) {

        array_push( $gmessage, new GMessage($row[0], $row[1], $row[2], $row[3], $row[4]) );
    }
    echo json_encode($gmessage);
}


?>
