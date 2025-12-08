<?php
setcookie("c_name","House",time() + 60)
?>

<html>
<head>
<title>Cookie in PHP</title>
</head>
<body>
<h1>This is my cookie PHP program</h1>

<?php
if (isset($_COOKIE["c_name"]))
{   
    echo "cookie is created with value " .$_COOKIE["c_name"];  
}
else
{    
    echo "cookie is not set";  
}

//we have to reload the page to see the value of the cookie.

?>

</body>
</html>