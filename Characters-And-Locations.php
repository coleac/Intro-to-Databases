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
					<td>Discworld Locations and Characters</td>		
				</tr>
				<tr>
					<th>LId</th>
					<th>CId</th>
				</tr>
		
<?php
//prepare statement (mysqli object)
if(!($stmt = $mysqli->prepare("SELECT Locations_Characters.LId, Locations_Characters.CId FROM Locations_Characters"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error; //handle error (if not successful display error)
}
//run statement (get back object)
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//stick results of query in variables
if(!$stmt->bind_result($LId, $CId)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//go into statement & fetch next row of results and display until end of database
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $LId . "\n</td>\n<td>" . $CId . "\n</tr>";
}
//close statement
$stmt->close();
?>
			</table>
		</div>
		<div>
			<form method="post" action="addcharactertolocation.php">
			<fieldset>
				<legend>Locations and Characters</legend>
				<p>Locations</p>
				<select name="Location">
<?php
//prepare statement (mysqli object)
if(!($stmt = $mysqli->prepare("SELECT Locations.Id, Locations.Name FROM Locations"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error; //handle error (if not successful display error)
}
//run statement (get back object)
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//stick results of query in variables
if(!$stmt->bind_result($Id, $Name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//go into statement & fetch requested values from next row of results and display in dropdown until end of database
while($stmt->fetch()){
 echo '<option value=" '. $Id .' "> ' . $Name . '</option>\n';
}
//close statement
$stmt->close();
?>
				</select>
				<br />
				<p>Characters</p>
				<select name="Character">
<?php
//prepare statement (mysqli object)
if(!($stmt = $mysqli->prepare("SELECT Characters.Id, Characters.Fname FROM Characters"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error; //handle error (if not successful display error)
}
//run statement (get back object)
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//stick results of query in variables
if(!$stmt->bind_result($Id, $Fname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//go into statement & fetch requested values from next row of results and display in dropdown until end of database
while($stmt->fetch()){
 echo '<option value=" '. $Id .' "> ' . $Fname . '</option>\n';
}
//close statement
$stmt->close();
?>
				</select>
				<p><input type="submit" name="addLC" value="Add Character to Location" /></p>
			</fieldset>
			</form>
		</div>
		<br />
		<div>
			<form method="post" action="filtercharacterlocation.php">
				<fieldset>
				<legend>Filter By Character</legend>
				<select name="CharacterFilter">
<?php
//prepare statement (mysqli object)
if(!($stmt = $mysqli->prepare("SELECT Characters.Id, Characters.Fname FROM Characters"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error; //handle error (if not successful display error)
}
//run statement (get back object)
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//stick results of query in variables
if(!$stmt->bind_result($Id, $Fname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//go into statement & fetch requested values from next row of results and display in dropdown until end of database
while($stmt->fetch()){
 echo '<option value=" '. $Id .' "> ' . $Fname . '</option>\n';
}
//close statement
$stmt->close();
?>
				</select>
				<input type="submit" value="Run Character Filter" />
				</fieldset>
			</form>
		</div>
		<br />
		<div>
		<form action=Discworld.php>
        <input type="submit" value="Go To Main Discworld Page" />
		</div>	
		<br /><br /><br /><br /><br />	
	</body>
</html>