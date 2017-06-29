<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EDGE Center Hour Log</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,900' rel='stylesheet' type='text/css'>
<script>
function showResult(str) {
  if (str.length==0) { 
    document.getElementById("usernameSearch").innerHTML="";
    document.getElementById("usernameSearch").style.border="0px";
	document.getElementById("lastNameSearch").innerHTML="";
    document.getElementById("lastNameSearch").style.border="0px";
    return null;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  return xmlhttp;
 
}
function showResultUsername(str) {
	xmlhttp = showResult(str);
	if (xmlhttp === null){
		return;
	}
	xmlhttp.onreadystatechange=function() {
		if (this.readyState==4 && this.status==200) {
		  document.getElementById("usernameSearch").innerHTML=this.responseText;
		  document.getElementById("usernameSearch").style.border="1px solid #A5ACB2";
		}
	  }
	  xmlhttp.open("GET","user-search.php?u="+str+"&l=",true);
	  xmlhttp.send();
}
function showResultLastname(str) {
	xmlhttp = showResult(str);
	if (xmlhttp === null){
		return;
	}
	xmlhttp.onreadystatechange=function() {
		if (this.readyState==4 && this.status==200) {
		  document.getElementById("lastNameSearch").innerHTML=this.responseText;
		  document.getElementById("lastNameSearch").style.border="1px solid #A5ACB2";
		}
	  }
	  xmlhttp.open("GET","user-search.php?l="+str+"&u=",true);
	  xmlhttp.send();
}
function getValU(str){
	document.getElementById("username").value=str;
}
function getValL(str){
	start = str.indexOf("(")+1;
	end = str.indexOf(")");
	user = str.slice(start,end);
	document.getElementById("username").value=user;
	document.getElementById("lastname").value="";
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
            <p>Search for a user...</p>
			<?php
					session_start();
					include("library/functions.php");
            		//username and password sent from form 
					//test if n	
					if(!$_SESSION['isAdmin'] ){	
						header('Location: http://www.blackninjasquirrels.com/hour-log/index.php');	
					}
?>
            <form action="admin-hour-view.php" method="post">
            	<p><label for="username">Search for user (by username):<br />
                <input type="text" name="username" id="username" onkeyup="showResultUsername(this.value)" autocomplete='off'/></label></p>
                <div id="usernameSearch"></div>
                <p><label for="lastname">Search for user (by last name):<br />
                <input type="text" name="lastname" id="lastname" onkeyup="showResultLastname(this.value)" autocomplete='off'/></label></p>
                <div id="lastNameSearch"></div>
                <p>
                <input type="submit" name="login" value="Search" /></p>
            </form>
            <a href="admin-add-user.php">Add a New User</a>
            <a href="admin-remove-user.php">Remove a User</a>
            <a href="admin-view-hours.php">View Hours</a>
            <a href="index.php">Log Out</a>
            
                
        </section>
    </div>
</body>
</html>