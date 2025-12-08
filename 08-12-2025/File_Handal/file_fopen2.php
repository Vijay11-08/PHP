<!-- file_fopen2.php -->

<html>
<head>
<title>File with PHP</title>
</head>
<body>

<h1>This is my File PHP programs</h1>

<?php

    $fp = fopen("myfile.txt","a+");

    if( $fp == false)
    {
        echo ( "Error in opening file" );
    }
    else
    {
        echo ( "File Open for reading and writing\n" );
    }

    $txt="JS = JavaScript";
    fwrite($fp,$txt);
    fclose($fp);
    echo readfile("myfile.txt");

?>

</body>
</html>



