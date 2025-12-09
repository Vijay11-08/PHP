<!-- select.php -->

<!-- Select/List/Read  Data From a MySQL Table -->

<?php

$con = new mysqli("localhost","root","","employee");

//select data from table
$sqlselect = "SELECT id, name, salary FROM teacher";
$result = $con->query($sqlselect);

    if ($result->num_rows > 0)
    {
        // output data of each row
        while($row = $result->fetch_assoc())
            {
                echo "Teacher " . $row["name"]. " having " . $row["salary"]. " Salary." . "<br>";
            }
            } else
                {
                    echo "0 results";
                }

?>