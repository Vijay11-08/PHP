<!-- insert.php -->

<?php
include_once 'config.php';
$id=$_POST['id'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
//insert row
$sqlinsert = "INSERT INTO student VALUES('$id','$fname', '$lname');";
if ($conn->query($sqlinsert) === TRUE) 
{
    header("location: index.php");
} else 
{
    echo "Error: " . $sqlinsert . "<br>" . $conn->error;
}
?>