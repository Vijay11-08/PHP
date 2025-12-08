<h1>Data Types</h1>
<li>String</li>
<li>Integer</li>
<li>Float</li>
<li>Boolean</li>
<li>Array</li>
<li>Object</li>

<!-- -------------------------------------------------------------------------- -->

<h3>Output Of Data Types</h3>
<?php
    //data types in PHP
$a = 10;               // integer
$b = 10.5;             // float
$c = "Hello World";    // string
$d = true;             // boolean
$e = array("Apple", "Banana", "Orange"); // array
class Car {             // object
    function Car() {
        $this->model = "BMW";
    }
}
$f = new Car();        // creating an object of the class Car

echo "Integer: " . $a . "<br>";
echo "Float: " . $b . "<br>";
echo "String: " . $c . "<br>";
echo "Boolean: " . $d . "<br>";
echo "Array: " . implode(separator: ", ", array: $e) . "<br>";
?>

<!-- -------------------------------------------------------------------------- -->

<h1>Data Types – Array</h1>
<li>Indexed arrays</li>
<li>Associative arrays</li>
<li>Multidimensional arrays</li>
<br>

<!-- -------------------------------------------------------------------------- -->


<h3>Output Of Arrays</h3>
<?php

echo "<h4>Indexed Array</h4>";
$fruit = array("Banana","Apple","Orange","Watermelon");
echo "I like " . $fruit[0] . ", ".
               $fruit[1] . ", " .
               $fruit[2] . ", " ."and ".
               $fruit[3] ;


echo "<br><h4>Associative Array</h4>";
$number=array("number1"=>"10","number2"=>"20","number3"=>"30");
echo "1 represents with " . $number["number1"]. "<br>" .
     "2 represents with " . $number["number2"] . "<br>".
     "3 represents with " . $number["number3"];


echo "<br><h4>Multidimensional Array</h4>";
$cars = array(
  array("Volvo",22,18),
  array("BMW",15,13),
  array("Saab",5,2),
  array("Land Rover",17,15));
echo $cars[0][0] . ": In stock: " . $cars[0][1] . ", sold: " . $cars[0][2] . ".<br>";
echo $cars[1][0] . ": In stock: " . $cars[1][1] . ", sold: " . $cars[1][2] . ".<br>";
echo $cars[2][0] . ": In stock: " . $cars[2][1] . ", sold: " . $cars[2][2] . ".<br>";
echo $cars[3][0] . ": In stock: " . $cars[3][1] . ", sold: " . $cars[3][2] . ".<br>";

?>


<h1>Sort Functions For Arrays</h1>

<li>sort() - sort arrays in ascending order</li>
<li>rsort() - sort arrays in descending order</li>
<li>asort() - sort associative arrays in ascending order, according to the value</li>
<li>ksort() - sort associative arrays in ascending order, according to the key</li>
<li>arsort() - sort associative arrays in descending order, according to the value</li>
<li>krsort() - sort associative arrays in descending order, according to the key</li>

<h3>Output Of Sort Functions For Arrays</h3>
<?php

$fruits = array("Banana", "Apple", "Orange", "Mango");

sort(array: $fruits);
echo "Sorted fruits in ascending order: " . implode(", ", $fruits) . "<br>";

rsort(array: $fruits);
echo "Sorted fruits in descending order: " . implode(", ", $fruits) . "<br>";


$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");

asort(array: $age);
echo "Sorted age in ascending order by value: ";
foreach($age as $x => $x_value) {
  echo $x . "=" . $x_value . ", ";
}

echo "<br>";

ksort(array: $age);
echo "Sorted age in ascending order by key: ";
foreach($age as $x => $x_value) {
  echo $x . "=" . $x_value . ", ";
}

echo "<br>";

arsort(array: $age);
echo "Sorted age in descending order by value: ";
foreach($age as $x => $x_value) {
  echo $x . "=" . $x_value . ", ";
}

echo "<br>";

krsort(array: $age);
echo "Sorted age in descending order by key: ";
foreach($age as $x => $x_value) {
    echo $x . "=" . $x_value . ", ";
    }

?>

