<?php

$con = new mysqli("localhost","root","","school");

//insert value in table

$sqlinsert = "INSERT INTO teacher (id, name, department, subject, salary) VALUES ('1', 'Diya', 'English', 'English', 12000)";

if ($con->query($sqlinsert) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error creating record: " . $con->error;
}
$sqlinsert = "INSERT INTO student (id, name, branch,department, subject, roll)";

$sqlinsert2 = "INSERT INTO student (id, name, branch,department, subject, roll) VALUES ('1', 'Diya','CSE', 'English', 'English', '1')";
if($con->query($sqlinsert2) === TRUE)
{
    echo "New record created successfully";
}
else
{
    echo "Error creating record: " . $con->error;
}

?>
