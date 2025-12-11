<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "school";

$con = new mysqli($host, $user, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
else
{
    echo "Connected successfully";
}

?>
