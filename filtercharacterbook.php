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
					<td>Discworld Characters and Books</td>		
				</tr>
				<tr>
					<th>First Name</th>
					<th>Title</th>
				</tr>
<?php
//prepare statement (mysqli object)
if(!($stmt = $mysqli->prepare("SELECT Characters.Fname, Books.Title FROM Characters INNER JOIN Books_Characters ON Books_Characters.CId=Characters.Id INNER JOIN Books ON Books.Id=Books_Characters.BId WHERE Characters.Id= ? GROUP BY Books.Id"))){
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
if(!$stmt->bind_result($Fname, $Title)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//go into statement & fetch next row of results and display until end of database
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $Fname . "\n</td>\n<td>\n" . $Title . "\n</tr>";
}
//close statement
$stmt->close();
?>
			</table>
		</div>
	</body>
</html>