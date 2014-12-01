<?php
/**
 * Created by PhpStorm.
 * User: feng
 * Date: 27/10/2014
 * Time: 13:51
 */
class Movie{
    public $movieName = "";
    public $owner = "";
    public $startTime = "";
    public $endTime = "";
    public $brief = "";

    public function __construct($movieName,$owner,$startTime, $endTime, $brief)
    {
        $this->movieName = $movieName;
        $this->owner=$owner;
        $this->startTime=$startTime;
        $this->endTime=$endTime;
        $this->brief=$brief;
    }


}

class Group {
    public $groupName = "";
    public $movie;
    public $User = array();

    public function __construct($groupName)
    {
        $this->groupName = $groupName;
    }

    public function addUser($newUser){
        array_push($this->User, $newUser);
    }

    public function setMovie($newMovie){
        $this->movie = $newMovie;
    }
}

class User {
    public $userid = 0;
    public $uname = "";
    public $pic = "";
    public $ipAddr = "";

    public function __construct($uid, $uname)
    {
        $this->uname = $uname;
        $this->userid= $uid;
        $this->pic = "";
        // echo 'The class "', __CLASS__, '" was initiated!<br />';
    }
}

    include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbConnection.php';
    function __autoload($class_name) {
        if(file_exists($class_name . '.php')) {
            require_once($class_name . '.php');
        } else {
            throw new Exception("Unable to load $class_name.");
        }
    }

    $uname = pg_escape_string($_POST['uname']);
    $groups = array();
//for movies

$result = pg_query($dbconn,
    "SELECT groupname, moviename, u2.uname, starttime, endtime, brief
FROM groups, ingroup, users u1, movies, users u2
WHERE movies.movieid = groups.movieid
AND groups.groupid=ingroup.groupid
AND movies.ownerid = u2.userid
AND ingroup.userid = u1.userid
AND u1.uname = '" . $uname . "';"

);
if(!$result){
    echo "0";
}
else{

    while ($row = pg_fetch_row($result)) {

            $newGroup = new Group(trim($row[0]));
            $newGroup->setMovie(new Movie(trim($row[1]),trim($row[2]),trim($row[3]),trim($row[4]),trim($row[5])));
            $groups[trim($row[0])] = $newGroup;

    }

}



//for users
    $result = pg_query($dbconn,
        "SELECT groups.groupname, u2.userid, u2.uname, u2.ipaddr
FROM groups, users u, users u2, ingroup in1, ingroup in2
WHERE groups.groupid = in2.groupid AND u.userid = in1.userid AND in1.groupid = in2. groupid AND u2.userid = in2.userid AND u.uname = '" .$uname . "'
GROUP BY groups.groupname, u2.userid, u2.uname;"
    );
    if(!$result){
        echo "0";
    }
    else{

        while ($row = pg_fetch_row($result)) {
            if(!$groups[trim($row[0])]){ // no group
                $newGroup = new Group(trim($row[0]));
                $newGroup->addUser(new User($row[1],trim($row[2])));
                $groups[trim($row[0])] = $newGroup;
            }else{ // had group
                $groups[trim($row[0])]->addUser(new User($row[1], trim($row[2]), trim($row[3])));
            }
        }

    }
//present the group
    echo json_encode($groups);

?>