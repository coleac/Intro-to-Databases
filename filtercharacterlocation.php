<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","colea-db","8X1AO9Uh6sr4K96x","colea-db");
//If no connection, display error
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!DOCTYPE html>
<html>
	<head>

	</head>
	<body>
		<div>
			<table>
			
				<tr>
					<td>Discworld Characters and Locations</td>		
				</tr>
				<tr>
					<th>First Name</th>
					<th>Name</th>
				</tr>
<?php
//prepare statement (mysqli object)
if(!($stmt = $mysqli->prepare("SELECT Characters.Fname, Locations.Name FROM Characters INNER JOIN Locations_Characters ON Locations_Characters.CId=Characters.Id INNER JOIN Locations ON Locations.Id=Locations_Characters.LId WHERE Characters.Id= ? GROUP BY Locations.Id"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error; //handle error (if not successful display error)
}
//bind parameters: string of type and variable stored in POST array- (key/value:field/variable)
if(!($stmt->bind_param("i",$_POST['CharacterFilter']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error; //handle error (if not successful display error)
}
//run statement (get back object)
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//stick results of query in variables
if(!$stmt->bind_result($Fname, $Name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//go into statement & fetch next row of results and display until end of database
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $Fname . "\n</td>\n<td>\n" . $Name . "\n</tr>";
}
//close statement
$stmt->close();
?>
			</table>
		</div>
	</body>
</html>