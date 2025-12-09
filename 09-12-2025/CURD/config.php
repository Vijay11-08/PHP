<!-- config.php -->

<?php
//database "person" and table "student" with id, fname,lname must be created in my sql. 
//create connection

$conn = new mysqli("localhost","root","","person");
//check connection
if($conn->connect_error)
{
	die("Connection failed:" . $conn->connect_error);
}
else
{
	//echo "Connected successfully" . "<br>";
}