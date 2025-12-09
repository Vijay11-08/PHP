<!-- index.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Student Registation Form</title>
	<style type="text/css">
	a{text-decoration: none;}
	</style>
</head>
<body>
<center>
<h1 align="center"><u>Student Registartion</h1></u>
<fieldset style="width:30%;margin: auto;">
	<legend>Student Registration</legend>
	<form  action="insert.php" name="sform" method="POST">
		<table cellpadding="5px" cellspacing="3px" align="center" border="1">
			<tr>
				<th colspan="3"><h2>Personal Information</h2></th>
			</tr>
			<tr>
				<td>ID</td>
				<td>:</td>
				<td><input type="text" name="id" placeholder="Enter ID"></td>
			</tr>
			<tr>
				<td>First Name</td>
				<td>:</td>
				<td><input type="text" name="fname" placeholder="Enter your First Name"></td>
			</tr>
			<tr>
				<td>Last Name</td>
				<td>:</td>
				<td><input type="text" name="lname" placeholder="Enter your Last Name"></td>
			</tr>
			<tr>
 			<td colspan="3" align="center">
 			<input type="Submit" value="Submit" name="insert"/>
 			</td>
		</tr>
</table>
</form>
</fieldset>
<br>
<h2>List of Student Information</h2>
<?php
include_once 'config.php';
$sqlselect = "SELECT id, fname, lname FROM student";
$result = $conn->query($sqlselect);
echo "<table border='1'><tr><th>ID</th><th>FIRST NAME</th><th>LAST NAME</th><th>UPDATE RECORD</th>
<th>DELETE RECORD</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
	 	 echo "<tr>";
	 	 echo "<td align='center'>" . $row['id'] . "</td>";
		 echo "<td align='center'>" . $row['fname'] . "</td>";
		 echo "<td align='center'>" . $row['lname'] . "</td>";
		 echo "<td align='center'><a href=\"update.php ? id=".$row['id'] ."\"><input type='submit' value='UPDATE' name='update'></a></td>";
		 echo "<td align='center'><a href=\"delete.php ? id=".$row['id']."\"><input type='submit' value='DELETE' name='delete'></a></td>";
		 echo "</tr>";
	 }
?>
</center> 
</body>
</html>