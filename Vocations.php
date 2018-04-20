<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","colea-db","8X1AO9Uh6sr4K96x","colea-db");
//If no connection, display error
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div>
			<table>			
				<tr>
					<td>Discworld Vocations</td>		
				</tr>
				<tr>
					<th>Id</th>
					<th>Title</th>
					<th>Duties</th>
				</tr>
<?php
//prepare statement (mysqli object)
if(!($stmt = $mysqli->prepare("SELECT Vocations.Id, Vocations.Title, Vocations.Duties FROM Vocations"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error; //handle error (if not successful display error)
}
//run statement (get back object)
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//stick results of query in variables
if(!$stmt->bind_result($Id, $Title, $Duties)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//go into statement & fetch next row of results and display until end of database
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $Id . "\n</td>\n<td>" . $Title . "\n</td>\n<td>\n" . $Duties . "\n</tr>";
}
//close statement
$stmt->close();
?>
			</table>
		</div>
		<br />
		<div>
			<form method="post" action="addvocation.php">
			<fieldset>
				<legend>Vocations</legend>
				<p>Title: <input type="text" name="VTitle"></p>
				<p>Duties: <input type="text" name="Duties"></p>
				<p><input type="submit" name="addV" value="Add Vocation" /></p>
			</form>
		</div>
		<br />
		<div>
		<form action=Species.php>
        <input type="submit" value="Go To Discworld Species Table" />
		</div>
		<br /><br /><br /><br /><br />
	</body>
</html>