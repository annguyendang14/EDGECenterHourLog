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
            		//username and password sent from form 
					$username = $_POST['username'];
            		$password = substr(crypt($_POST['password'],'$1$edgecore$'),12);
					$_SESSION['username'] = $username;
					//connect to database
					$db = connectDB();
					//query - searches for username and password match
					$query_users = "SELECT *
								FROM users
								WHERE (Username = '" . $username . "'AND Password = '" . $password . "')";
					//being extra sure to sanitize the query
					$user_match = mysqli_query($db, $query_users);
					
					if(!$user_match || mysqli_num_rows($user_match) == 0){
						print "Username or password incorrect - please try again";
					}
					else if(strcmp($username, "admin") == 0) {
						$_SESSION['isLoggedIn'] = true;
						$_SESSION['isAdmin'] = true;
						header('Location: http://www.blackninjasquirrels.com/hour-log/admin.php');
					} else{
						$_SESSION['isLoggedIn'] = true;
						$_SESSION['isAdmin'] = false;
						$_SESSION['usernamesearch'] = $username;
						header('Location: http://www.blackninjasquirrels.com/hour-log/user.php');
					}
                ?>
                <p>
                	<form action="http://www.blackninjasquirrels.com/hour-log/index.php" method="post">
                		<input type = "submit" value = "Return to Login" name = "return_to_login"/>
                	</form>
                </p>
        </section>
    </div>
</body>
</html>