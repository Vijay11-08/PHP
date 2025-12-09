<!-- read.php -->

<html>
<head>
    <style>
		table
		{
		border-style:solid;
		border-width:2px;
		border-color:pink;
		text-align: center;
		}
    </style>
</head>
<body bgcolor="#EEFDEF">
<center>
<?php
include_once 'config.php';
//select data from table
$sqlselect = "SELECT * FROM student";
$result = $conn->query($sqlselect);
//if ($result->num_rows > 0) 
//{
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
       echo $row["id"] . " - " . $row["fname"]. " " . $row["lname"]. "<br>";
    }
//} else
//{
  //  echo "0 results";
//}
?>
</center>
</body>
</html>