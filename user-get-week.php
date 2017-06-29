<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
session_start();
include("library/functions.php");
$term = strval($_GET[q]);
	
$query_get_week = "SELECT DISTINCT WEEK FROM hours_term WHERE TermID = \"" . $term . "\" AND Username = \"" . $_SESSION['usernamesearch'] . "\" ORDER BY WEEK;";

	
$db = connectDB();

$week_result = sendQuery($db, $query_get_week);			
if (mysqli_num_rows($week_result) > 0) {
	echo "<form>";
	echo "<select name=\"Week\" id=\"weekSelect\" onchange=\"showHour(this.value)\">";
	//echo "<select name=\"Week\">";
	
	echo "<option value=\"\" id=\"weekSelect\">Select a week:</option>";
	echo "<option value=\"0\" id=\"weekSelect\">View all weeks</option>";
	while($row = mysqli_fetch_assoc($week_result)) {
		foreach ($row AS $key => $data){
			echo $data;
			echo "<option value=\"" . $data ."\">" . $data . "</option>";
		}
	
	}
	echo  "</select></form>";
	

} else {
	echo "You dont have any record in this term yet";
}			

?>
</body>
</html>