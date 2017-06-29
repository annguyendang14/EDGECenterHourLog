<?php
	include("library/config.php");
	
	function connectDB(){
		global $db,$dbhost,$dbuser,$dbpassword,$dbdatabase;	
		$db = mysqli_connect("DB_server", "DB_user", "DB_pass", "DB_name"); //fake info
		if(mysqli_connect_errno()){
			print("Connection failed. Error: " . mysqli_connect_error());
			exit();	
		}
		return $db;
	}
	
	function closeDB () {
		global $conn;
		mysql_close($conn);
	}
	
	function sendQuery($db, $query){
		trim($query);
		$query = stripslashes($query);
		$query_result = mysqli_query($db, $query);
		return $query_result;
	}
	
	function test_input($data) {
			  $data = trim($data);
			  $data = stripslashes($data);
			  $data = htmlspecialchars($data);
			  return $data;
	}
	
	
	