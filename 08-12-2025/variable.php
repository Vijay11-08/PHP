<?php
// Variable types in PHP

// PHP is loosely typed, which means we don’t have to explicitly state the type of variable.
// variable starts with the $ sign, followed by the name of the variable.
// A variable name cannot start with a number.
// Variable names are case-sensitive.
?>

<h1>Scope of  Variables</h1>

<ul>Local Variable</ul>
<?php
# Local Variable
# A variable declared within a function has a LOCAL SCOPE and can only be accessed within that function.
function myTest() {
    $x = 10; // local scope
    echo "<p>Local Variable is: $x</p>";
}
myTest();
?>



<ul>Global Variable</ul>
<?php
# Global Variable
# A variable declared outside a function has a GLOBAL SCOPE and can be accessed from anywhere outside or inside the function
$x=10;
function myfunction()
{
  //echo "X is not accessible inside function $x";
}
myfunction();
echo "X is accessible outside function $x";
echo "<br>";
# The global keyword and $GLOBALS super global variables imports variables from the global scope into the local scope of a function.
$x = 5;
$y = 5;
function add()
{
  global $x;
  global $y;
  return $x + $y;
}
echo "$x + $y =" . add();
?>
<br>


<ul>Static Variable</ul>
<?php
# Static Variable
# A static variable exists only in a local function scope, but it does not lose its value when program execution leaves this scope.
function mytest1()
{
    static $x=0;
    echo $x . "<br>";
    $x++;
}
mytest1( );  //first function
mytest1( );
mytest1( );
?>


