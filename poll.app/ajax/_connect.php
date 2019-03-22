<?php
	//connection details
	$db_user = "root";
	$db_password = "";
	$db_name = "poll.app";
	$db_host = "localhost";

	//connection
	$db = mysqli_connect($db_host, $db_user, $db_password, $db_name);

	if ($db->connect_errno) {
		echo "Failed to connect to MySQL (". $db->connect_errno . ")" . $db->connect_error;
	}