<!-- createdb.php -->

<!-- Create a MySQL Database -->

<?php
include_once 'config.php';

//create database
$sql="create database employee";

if($con->query($sql) === TRUE)
{
    echo "Database Created successfully";
}
else
{
   echo "Error in database creating:" . $con->error;
}
$con->close();
?>