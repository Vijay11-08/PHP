<!-- insertdata.php -->

<!-- Insert Data Into MySQL Table -->

<?php

$con = new mysqli("localhost","root","","employee");

//insert value in table
$sqlinsert = "INSERT INTO teacher (id, name, salary) VALUES ('1', 'Diya', '50000')";

    if ($con->query($sqlinsert) === TRUE)
        {
            echo "New record created successfully";
        } 
        else
            {
                echo "Error: " . $sql . "<br>" . $con->error;
            }

?>