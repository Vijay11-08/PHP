<!-- update.php -->

<!-- Update Data In a MySQL Table -->
 
<?php

$con = new mysqli("localhost","root","","employee");

//Update Data In a MySQL Table
$sqlupdate = "UPDATE teacher SET name='Joy' WHERE id=1";


    if ($con->query($sqlupdate) === TRUE)
        {
            echo "Record updated successfully";
        }
        else
            {
                echo "Error updating record: " . $con->error;
            }

?>