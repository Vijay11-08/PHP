<!-- update.php -->

<?php
include_once 'config.php';
$id = $_GET['id']; 
$sqlselect = ("SELECT * FROM student WHERE id='".$id."'");
$result = $conn->query($sqlselect);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Student Information</title>
</head>
<body>
<h1 align="center"><u>Update Student Information</h1></u>
<fieldset style="width:30%;margin: auto;">
	<legend>Student Registration</legend>
	<form  action="update_record.php" name="sform" method="POST">
		<table cellpadding="5px" cellspacing="3px" align="center" border="1">
			<tr>
				<th colspan="3"><h2>Personal Information</h2></th>
			</tr>
			<tr>
				<td>ID</td>
				<td>:</td>
				<td><input type="hidden" name="id" placeholder="Enter ID" value="<?php echo $id;?>"></td>
			</tr>
			<tr>
				<td>First Name</td>
				<td>:</td>
				<td><input type="text" name="fname" placeholder="Update your First Name" value="<?php echo $row['fname'];?>"></td>
			</tr>
			<tr>
				<td>Last Name</td>
				<td>:</td>
				<td><input type="text" name="lname" placeholder="Update your Last Name" value="<?php echo $row['lname'];?>"></td>
			</tr>
			<tr>
			<td colspan="3" align="center">
			<input type="submit" name="submit" value="Update Student">
		</td>
	</tr>
</table>
</form>
</fieldset>
</body>
</html>