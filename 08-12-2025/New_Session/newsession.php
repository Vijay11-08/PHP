<?php

//start session
session_start();

?>



<?php

$_SESSION["sname"] = "Vijay";

$_SESSION["srollno"] = "1";

echo 'The Name of the student is :' . $_SESSION["sname"] . '<br>';

echo 'The Roll number of the student is :' . $_SESSION["srollno"] . '<br>';

?>

<h1> Session in PHP </h1>

<li>A session is a way to store information (in variables) to be used across multiple pages.</li>
<li> In Session, the information is stored on the server.</li>
<li>When you work with an application, you open it, do some changes, and then you close it. This is much like a Session.</li>
<li>HTTP is stateless so will not store this type of information.</li>
<li>To store this type of information you may require a session.</li>
<li>Session variables hold information about one single user, and are available to all pages in one application.</li>
<li>session information is temporary and will be deleted after the user has left the website.</li>

<li>There are two steps to create a session.</li>

<h2>1.Starting a PHP Session</h2>
<li>Before you can store user information in your PHP session, you must first start up the session.</li>
<li>The session_start( ) function must appear BEFORE the <html> tag:</li>   

<h2>2.Storing a Session Variable</h2>
<li>Session data in key-value pairs using the $_SESSION[ ] superglobal array.</li>
<li>The stored data can be accessed during the lifetime of a session.</li>
