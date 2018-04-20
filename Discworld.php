<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","colea-db","PW","colea-db");
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
			<h2>Welcome to the Discworld Database</h2>
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
if(!($stmt = $mysqli->prepare("SELECT Characters.Id, Characters.Fname, Characters.Lname, Species.Name, Vocations.Title FROM Characters INNER JOIN Species ON Species.Id=Characters.Species INNER JOIN Vocations ON Vocations.Id=Characters.Vocation GROUP BY Id"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error; //handle error (if not successful display error)
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
		<br />
		<div>
			<form method="post" action="addcharacter.php">
				<fieldset>
				<legend>Add Character</legend>
				<p>First Name: <input type="text" name="FirstName"></p>
				<p>Last Name: <input type="text" name="LastName"></p>
				<p>Species</p>
				<select name="Species">
<?php
//prepare statement (mysqli object)
if(!($stmt = $mysqli->prepare("SELECT Species.Id, Species.Name FROM Species"))){
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
				<p>Vocation</p>
				<select name="Vocation">
<?php
//prepare statement (mysqli object)
if(!($stmt = $mysqli->prepare("SELECT Vocations.Id, Vocations.Title FROM Vocations"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error; //handle error (if not successful display error)
}
//run statement (get back object)
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//stick results of query in variables
if(!$stmt->bind_result($Id, $Title)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//go into statement & fetch requested values from next row of results and display in dropdown until end of database
while($stmt->fetch()){
 echo '<option value=" '. $Id .' "> ' . $Title . '</option>\n';
}
//close statement
$stmt->close();
?>
				</select>
				<p><input type="submit" name="addC" value="Add Character" /></p>
				</fieldset>			
			</form>
		</div>
		<br />
		<div>
			<form method="post" action="deletecharacter.php">
				<fieldset>
				<legend>Delete Character</legend>
				<p>First Name</p>
				<select name="Id">
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
				<p><input type="submit" name="deleteC" value="Delete Character" /></p>
				</fieldset>
			</form>
		</div>
		<br />
		<div>
			<form method="post" action="filtervocation.php">
				<fieldset>
				<legend>Filter By Vocation</legend>
				<select name="Vocation">
<?php
//prepare statement (mysqli object)
if(!($stmt = $mysqli->prepare("SELECT Vocations.Id, Vocations.Title FROM Vocations"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error; //handle error (if not successful display error)
}
//run statement (get back object)
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//stick results of query in variables
if(!$stmt->bind_result($Id, $Title)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error; //handle error (if not successful display error)
}
//go into statement & fetch requested values from next row of results and display in dropdown until end of database
while($stmt->fetch()){
 echo '<option value=" '. $Id .' "> ' . $Title . '</option>\n';
}
//close statement
$stmt->close();
?>
				</select>
				<input type="submit" value="Run Vocation Filter" />
				</fieldset>
			</form>
		</div>
		<br />
		<div>
			<form method="post" action="filterspecies.php">
				<fieldset>
				<legend>Filter By Species</legend>
				<select name="Species">
<?php
//prepare statement (mysqli object)
if(!($stmt = $mysqli->prepare("SELECT Species.Id, Species.Name FROM Species"))){
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
				<input type="submit" value="Run Species Filter" />
				</fieldset>
			</form>
		</div>
		<br />
		<div>
		<form action=Vocations.php>
        <input type="submit" value="Go To Discworld Vocations Table" />
		</div>
		<br /><br /><br /><br /><br />
	</body>
</html>