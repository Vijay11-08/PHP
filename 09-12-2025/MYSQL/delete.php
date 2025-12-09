<!-- delete.php -->

<!-- Delete Data From a MySQL Table -->
<?php

$con = new mysqli("localhost","root","","employee");

// sql to delete a record
$sqldelete = "DELETE FROM teacher WHERE id=2";

    if ($con->query($sqldelete) === TRUE)
        {
            echo "Record deleted successfully";
        }
        else
            {
                echo "Error deleting record: " . $con->error;
            }

?>

