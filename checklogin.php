<?php 
	session_start();
	$username = mysql_real_escape_string($_POST['username']); //username from login page
	$password = mysql_real_escape_string($_POST['password']); //password from login page

	mysql_connect("localhost", "root", "") or die(mysql_error()); //connect to server
	mysql_select_db("first_db") or die("Cannot connect to database"); //connect to db
	$query = mysql_query("SELECT * from users where username='$username'"); //check if username exist
	$exist = mysql_num_rows($query); //check if exist
	$table_users = "";
	$table_password = "";
	if ($exist > 0) { //there exist username in the table
		while ($row = mysql_fetch_assoc($query)) { //display all the rows from query
			$table_users = $row['username'];
			$table_password = $row['password'];
		}
		if (($username == $table_users) && ($password == $table_password)) {
			if ($password == $table_password) {
				$_SESSION['user'] = $username;
				header("location: home.php"); //redirects the user to the authenticated home page
			}
		} else {
			Print '<script> alert("Incorrect Password") </script>';
			Print '<script> window.location.assign("login.php") </script>';
		}
	}



 ?>