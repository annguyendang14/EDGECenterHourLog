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
</script>
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
				if(!$_SESSION['isLoggedIn'] ){	
					header('Location: http://www.blackninjasquirrels.com/hour-log/index.php');	
					}
				
				
				
			?>
        	<h1>Hour View</h1>
            <a href="user.php">Back to Main Menu</a>
            <a href="index.php">Log Out</a>
			<?php
				$db = connectDB();
				
				
				//getting  current term base on current date on server
				
				$query_get_term = 
				"SELECT TermId FROM terms WHERE Start_Date <= CURDATE() AND (End_Date >= CURDATE() OR ISNULL(End_Date))";
				
				$term_result = sendQuery($db, $query_get_term);
				$termID = 0;
				if (mysqli_num_rows($term_result) == 1) {
					// output data of each row
					$row = mysqli_fetch_assoc($term_result);
					foreach ($row AS $key => $data){
						$termID = $data;
						
					}
					
					//getting list of all term in current year
					
					$query_get_yearterm = "SELECT TermId FROM term_year
WHERE YEAR = (SELECT YEAR FROM term_year WHERE TermID = \"" . $termID ."\");";
					$termlist_result = sendQuery($db, $query_get_yearterm);
					if (mysqli_num_rows($termlist_result) > 0) {
						echo "<form>
                <select name=\"Term\" id=\"termSelect\" onchange=\"showWeek(this.value)\">";
						echo "<option value=\"\" >Select a term:</option>";
						while($row = mysqli_fetch_assoc($termlist_result)) {
							foreach ($row AS $key => $data){
								echo $data;
								echo "<option value=\"" . $data ."\">" . $data . "</option>";
							}
						
						}
						echo  "</select></form>";
						
                  
					} else {
						echo "somthing wrong with the database, please check with Andy";
					}
				} elseif (mysqli_num_rows($term_result) > 1) {
					echo "received 2 or more results for current term, please check with Andy";
				} else {
					echo "The current term is not yet added to the database, please check with Andy ";
				}
				
			?>
           
            <div id="weekSelect"><b></b></div>
            <div id="viewHours" style="padding:6px 0px;"><b></b></div>
        </section>
    </div>
</body>
</html>