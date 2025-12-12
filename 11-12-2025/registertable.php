<?php

$con = new mysqli("localhost","root","","internship");

    // $insert="insert into register(username,email,password) values('$_GET[username]','$_GET[email]','$_GET[password]')";

$sql = "CREATE TABLE register (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
)";

if ($con->query($sql) === TRUE) {
    echo "Table register created successfully";
} else {
    echo "Error creating table: " . $con->error;
}
?>