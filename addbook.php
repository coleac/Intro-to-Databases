<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","colea-db","8X1AO9Uh6sr4K96x","colea-db");
//If no connection, display error
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
//prepare statement (mysqli object)	
if(!($stmt = $mysqli->prepare("INSERT INTO Books(Title, Date) VALUES (?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error; //handle error (if not successful display error)
}
//bind parameters: string of types and variables stored in POST array- (key/value:field/variable)
if(!($stmt->bind_param("sd",$_POST['BTitle'],$_POST['BDate']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error; //handle error (if not successful display error)
}
//run statement
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error; //handle error (if not successful display error)
} else {
	header("Location:http://web.engr.oregonstate.edu/~colea/cs340/Books.php");//return to page w/ updated table
	//echo "Added " . $stmt->affected_rows . " rows to Books."; //if successful display confirmation
}
?>