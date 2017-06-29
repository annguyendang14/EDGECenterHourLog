<!DOCTYPE html>
<html>
<head>
<style>
#hint {
	margin:0px !important;
}
#hint:hover{
	text-decoration:underline;
}

</style>
</head>
<body>
<?php
include("library/functions.php");

//get the q parameter from URL
$u=$_GET["u"];
$l=$_GET["l"];

//lookup all links from the xml file if length of q>0
$hint="";
if (strlen($u)>0) {
  
  $db = connectDB();
  $query_users = "SELECT username FROM users WHERE username LIKE \"%" . $u . "%\";";
  $user_result = sendQuery($db, $query_users);
  if (mysqli_num_rows($user_result) > 0) {			
  	while($row = mysqli_fetch_array($user_result)) {
		if ($hint ==""){
			$hint = "<p id=\"hint\" onclick=\"getValU(this.innerHTML)\">" . $row['username'] . "</p>";
		}
		else {
			$hint = $hint . "<br /><p id=\"hint\" onclick=\"getValU(this.innerHTML)\">" . $row['username'] . "</p>";
		}
	}
  }
} elseif (strlen($l)>0){
  $db = connectDB();
  $query_users = "SELECT `Last name`, `First name`, `username` FROM users WHERE `Last name` LIKE \"%" . $l . "%\";";
  $user_result = sendQuery($db, $query_users);
  if (mysqli_num_rows($user_result) > 0) {			
  	while($row = mysqli_fetch_array($user_result)) {
		if ($hint ==""){
			$hint = "<p id=\"hint\" onclick=\"getValL(this.innerHTML)\">" . $row['Last name'] . ", " . $row['First name'] . " (" . $row['username'] . ")" . "</p>";
		}
		else {
			$hint = $hint . "<br /><p id=\"hint\" onclick=\"getValL(this.innerHTML)\">" . $row['Last name'] . ", " . $row['First name'] . " (" . $row['username'] . ")" . "</p>";
		}
	}
  }
} 

// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
  $response="no suggestion";
} else {
  $response=$hint;
}

//output the response
echo $response;
?>
</body>
</html>