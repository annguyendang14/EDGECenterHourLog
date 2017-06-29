<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EDGE Center Hour Log</title>
<link rel="stylesheet" type="text/css" href="http://www.blackninjasquirrels.com/hour-log/styles.css" />
<link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,900' rel='stylesheet' type='text/css'>
</head>

<body>
	<div class="container">
    	<header class="site-header center">
        	<img src="http://www.blackninjasquirrels.com/hour-log/images/logo.png" alt="EDGE logo" />
        </header>
        <section class="content center">
        	<h1>Log In</h1>
            <p>Welcome to the hour log system for the EDGE Center! If you have any trouble, find Doug or Andy.</p>
			<?php
					session_start();
					include("library/functions.php");
					if(!$_SESSION['isAdmin'] ){	
						header('Location: http://www.blackninjasquirrels.com/hour-log/index.php');	
					}
            		//get info for new user
					$username = $_POST['username'];
            		$password = substr(crypt($_POST['password'],'$1$edgecore$'),12);
					$first_name = $_POST['first_name'];
					$last_name = $_POST['last_name'];
					$year = $_POST['year'];
					//connect to database
					$db = connectDB();
					//query - searches for username and password match
					$query_check = "SELECT username FROM users WHERE username = \"" . $username . "\";";
					$exist = sendQuery($db, $query_check);
					if (mysqli_num_rows($exist) > 0) {
						print "Error - username already exist";
					} else {
						$query_users = "INSERT INTO users
										VALUES ('$username','$password','$first_name','$last_name','$year')";
						//being extra sure to sanitize the query
						$success = sendQuery($db, $query_users);
						
						if(is_null($success)){
							print "Error - please try again";
						}
						else {
							
							echo "<h2>User successfully added!</h2>";
							echo "<p>What would you like to do next?</p>";
							echo "<a href=\"admin-add-user.php\">Add a New User</a>";
							echo "<a href=\"admin-remove-user.php\">Remove a User</a>";
							echo "<a href=\"admin-view-hours.php\">View Hours</a>";
							echo "<a href=\"index.php\">Log Out</a>";	
						}
					}
                ?>
                
        </section>
    </div>
</body>
</html>