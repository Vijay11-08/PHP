<!-- update_record.php -->

<?php
include_once 'config.php';
$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$sqlupdate = "UPDATE student SET fname='$fname', lname='$lname' WHERE id='$id';";
if ($conn->query($sqlupdate) === TRUE) 
{
    header("location: index.php");
} 
else 
{
    echo "Error updating record: " . $conn->error;
}
?>