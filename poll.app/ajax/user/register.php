<?php

	//add db connection

	require("../_connect.php");

	//get data
	$username = htmlentities(mysqli_escape_string($db, $_GET['newUsername']));
	$password = htmlentities(mysqli_escape_string($db, $_GET['newPassword']));
	$password = sha1($password); //encrypt password

	//query
	$query = "INSERT INTO user (username, password) VALUES ('$username', '$password')";

	if($db->real_query($query)) {
		echo "Profile created successfully";
	} else {
		echo "Something went wrong";
		echo $db->errno;
	}

	//close db
	$db->close();



