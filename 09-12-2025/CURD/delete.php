<!-- delete.php -->

<?php
include_once 'config.php';
$id = $_GET['id']; 
$sqldelete = ("DELETE FROM student WHERE id='".$id."'");
if ($conn->query($sqldelete) === TRUE)
{
    header("location: index.php");
} 
else 
{
    echo "Error deleting record: " . $conn->error;
}
?>