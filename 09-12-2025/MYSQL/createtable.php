<!-- createtable.php -->

<!-- Create a MySQL Table -->

<?php

$con = new mysqli("localhost","root","","employee");

//include_once 'config.php';
// sql to create table

$sqltable = "CREATE TABLE teacher(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            salary INT(6) NOT NULL)";


if ($con->query($sqltable) === TRUE)
{
    echo "Table teacher created successfully";
} 
else
{
    echo "Error: " . $sqltable . "<br>" . $con->error;
}

?>