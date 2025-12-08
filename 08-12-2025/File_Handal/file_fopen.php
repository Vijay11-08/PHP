<!-- file_fopen.php -->
<html>
<head>
<title>File with PHP</title>
</head>
<body>

<h1>This is my File PHP program</h1>

<?php

    $file = fopen("myfile.txt", "r") or die("Unable to open file.");

    echo "<pre>";

    echo fread($file,filesize("myfile.txt"));

    echo "</pre>";
    fclose($file);

?>

</body>
</html>