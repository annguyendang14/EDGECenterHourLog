<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EDGE Center Hour Log</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,900' rel='stylesheet' type='text/css'>
<script>
function showWeek(str) {
    if (str == "") {
        document.getElementById("weekSelect").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("weekSelect").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","user-get-week.php?q="+str,true);
        xmlhttp.send();
    }
}
function showHour(str) {
    if (str == "") {
        document.getElementById("viewHours").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("viewHours").innerHTML = this.responseText;
            }
        };
		var term = document.getElementById("termSelect").value;
		xmlhttp.open("GET","hour-view.php?t="+term+"&w="+str,true);
        xmlhttp.send();
    }
}
function showTranscript(){
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("viewHours").innerHTML = this.responseText;
		}
	};
	
	xmlhttp.open("GET","hour-view.php?t=419",true); //just a random number for term
	xmlhttp.send();
}
</script>
</head>

<body>
	<div class="container">
    	<header class="site-header center">
        	<img src="images/logo.png" alt="EDGE logo" />
        </header>
        <section class="content center">
        	<h1>Welcome, Admin!</h1>
            <p>What would you like to do today?</p>
			<?php
					session_start();
					include("library/functions.php");
            		//username and password sent from form 
					//test if n	
					if(!$_SESSION['isAdmin'] ){	
						header('Location: http://www.blackninjasquirrels.com/hour-log/index.php');	
					}
?>
            <a href="admin-add-user.php">Add a New User</a>
            <a href="admin-remove-user.php">Remove a User</a>
            <a href="admin-view-hours.php">View Hours</a>
            <a href="index.php">Log Out</a>
            
            <?php
			$user = test_input($_POST['username']);
			$_SESSION['usernamesearch'] = $user;
			echo "<p> View hours for User: " . $user . "</p>" ;
			echo "
            <a onclick=\"showTranscript()\">See full history</a>";
			$db = connectDB();
				
				
				//getting  current term base on current date on server
				
				$query_get_term = 
				"SELECT DISTINCT TermID FROM hours_term WHERE username = \"" . $user . "\" ORDER BY TermId DESC;";
				
				$term_result = sendQuery($db, $query_get_term);
				
					
				if (mysqli_num_rows($term_result) > 0) {
					echo "<form>
			<select name=\"Term\" id=\"termSelect\" onchange=\"showWeek(this.value)\">";
					echo "<option value=\"\" >Select a term:</option>";
					while($row = mysqli_fetch_assoc($term_result)) {
						foreach ($row AS $key => $data){
							echo $data;
							echo "<option value=\"" . $data ."\">" . $data . "</option>";
						}
					
					}
					echo  "</select></form>";
					
			  
				} else {
					echo "<p style =\"color: red;\">The username you put in is not valid or this user don't have any hours record yet</p>";
				}
				
				
			?>
            
            <div id="weekSelect"><b></b></div>
            <div id="viewHours" style="padding:6px 0px;"><b></b></div>
                
        </section>
    </div>
</body>
</html>