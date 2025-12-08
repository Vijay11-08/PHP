<h1>$_REQUEST</h1>
<li>$_REQUEST is a PHP super global variable which is used to collect data after submitting an HTML form.</li>
<li>$_REQUEST can collect data sent by both GET and POST methods.</li>  
<li>PHP $_REQUEST is a PHP super global variable which is used to collect data after submitting an HTML form.</li>
<li>In PHP, the $_REQUEST superglobal is an associative array that contains the contents of $_GET, $_POST, and $_COOKIE by default.</li>
<li>It allows you to access request data without explicitly specifying the request method.</li>
<li>$_GET: Contains data sent via URL parameters.</li>
<li>$_POST: Contains data sent via HTTP POST method.</li>
<li>$_COOKIE: Contains data sent via cookies.</li>
<li>$_REQUEST merges these three arrays, giving you a single array to access data from GET, POST, and COOKIE requests.</li>
<li>However, relying on $_REQUEST can be less secure and harder to debug compared to using $_GET, $_POST, and $_COOKIE directly.</li>

<br>
<br>

<html>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Name: <input type="text" name="fname">
      <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $name = $_REQUEST['fname'];

  if (empty($name)) {
    echo "Name is empty";
  } else {
    echo $name;
  }
}
?>

</body>
</html>