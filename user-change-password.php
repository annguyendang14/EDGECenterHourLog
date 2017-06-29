<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EDGE Center Hour Log</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,900' rel='stylesheet' type='text/css'>
<style>
.error {
	color: #FF0000;
	
	}
</style>
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
        	<h1>Changing Password</h1>
            <a href="user.php">Back to Main Menu</a>
            <a href="index.php">Log Out</a>
            <?php			
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
				  if (empty($_POST["oldpassword"])) {
					  $oldErr = "This field is required";
				  } else {
					$oldpass = crypt(test_input($_POST["oldpassword"]),'$1$edgecore$');
					$db = connectDB();
					$query_users = "SELECT *
								FROM users
								WHERE (Username = '" . $_SESSION['username'] . "'AND Password = '" . $oldpass . "')";
					//being extra sure to sanitize the query
					$user_match = mysqli_query($db, $query_users);
					
					if(!$user_match || mysqli_num_rows($user_match) == 0){
						$oldErr = "Your current password is not match, cannot change password";
					} else {
						$oldErr = "";
					}
				  }
				  if (empty($_POST["newpassword"])) {
					  $newErr = "This field is required";
				  } elseif (empty($_POST["new2password"])) {
					  $new2Err = "This field is required";
				  } else {
					  $newpass = test_input($_POST["newpassword"]);
					  $new2pass = test_input($_POST["new2password"]);
					 
					  if ( !strcmp($newpass,$new2pass) == 0 ) {
						  $newErr = "The two new password do not match! Please retype and try again";
					  } 
					  if (strlen($newpass)<8){
						  $newErr = "New password need to have more or equal to 8 character";
						  					  }	else {
						  $newErr = "";
						  $new2Err = "";
						 
					  }
					  
				  }
				  if ($oldErr == "" && $newErr == "" && $new2Err == ""){
					  $change_pass_query = "UPDATE users SET Password = \"" . substr(crypt($newpass,'$1$edgecore$'),12) . "\" WHERE username = \"" . $_SESSION['username'] . "\";";
					  $update_password_result = sendQuery($db, $change_pass_query);	
						 if ($update_password_result){
							 echo "<script> alert('Password change successfully'); </script>";
						 } else {
							 echo "<script> alert('Something wrong happen, please contact Andy');</script>";
						 }
				  }
			    }
			  
			?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
            	<p><label for="password">Old Password:<br />
                <input type="password" name="oldpassword" id="oldpassword" /></label></p>
                <?php 
			  if ($oldErr != ""){  echo "<span class=\"error\"> " . $oldErr . "</span><br><br>";} 
			  ?>      
                <p><label for="password">New Password:<br />
                <input type="password" name="newpassword" id="newpassword" /></label></p>
                <?php 
			  if ($newErr != ""){  echo "<span class=\"error\"> " . $newErr . "</span><br><br>";} 
			  ?>      
                <p><label for="password">Re-Type New Password:<br />
                <input type="password" name="new2password" id="new2password" /></label></p>
                 <?php 
			  if ($new2Err != ""){  echo "<span class=\"error\"> " . $new2Err . "</span><br><br>";} 
			  ?>      
                <input type="submit" name="submit" value="Submit">  
            </form>
			<?php
			?>
            
        </section>
    </div>
</body>
</html>