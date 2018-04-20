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
					<td>Discworld Species</td>		
				</tr>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Characteristics</th>
				</tr>
<?php
//prepare statement (mysqli object)
if(!($stmt = $mysqli->prepare("SELECT Species.Id, Species.Name, Species.Characteristics FROM Species"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error; //handle error (if not successful display error)
}
//run statement (get back object)
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//stick results of query in variables
if(!$stmt->bind_result($Id, $Name, $Characteristics)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//go into statement & fetch next row of results and display until end of database
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $Id . "\n</td>\n<td>" . $Name . "\n</td>\n<td>\n" . $Characteristics . "\n</tr>";
}
//close statement
$stmt->close();
?>
			</table>
		</div>
		<br />
		<div>
			<form method="post" action="addspecies.php">
			<fieldset>
				<legend>Species</legend>
				<p>Name: <input type="text" name="SName"></p>
				<p>Characteristics: <input type="text" name="Characteristics"></p>
				<p><input type="submit" name="addS" value="Add Species" /></p>
			</form>
		</div>
		<br />
		<div>
		<form action=Locations.php>
        <input type="submit" value="Go To Discworld Locations Table" />
		</div>
		<br /><br /><br /><br /><br />		
	</body>
</html>