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
            <p>Let's remove a user...</p>
			<?php
					session_start();
					include("library/functions.php");
            		//username and password sent from form 
					//test if n	
					if(!$_SESSION['isAdmin'] ){	
						header('Location: http://www.blackninjasquirrels.com/hour-log/index.php');	
					}
					//connect to database
					$db = connectDB();
					$_SESSION['userToDelete'] = $_POST['username'];
					
					//query - searches for username and password match
					$query_users = "SELECT *
								FROM users
								WHERE (Username = '" . $_SESSION['userToDelete'] . "')";
					//being extra sure to sanitize the query
					$result = sendQuery($db, $query_users);
					
					if(!$result || mysqli_num_rows($result) == 0){
						echo "<p>No such user exists.</p>";
					} else{
?>
            <form action="remove-user-handler.php" method="post">
            	<p>Are you sure you want to delete <?php echo $_SESSION['userToDelete']; ?>?</p>
                <input type="submit" name="login" value="Confirm deletion" /></p>
            </form>
            <?php }?>
            <a href="admin-add-user.php">Add a New User</a> 
            <a href="admin-remove-user.php">Remove a User</a> 
            <a href="admin-view-hours.php">View Hours</a>
            <a href="index.php">Log Out</a>
                
        </section>
    </div>
</body>
</html>