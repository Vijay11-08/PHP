<?php

include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register Page</h1>
    <p>This is the register page</p>

    <form action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Register">
    </form>

    <?php
    // data insert in database show table formate
    $insert="insert into register(username,email,password) values('$_GET[username]','$_GET[email]','$_GET[password]')";
    if(mysqli_query($con,$insert))
    {
        echo "data inserted successfully";
    }
    else
    {
        echo "data not inserted";
    }

?>
    
</body>
</html>