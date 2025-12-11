<?php

include 'config.php';



$sql = "CREATE TABLE teacher (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    department VARCHAR(30) NOT NULL,
    subject VARCHAR(30) NOT NULL,
    salary INT(6) NOT NULL
)";

if ($con->query($sql) === TRUE) {
    echo "Table teacher created successfully";
} else {
    echo "Error creating table: " . $con->error;
}

?>