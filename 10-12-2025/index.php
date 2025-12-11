<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    
    <!-- i want to show both table data in table formate -->
    <form method="post">
        <input type="submit" name="student" value="Student Add">
        <input type="submit" name="teacher" value="Teacher Add">
    </form>

    <!-- student table data -->
    
    
    <?php
    
        if(isset($_POST['student']))
        {
            header("Location: student.php");
        }
        if(isset($_POST['teacher']))
        {
            header("Location: teacher.php");
        }
    ?>
    
</body>
</html>


<?php include 'footer.php'; ?>