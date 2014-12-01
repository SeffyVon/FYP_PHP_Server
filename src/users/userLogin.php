<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbConnection.php';

	$uname = $_POST["uname"];
	$hashOfPw = $_POST["hashOfPw"];
	$result = pg_query($dbconn, "SELECT userid FROM users WHERE uname= '" . pg_escape_string($uname) . "' AND hashofpw='" . pg_escape_string($hashOfPw) .  "'");
	if(!$result)
		$output = 'Failed authentication!';
	if($row = pg_fetch_row($result)) {
  		//echo "UserID: $row[0] <br> IP Address: $row[1]";
        $output =  "OK";
 	}else{
        $output = "Reject";
    }


echo $output;


?>