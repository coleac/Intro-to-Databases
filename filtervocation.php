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
					<td>Discworld Characters</td>		
				</tr>
				<tr>
					<th>Id</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Species</th>
					<th>Vocation</th>
				</tr>
<?php
//prepare statement (mysqli object)
if(!($stmt = $mysqli->prepare("SELECT Characters.Id, Characters.Fname, Characters.Lname, Species.Name, Vocations.Title FROM Characters INNER JOIN Species ON Species.Id=Characters.Species INNER JOIN Vocations ON Vocations.Id=Characters.Vocation WHERE Vocations.Id= ? GROUP BY Characters.Id"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error; //handle error (if not successful display error)
}
//bind parameters: string of type and variable stored in POST array- (key/value:field/variable)
if(!($stmt->bind_param("i",$_POST['Vocation']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error; //handle error (if not successful display error)
}
//run statement (get back object)
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//stick results of query in variables
if(!$stmt->bind_result($Id, $Fname, $Lname, $Species, $Vocation)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//go into statement & fetch next row of results and display until end of database
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $Id . "\n</td>\n<td>" . $Fname . "\n</td>\n<td>\n" . $Lname . "\n</td>\n<td>\n" . $Species . "\n</td>\n<td>\n" . $Vocation . "\n</tr>";
}
//close statement
$stmt->close();
?>
			</table>
		</div>
	</body>
</html>