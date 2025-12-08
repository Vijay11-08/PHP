<h1>$GLOBALS</h1>
<li>PHP super global variable which is used to access global variables from anywhere in the PHP script.</li>
<li>PHP stores all super global variables in an array.</li>
<li>For $GLOBALS use $GLOBALS[index].</li>
<li>The index holds the name of the variable.</li>

<h3>Output Of $GLOBALS</h3>
<?php

$x=25;
$y=25;

function addition()
{
    $GLOBALS['z']=$GLOBALS['x']+$GLOBALS['y'];
}
addition();

echo "Addition of two numbers=" . $z;
echo "<pre>";
print_r($GLOBALS);
echo "<pre>";

?>