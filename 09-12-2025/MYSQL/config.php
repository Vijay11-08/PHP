<!-- config.php -->

<!-- Open a Connection to MySQL -->

<?php

//MySQLi Object-oriented
$servername="localhost";
$username="root";
$password="";

    //create connection
    $con=new mysqli($servername,$username,$password);
    
    //check connection
    if(mysqli_connect_error())
    {
        die("Database connection failed:".mysqli_connect_error());
    }
    else
    {
        echo "Connection Done" . "<br>";
    }