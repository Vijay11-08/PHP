<?php
echo "<h1>02. Variables & Constants</h1>";
echo "<a href='index.php'>Back to Index</a><hr>";

// ==========================================
// VARIABLES
// ==========================================
echo "<h2>1. Defining Variables</h2>";
echo "Variables start with a $ signs, followed by the name.<br>";
echo "Rules: <br>";
echo "- Start with letter or underscore (_)<br>";
echo "- Cannot start with a number<br>";
echo "- Alpha-numeric characters and underscores (A-z, 0-9, _)<br>";

$txt = "Hello World!";
$x = 5;
$y = 10.5;

echo "Text: $txt <br>";
echo "Integer: $x <br>";
echo "Float: $y <br>";

// ==========================================
// VARIABLE SCOPE
// ==========================================
echo "<h2>2. Variable Scope</h2>";

$globalVar = 100; // Global Scope

function myApp() {
    // echo $globalVar; // This would cause an error because it's not imported
    global $globalVar; // KEYWORD 'global' brings it into local scope
    echo "Inside Function (Global accessed): $globalVar <br>";
    
    $localVar = "I am local";
    echo "Inside Function (Local): $localVar <br>";
}
myApp();

// $localVar is not accessible here
echo "Outside Function (Global): $globalVar <br>";

echo "<h3>Static Keyword</h3>";
function countCalls() {
    static $count = 0; // Initialized only once
    $count++;
    echo "Function called $count times.<br>";
}

countCalls();
countCalls();
countCalls();

// ==========================================
// VARIABLE VARIABLES
// ==========================================
echo "<h2>3. Variable Variables</h2>";
$a = "hello";
$$a = "world"; // Creates a variable named $hello

echo "$a ${$a} <br>"; // Outputs: hello world
echo "$a $hello <br>"; // Outputs: hello world

// ==========================================
// CONSTANTS
// ==========================================
echo "<h2>4. Constants</h2>";
echo "Constants are global constants that cannot be changed once defined.<br>";

define("GREETING", "Welcome to PHP Basic Learning!");
echo GREETING . "<br>";

echo "<b>Constant Arrays (PHP 7+):</b><br>";
define("CARS", [
  "Alfa Romeo",
  "BMW",
  "Toyota"
]);
echo CARS[0] . "<br>";

echo "<b>Magic Constants:</b><br>";
echo "Current Line: " . __LINE__ . "<br>";
echo "Current File: " . __FILE__ . "<br>";
echo "Current Dir: " . __DIR__ . "<br>";
?>
