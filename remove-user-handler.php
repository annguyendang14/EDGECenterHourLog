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
					$username = $_SESSION['userToDelete'];
					//connect to database
					$db = connectDB();
					//query - searches for username and password match
					$query_users = "DELETE
								FROM users
								WHERE (Username = '" . $username . "')";
					//being extra sure to sanitize the query
					$success = sendQuery($db, $query_users);
						echo "<h2>User successfully removed!</h2>";
						echo "<p>What would you like to do next?</p>";
						echo "<a href=\"admin-add-user.php\">Add a New User</a>";
            			echo "<a href=\"admin-remove-user.php\">Remove a User</a>";
            			echo "<a href=\"admin-view-hours.php\">View Hours</a>";	
						echo "<a href=\"index.php\">Log Out</a>";	
                ?>
                <!--<p>
                	<form action="http://www.blackninjasquirrels.com/hour-log/index.php" method="post">
                		<input type = "submit" value = "Return to Login" name = "return_to_login"/>
                	</form>
                </p>-->
        </section>
    </div>
</body>
</html>