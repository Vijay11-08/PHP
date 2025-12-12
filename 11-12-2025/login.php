<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login Page</h1>
    <p>This is the login page</p>

    <form action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
    <?php
// using register table fill login form 
$login="select * from register where username='$_GET[username]' and password='$_GET[password]'";
$result=mysqli_query($con,$login);
if(mysqli_num_rows($result)>0)
{
    echo "login successful";
}
else
{
    echo "invalid username or password";
}   
?> 


</body>
</html>