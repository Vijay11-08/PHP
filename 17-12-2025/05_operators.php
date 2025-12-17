<?php
echo "<h1>05. Operators</h1>";
echo "<a href='index.php'>Back to Index</a><hr>";

$x = 10; 
$y = 3;

echo "<h2>1. Arithmetic Operators</h2>";
echo "$x + $y = " . ($x + $y) . " (Addition)<br>";
echo "$x - $y = " . ($x - $y) . " (Subtraction)<br>";
echo "$x * $y = " . ($x * $y) . " (Multiplication)<br>";
echo "$x / $y = " . ($x / $y) . " (Division)<br>";
echo "$x % $y = " . ($x % $y) . " (Modulus/Remainder)<br>";
echo "$x ** $y = " . ($x ** $y) . " (Exponentiation)<br>";

echo "<h2>2. Assignment Operators</h2>";
$a = 10;
echo "Start: $a <br>";
$a += 5;
echo "After += 5: $a <br>";

echo "<h2>3. Comparison Operators</h2>";
$val1 = 100;
$val2 = "100";

echo "100 == 100? "; var_dump($val1 == 100); echo "<br>";
echo "100 == '100'? "; var_dump($val1 == $val2); echo " (Equal value)<br>";
echo "100 === '100'? "; var_dump($val1 === $val2); echo " (Identical types?)<br>";
echo "10 != 5? "; var_dump(10 != 5); echo "<br>";
echo "10 > 5? "; var_dump(10 > 5); echo "<br>";

echo "<h3>Spaceship Operator (<=>)</h3>";
echo "Returns 0 if equal, 1 if greater, -1 if less.<br>";
echo "5 <=> 10: " . (5 <=> 10) . "<br>";
echo "10 <=> 10: " . (10 <=> 10) . "<br>";
echo "15 <=> 10: " . (15 <=> 10) . "<br>";

echo "<h2>4. Logical Operators</h2>";
$t = true; $f = false;
echo "True AND False (&&): "; var_dump($t && $f); echo "<br>";
echo "True OR False (||): "; var_dump($t || $f); echo "<br>";
echo "NOT True (!): "; var_dump(!$t); echo "<br>";

echo "<h2>5. String Operators</h2>";
$txt1 = "Hello";
$txt2 = " world!";
echo "Concatenation (.): " . $txt1 . $txt2 . "<br>";
$txt1 .= $txt2;
echo "Concatenation Assignment (.=): " . $txt1 . "<br>";

echo "<h2>6. Array Operators</h2>";
$arr1 = ["a" => "red", "b" => "green"];
$arr2 = ["c" => "blue", "d" => "yellow"];
$arr3 = $arr1 + $arr2; // Union
echo "Union (+): "; print_r($arr3); echo "<br>";
?>
