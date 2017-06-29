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
        	<h1>Log Hour</h1>
            <a href="user.php">Back to Main Menu</a>
            <a href="index.php">Log Out</a>
			<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			  if (empty($_POST["hours"])) {
				$hourErr = "Hours is required";
			  } else {
				$hours = test_input($_POST["hours"]);
				
				if (!preg_match("/^[0-9.]*$/",$hours)) {
				  $hourErr = "Only number allowed for Hours"; 
				} elseif ((float)$hours > 24){
				  $hourErr = "Hours must smaller or equal to 24";  //what is max hour a day?
				} else {
					 $hourErr = "";
				}
			  }
			  if (empty($_POST["date"])) {
				$dateErr = "Date is required";
			  } else {
				$date = test_input($_POST["date"]);
				if (strlen($date) > 10){
				  $dateErr = "Date not in good format";
				} else {
					$date_dt = new DateTime($date);
				$today = date ("m/d/Y");
				$today_dt = new DateTime($today);
				// get the date of 2 week ago (limit for update time
				$last2week = date('Y-m-d',(strtotime ( '-28 day' , strtotime ( $today) ) ));
				$last2week_dt = new DateTime($last2week);
				if ($date_dt > $today_dt) {
					$dateErr = "Cannot log hours for future date";
				} elseif ($date_dt < $last2week_dt){
					$dateErr = "Cannot log hours for date more than 4 weeks ago"; //wording????
				} else {
					$dateErr = "";
				}
					
				}
				
			  }
			  if ($hourErr == "" && $dateErr == ""){
				   
			     $date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
				 $db = connectDB();
				 $query_insert_hour = "INSERT INTO hours (Username, Date, Hours) VALUES (\"" . $_SESSION['username'] . "\",\"" . $date . "\"," . $hours . ")
  ON DUPLICATE KEY UPDATE hours = " . $hours . ";";
  				 $update_hour_result = sendQuery($db, $query_insert_hour);	
				 if ($update_hour_result){
					 
					 
					
					 echo "<script> alert('Hours logged successfully'); </script>";
					 
				 } else {
					 echo "<script> alert('Something wrong happen when logging your hour, please contact Andy');</script>";
				 }
				 $reset = true;
				 
				
				
							
			  }
			}
			
			
			
			?>
            
            <form method="post" id="form"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              Date:
              <input type="date" name="date" id="date" value="<?php echo $date;?>">
              <span class="error">*</span>
              <br><br>
              <?php 
			  if ($dateErr != ""){  echo "<span class=\"error\"> " . $dateErr . "</span><br><br>";} 
			  ?>            
              Hours Working
              <input type="text" name="hours" id="hours" value="<?php echo $hours;?>">
              <span class="error">*</span>
              <br><br>
              <?php 
			  if ($hourErr != ""){  echo "<span class=\"error\"> " . $hourErr . "</span><br><br>";} 
			  ?>     
  			  <input type="submit" name="submit" value="Submit" >  
            </form>
           
            <?php 
			if ($reset){
				
				echo "<script>document.getElementById(\"date\").value=\"\"; </script>";
				echo "<script>document.getElementById(\"hours\").value=\"\"; </script>";
			}
			?>
            
         
            
            
           
            
        </section>
    </div>
</body>
</html>