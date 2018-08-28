<!DOCTYPE html>
<html>
<head>
	<title>CRUD PHP</title>
</head>
<body>
	<h2>Registration Page</h2>
	<a href="index.php">Click here to go back</a> <br/><br/>
	<form action="register.php" method="post">
		Enter Username: <input type="text" name="username" required="required" /> <br/>
		Enter Password: <input type="text" name="password" required="required" /> <br/>
		<input type="submit" value="Register">
	</form>
</body>
</html>

<?php 
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);

		$bool = true;

		mysql_connect("localhost", "root", "") or die(mysql_error()); //connect to server
		mysql_select_db("first_db") or die("Cannot connect to database"); //connect to database
		$query = mysql_query("select * from users"); //query the users table
		while ($row = mysql_fetch_array($query)) { //display all the rows from the query
			$table_users = $row['username'];
			if ($username == $table_users) {
				$bool = false;
				Print '<script> alert("Username is already taken");</script>'; //prompt the user
				Print '<script> window.location.assign("register.php");</script>'; // redirect to register.php

			}
		}

		if ($bool) {
			mysql_query("INSERT INTO users (username, password) VALUES ('$username', $password)"); //insert the value to table users
			Print '<script> alert("Successfully registerd");</script>'; //prompt the user
			Print '<script> window.location.assign("register.php");</script>'; // redirect to register.php
		}
	}
 ?>

