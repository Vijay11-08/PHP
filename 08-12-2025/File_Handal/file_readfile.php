<!-- file_readfile.php -->
<html>
<head>
<title>File with PHP</title>
</head>
<body>

<h1>This is my File PHP program</h1>

<?php

    echo "<pre>";
    echo readfile("myfile.txt");
    echo "</pre>";

?>

</body>
</html>