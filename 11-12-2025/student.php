<?php include 'header.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
</head>
<body>
    
    <h1>Student</h1>
    <p>This is the student page</p>

    <!-- //create student table for insert value in This using html FROM -->
    <form action="insertdata.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="branch">Branch:</label>
        <input type="text" id="branch" name="branch"><br><br>
        <label for="department">Department:</label>
        <input type="text" id="department" name="department"><br><br>
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject"><br><br>
        <label for="roll">Roll:</label>
        <input type="text" id="roll" name="roll"><br><br>
        <input type="submit" value="Submit">
    </form>
   

    
    
    <!-- //add data in database show array_fill -->

    <?php
    // fetch student  data in table formate
    $con = new mysqli("localhost","root","","school");
    $sql = "SELECT * FROM student";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. "<br>";
            echo "name: " . $row["name"]. "<br>";
            echo "branch: " . $row["branch"]. "<br>";
            echo "department: " . $row["department"]. "<br>";
            echo "subject: " . $row["subject"]. "<br>";
            echo "roll: " . $row["roll"]. "<br>";
        }
    } else {
        echo "0 results";
    }
       
    ?>

</body>
</html>

<?php include 'footer.php'; ?>
