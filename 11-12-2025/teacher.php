<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
</head>
<body>
    
    <h1>Teacher</h1>
    <p>This is the teacher page</p>
    
    //create teacher table for insert value in This using html FROM
    <form action="insertdata.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="department">Department:</label>
        <input type="text" id="department" name="department"><br><br>
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject"><br><br>
        <label for="salary">Salary:</label>
        <input type="text" id="salary" name="salary"><br><br>
        <input type="submit" value="Submit">
    </form>

    // show teacher table data

    <?php
    
// $sql = "CREATE TABLE teacher (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(30) NOT NULL,
//     department VARCHAR(30) NOT NULL,
//     subject VARCHAR(30) NOT NULL,
//     salary INT(6) NOT NULL
// )";

// there are in table formate shows

    $con = new mysqli("localhost","root","","school");

    $sql = "SELECT * FROM teacher";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. "<br>";
            echo "name: " . $row["name"]. "<br>";
            echo "department: " . $row["department"]. "<br>";
            echo "subject: " . $row["subject"]. "<br>";
            echo "salary: " . $row["salary"]. "<br>";
        }
    } else {
        echo "0 results";
    }
    ?>
    
    
</body>
</html>

<?php include 'footer.php'; ?>