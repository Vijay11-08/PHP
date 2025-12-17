<?php
echo "<h1>10. Superglobals</h1>";
echo "<a href='index.php'>Back to Index</a><hr>";

echo "Superglobals are built-in variables that are always available in all scopes.<br>";

echo "<h2>1. \$_SERVER</h2>";
echo "Holds information about headers, paths, and script locations.<br>";
echo "Server Name: " . $_SERVER['SERVER_NAME'] . "<br>";
echo "Global Host: " . $_SERVER['HTTP_HOST'] . "<br>";
echo "Script Name: " . $_SERVER['SCRIPT_NAME'] . "<br>";

echo "<h2>2. \$_REQUEST / \$_POST / \$_GET</h2>";
echo "Used to collect data after submitting an HTML form.<br>";

?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name: <input type="text" name="fname">
  <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $name = htmlspecialchars($_REQUEST['fname']);
  if (empty($name)) {
    echo "Name is empty <br>";
  } else {
    echo "Hello $name! <br>";
  }
}

echo "<h2>3. \$_SESSION</h2>";
// Session must be started before using it
// session_start(); 
echo "Sessions are used to store information across multiple pages (e.g. user login status).<br>";
echo "Usage: \$_SESSION['username'] = 'Vijay';<br>";

echo "<h2>4. \$_COOKIE</h2>";
echo "Cookies are small files that the server embeds on the user's computer.<br>";
echo "Usage: setcookie(name, value, expire, path, domain, secure, httponly);<br>";
?>
