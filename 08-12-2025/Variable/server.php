<h1>$_SERVER</h1>
<li>$_SERVER is a PHP super global variable which holds information about servers like headers, paths, script locations, server name etc..</li>



<?php

echo $_SERVER['PHP_SELF'];
echo "<br>";

echo $_SERVER['SERVER_NAME'];
echo "<br>";

echo $_SERVER['HTTP_HOST'];
echo "<br>";

echo $_SERVER['HTTP_REFERER'];
echo "<br>";

echo $_SERVER['HTTP_USER_AGENT'];
echo "<br>";

echo $_SERVER['SCRIPT_NAME'];
echo "<pre>";

print_r($_SERVER);
echo "<pre>";
?>