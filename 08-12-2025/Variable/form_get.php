<h1>$_GET</h1>
<li>$_GET method is used to collect form data after submitting an HTML form with method="get".
<li>GET should NEVER be used for sending passwords, uploading files or other sensitive information.</li>
<li>In above S_POST example, replace S_POST with $_GET and replace method = get..</li>
<li>$_GET is widely used for sending non-sensitive data.</li>
<li>Information sent from a form with the GET method is visible to everyone (all variable names and values are displayed in the URL).</li>

<br><br><br>

<html>
<body>
<form action="welcome_get.php" method="get">

Name: <input type="text" name="name"><br><br>

E-mail: <input type="text" name="email"><br><br>

<input type="submit">
</form>
</body>
</html>


