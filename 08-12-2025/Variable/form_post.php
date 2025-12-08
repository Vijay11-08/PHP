<h1>$_POST</h1>
<li>PHP $_POST is a PHP super global variable which is used to collect form data after submitting an HTML form with method="post".</li>
<li>$_POST is also widely used to secure variables.</li>

<br>

<html>
<body>
<center>
<form action="welcome.php" method="post">
User Name: <input type="text" name="name1"><br><br>
Password: <input type="password" name="password"><br><br>
<input type="submit" value="Submit">
</form>
</center>
</body>
</html>

<!-- 

welcome.php

<html>
<body>
    Welcome
<?php   
    // echo $_POST["name1"];
?>
<br>
You are successfully logged in.
<br>
</body>
</html> -->