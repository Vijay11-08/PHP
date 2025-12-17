<?php
declare(strict_types=0); // 1 = rigorous checking, 0 = weak (default)
echo "<h1>08. Functions</h1>";
echo "<a href='index.php'>Back to Index</a><hr>";

echo "<h2>1. Creating a Function</h2>";
function writeMsg() {
  echo "Hello world!<br>";
}
writeMsg(); // Call the function

echo "<h2>2. Function Arguments</h2>";
function familyName($fname, $year) {
  echo "$fname Refsnes. Born in $year <br>";
}

familyName("Hege", "1975");
familyName("Stale", "1978");

echo "<h2>3. Default Argument Value</h2>";
function setHeight($minheight = 50) {
  echo "The height is : $minheight <br>";
}
setHeight(350);
setHeight(); // Uses default 50

echo "<h2>4. Rerturning Values</h2>";
function sum($x, $y) {
  $z = $x + $y;
  return $z;
}

echo "5 + 10 = " . sum(5, 10) . "<br>";

echo "<h2>5. Pass by Reference</h2>";
function addFive(&$value) {
  $value += 5;
}
$num = 2;
addFive($num);
echo "Num is now: $num (Should be 7)<br>";

echo "<h2>6. Type Hinting (Scalar Types)</h2>";
// Requires declare(strict_types=1) to be strict, otherwise PHP coerces
function addNumbers(int $a, int $b) : int {
  return $a + $b;
}
echo "addNumbers(5, 5) = " . addNumbers(5, 5) . "<br>";

echo "<h2>7. Variadic Functions</h2>";
function sumMyNumbers(...$x) {
  $n = 0;
  $len = count($x);
  for($i = 0; $i < $len; $i++) {
    $n += $x[$i];
  }
  return $n;
}
echo "Sum of 1, 2, 3, 4, 5, 6 is: " . sumMyNumbers(1, 2, 3, 4, 5, 6) . "<br>";

echo "<h2>8. Arrow Functions (PHP 7.4+)</h2>";
$y = 1; 
$fn1 = fn($x) => $x + $y;
echo $fn1(5); // Output: 6
?>
