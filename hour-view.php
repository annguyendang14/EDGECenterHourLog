<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
	background-color: #E4E4E4;
	
	
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: center;}
</style>
</head>
<body>

<?php
session_start();
include("library/functions.php");
$term = strval($_GET[t]);
$week = intval($_GET[w]);
$db = connectDB();

if ($term == 419){
	$query_term_view = "SELECT TermID, WEEK, DATE, Hours FROM hours_term 
	WHERE Username = \"" . $_SESSION['usernamesearch'] . "\"  ORDER BY DATE DESC;";
	
	$term_hour_result = sendQuery($db, $query_term_view);			
	if (mysqli_num_rows($term_hour_result) > 0) {
	 	echo "<table>
		<tr>
		<th>Term</th>
		<th>Week</th>
		<th>Date</th>
		<th>Hours</th>
		</tr>";
		$total = 0;
		while($row = mysqli_fetch_array($term_hour_result)) {
			echo "<tr>";
			echo "<td>" . $row['TermID'] . "</td>";
			echo "<td>" . $row['Week'] . "</td>";
			echo "<td>" . $row['Date'] . "</td>";
			echo "<td>" . $row['Hours'] . "</td>";
			$total += $row['Hours'];
			echo "</tr>";
		}
		echo "<tr>";
		echo "<td> Total </td>";
		echo "<td> </td>";
		echo "<td> </td>";
		echo "<td>" . $total . "</td>";
		echo "</table>";
		
	
	} else {
		echo "This user dont have any record yet";
	}				
}
	//view all weeks
else if ($week == 0){
	
	$query_term_view = "SELECT WEEK, DATE, Hours FROM hours_term 
	WHERE Username = \"" . $_SESSION['usernamesearch'] . "\" AND TermID = \"" . $term . "\" ORDER BY DATE;";
	
	$term_hour_result = sendQuery($db, $query_term_view);			
	if (mysqli_num_rows($term_hour_result) > 0) {
	 	echo "<table>
		<tr>
		<th>Week</th>
		<th>Date</th>
		<th>Hours</th>
		</tr>";
		$total = 0;
		while($row = mysqli_fetch_array($term_hour_result)) {
			echo "<tr>";
			echo "<td>" . $row['Week'] . "</td>";
			echo "<td>" . $row['Date'] . "</td>";
			echo "<td>" . $row['Hours'] . "</td>";
			$total += $row['Hours'];
			echo "</tr>";
		}
		echo "<tr>";
		echo "<td> Total </td>";
		echo "<td> </td>";
		echo "<td>" . $total . "</td>";
		echo "</table>";
		
	
	} else {
		echo "You dont have any record in this term yet";
	}			

	
	
	
} else { //view a specific week
	$query_week_view = "SELECT DATE, Hours FROM hours_term 
	WHERE Username = \"" . $_SESSION['usernamesearch'] . "\" AND TermID = \"" . $term . "\" AND Week = \"" . $week . "\" ORDER BY DATE;";
	
	$week_hour_result = sendQuery($db, $query_week_view);			
		
	if (mysqli_num_rows($week_hour_result) > 0) {
	 	echo "<table>
		<tr>
		<th>Date</th>
		<th>Hours</th>
		</tr>";
		$total = 0;
		while($row = mysqli_fetch_array($week_hour_result)) {
			echo "<tr>";
			echo "<td>" . $row['Date'] . "</td>";
			echo "<td>" . $row['Hours'] . "</td>";
			$total += $row['Hours'];
			echo "</tr>";
		}
		echo "<tr>";
		echo "<td> Total </td>";
		echo "<td>" . $total . "</td>";
		echo "</table>";
		
	
	} else {
		echo "You dont have any record in this week yet";
	}			
	
}
	
		

?>
</body>
</html>