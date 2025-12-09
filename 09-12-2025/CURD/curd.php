<!-- curd.php -->

<?php
include_once 'config.php';
if($_POST['insert'])
{
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$sqlinsert = "INSERT INTO student VALUES('$fname', '$lname');";
	if ($conn->query($sqlinsert) === TRUE) 
	{
    	//header("location: pra_18_student registration.php");
    	echo "Recorded";
	}
	else 
	{
    	echo "Error: " . $sqlinsert . "<br>" . $conn->error;
	}
}
else if($_POST['read'])
{
	echo "Listing";
	//header("location:read.php");
}
else
{
	echo "Done";
}

/*$fname=$_POST['fname'];
$lname=$_POST['lname'];
//echo $fname;
//echo $lname;
//insert row
$sqlinsert = "INSERT INTO student VALUES('$fname', '$lname');";
if ($conn->query($sqlinsert) === TRUE) 
{
    header("location: pra_18_student registration.php");
    echo "<h2>Record saved</h2>";
} else 
{
    echo "Error: " . $sqlinsert . "<br>" . $conn->error;
}*/
?>