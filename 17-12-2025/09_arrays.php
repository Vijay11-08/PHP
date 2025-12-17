<?php
echo "<h1>09. Arrays & Array Functions</h1>";
echo "<a href='index.php'>Back to Index</a><hr>";

echo "<h2>1. Indexed Arrays</h2>";
$cars = array("Volvo", "BMW", "Toyota");
echo "I like " . $cars[0] . ", " . $cars[1] . " and " . $cars[2] . ".<br>";
echo "Count: " . count($cars) . "<br>";

echo "<h2>2. Associative Arrays</h2>";
$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
echo "Peter is " . $age['Peter'] . " years old.<br>";

echo "<h2>3. Multidimensional Arrays</h2>";
$carsMatrix = array (
  array("Volvo",22,18),
  array("BMW",15,13),
  array("Saab",5,2),
  array("Land Rover",17,15)
);
echo $carsMatrix[0][0] . ": In stock: " . $carsMatrix[0][1] . ", sold: " . $carsMatrix[0][2] . ".<br>";

echo "<h2>4. Sorting Arrays</h2>";
$numbers = array(4, 6, 2, 22, 11);
sort($numbers);
echo "Sorted Ascending: "; print_r($numbers); echo "<br>";

rsort($numbers);
echo "Sorted Descending: "; print_r($numbers); echo "<br>";

$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
asort($age);
echo "Sorted by Value (asort): "; print_r($age); echo "<br>";
ksort($age);
echo "Sorted by Key (ksort): "; print_r($age); echo "<br>";

echo "<h2>5. Important Array Functions</h2>";
$a1 = array("red", "green");
$a2 = array("blue", "yellow");

echo "<b>array_merge():</b> ";
print_r(array_merge($a1, $a2));
echo "<br>";

echo "<b>array_push():</b> ";
array_push($a1, "blue", "yellow");
print_r($a1);
echo "<br>";

echo "<b>array_pop():</b> ";
$popped = array_pop($a1);
echo "Popped '$popped', now: "; print_r($a1);
echo "<br>";

echo "<b>in_array():</b> ";
echo in_array("red", $a1) ? "Found red" : "Red not found";
echo "<br>";
?>
