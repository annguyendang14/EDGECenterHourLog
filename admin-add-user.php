<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EDGE Center Hour Log</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,900' rel='stylesheet' type='text/css'>
</head>

<body>
	<div class="container">
    	<header class="site-header center">
        	<img src="images/logo.png" alt="EDGE logo" />
        </header>
        <section class="content center">
        	<h1>Welcome, Admin!</h1>
            <p>Let's add a user...</p>
			<?php
					session_start();
					include("library/functions.php");
            		//username and password sent from form 
					//test if n	
					if(!$_SESSION['isAdmin'] ){	
						header('Location: http://www.blackninjasquirrels.com/hour-log/index.php');	
					}
?>
            <form action="add-user-handler.php" method="post">
            	<p><label for="username">Username:<br />
                <input type="text" name="username" id="username" required="required" /></label></p>
                <p><label for="password">Initial Password:<br />
                <input type="password" name="password" id="password" required="required" /></label></p>
                <p><label for="first_name">First Name:<br />
                <input type="text" name="first_name" id="first_name" required="required" /></label></p>
                <p><label for="last_name">Last Name:<br />
                <input type="text" name="last_name" id="last_name" required="required" /></label></p>
                <p><label for="year">Year:<br />
                <input type="text" name="year" id="year" required="required" /></label></p>
                <p>
                <input type="submit" name="login" value="Add User" /></p>
            </form>
            <a href="admin-add-user.php">Add a New User</a>
            <a href="admin-remove-user.php">Remove a User</a>
            <a href="admin-view-hours.php">View Hours</a>
            <a href="index.php">Log Out</a>
                
        </section>
    </div>
</body>
</html>