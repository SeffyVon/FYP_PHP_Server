<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbConnection.php';

	$uname = $_POST["uname"];
	$hashOfPw = $_POST["hashOfPw"];
    $ipAddrUpdate = $_POST["ipAddrUpdate"];
    $ipAddr = $_POST["ipAddr"];
	$result = pg_query($dbconn, "SELECT userid FROM users WHERE uname= '" . pg_escape_string($uname) . "' AND hashofpw='" . pg_escape_string($hashOfPw) .  "'");
	if(!$result)
		$output = 'Failed authentication!';
    else {
        $row = pg_fetch_row($result);
        $uid = $row[0];

        if ($ipAddrUpdate == TRUE) {
            $update_ipAddr = "UPDATE Users SET ipaddr = '" . $ipAddr . "' WHERE userid = " . $uid . ";";
            $pic_result = pg_query($dbconn, $update_ipAddr);
        }

        if($row) {
            $output =  "OK";
        }else{
            $output = "Reject";
        }
    }


echo $output;


?>