<?php
echo "<h1>12. JSON Handling</h1>";
echo "<a href='index.php'>Back to Index</a><hr>";

echo "<h2>1. json_encode()</h2>";
echo "Converts an array/object into a JSON string.<br>";

$age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);
$jsonObj = json_encode($age);
echo "PHP Array: "; print_r($age); echo "<br>";
echo "JSON String: " . $jsonObj . "<br>";

echo "<h2>2. json_decode()</h2>";
echo "Converts a JSON string into a PHP object or array.<br>";

$jsonBase = '{"Peter":35,"Ben":37,"Joe":43}';
echo "Source JSON: $jsonBase <br>";

echo "<b>Decode to Object (default):</b><br>";
$obj = json_decode($jsonBase);
echo "Peter's Age: " . $obj->Peter . "<br>";
var_dump($obj); 
echo "<br>";

echo "<b>Decode to Associative Array (2nd arg true):</b><br>";
$arr = json_decode($jsonBase, true);
echo "Peter's Age: " . $arr['Peter'] . "<br>";
var_dump($arr);
echo "<br>";

echo "<h2>3. Accessing Values</h2>";
echo "From Object: \$obj->Ben = " . $obj->Ben . "<br>";
echo "From Array: \$arr['Ben'] = " . $arr['Ben'] . "<br>";
?>
