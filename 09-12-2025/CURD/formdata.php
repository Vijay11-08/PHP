<!-- formdata.php -->

<?php
//create connection
$conn = new mysqli("localhost","root","","person");
//check connection
if($conn->connect_error)
{
	die("Connection failed:" . $conn->connect_error);
}
else
{
	echo "Connected successfully" . "<br>";
}
$fname=$_POST['fname'];
$lname=$_POST['lname'];
//echo $fname;
//echo $lname;
//insert row
$sqlinsert = "INSERT INTO student VALUES('$fname', '$lname');";
if ($conn->query($sqlinsert) === TRUE) 
{
    echo "New record created successfully";
} else 
{
    echo "Error: " . $sqlinsert . "<br>" . $conn->error;
}
?>