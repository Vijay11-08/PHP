<?php
echo "<h1>01. Syntax & Comments</h1>";
echo "<a href='index.php'>Back to Index</a><hr>";

// ==========================================
// PHP SYNTAX & COMMENTS
// ==========================================

echo "<h2>1. Standard PHP Tags</h2>";
echo "PHP code is written between <code>&lt;?php</code> and <code>?&gt;</code> tags.<br>";
echo "If a file contains only PHP code, closing tag is optional (and recommended to omit).<br>";

echo "<h2>2. Case Sensitivity</h2>";
echo "<p>KEYWORDS (if, else, while, echo) are NOT case-sensitive.</p>";
ECHO "This works same as 'echo'<br>";
eChO "This also works<br>";

echo "<p>VARIABLES names ARE case-sensitive.</p>";
$color = "red";
echo "Color is $color<br>";
// echo "Color is $Color"; // Warning: Undefined variable $Color

echo "<h2>3. Comments</h2>";

// This is a single-line comment using double slashes

# This is a single-line comment using hash symbol

/*
   This is a multi-line comment block
   It can span multiple lines.
   Useful for temporarily disabling large chunks of code
   or writing detailed explanations.
*/

echo "Comments are not executed by the server.<br>";

echo "<h2>4. Statements</h2>";
echo "Statements must end with a semicolon (;).<br>";
$x = 5; 
$y = 10;
echo "x is $x and y is $y";
?>
