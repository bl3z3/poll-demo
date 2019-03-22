<?php
	session_start();
	//add db connection

	require("../_connect.php");

	//get data
	$username = htmlentities(mysqli_escape_string($db, $_GET['username']));
	$password = htmlentities(mysqli_escape_string($db, $_GET['password']));
	$password = sha1($password); //encrypt password

	//query
	$query = "SELECT id,username FROM user WHERE username='$username' AND password = '$password'";

	if($db->real_query($query)) {
		$res = $db->use_result();
		//get data
		while($user = $res->fetch_assoc()) {
			$_SESSION['loggedIn'] = $user['id'];
			$SESSION['username'] = $user['username'];
		}
	} else {
		echo "Something went wrong";
		echo $db->errno;
	}

	$db->close();