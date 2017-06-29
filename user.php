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
        	<?php
				session_start();
				include("library/functions.php");
				//username and password sent from form 
					//test if n	
				if(!$_SESSION['isLoggedIn'] ){	
					header('Location: http://www.blackninjasquirrels.com/hour-log/index.php');	
					}
			?>
        	<h1>Welcome!</h1>
            <p>What would you like to do today?</p>
			<?php
			?>
            <a href="user-change-password.php">Change Password</a>
            <a href="user-view-hours.php">View Hours</a>
            <a href="user-update-hours.php">Add/Edit Hours</a>
            <a href="index.php">Log Out</a>
        </section>
    </div>
</body>
</html>