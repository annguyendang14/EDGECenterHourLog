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
        	<h1>Log In</h1>
            <p>Welcome to the hour log system for the EDGE Center! If you have any trouble, find Doug or Andy.</p>
			<?php
                session_start();
                $_SESSION['isLoggedIn'] = "false";
            ?>
            <form action="login-handler.php" method="post">
                <p><label for="username">Username:<br />
                <input type="text" name="username" id="username" /></label></p>
                <p><label for="password">Password:<br />
                <input type="password" name="password" id="password" /></label></p>
                <input type="submit" name="login" value="Log In" />
            </form>
        </section>
    </div>
</body>
</html>