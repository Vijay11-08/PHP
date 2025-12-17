<?php
echo "<h1>03. Data Types</h1>";
echo "<a href='index.php'>Back to Index</a><hr>";

echo "<h2>PHP Data Types</h2>";
echo "Variables can store data of different types. PHP supports the following data types:<br>";
echo "<ul>
    <li>String</li>
    <li>Integer</li>
    <li>Float (floating point numbers - also called double)</li>
    <li>Boolean</li>
    <li>Array</li>
    <li>Object</li>
    <li>NULL</li>
    <li>Resource</li>
</ul>";

// 1. String
$x = "Hello world!";
$y = 'Hello world!';
echo "<h3>1. String</h3>";
var_dump($x);
echo "<br>";

// 2. Integer
$x = 5985;
echo "<h3>2. Integer</h3>";
echo "Decimal: "; var_dump($x); echo "<br>";
$x = -345; // Negative
echo "Negative: "; var_dump($x); echo "<br>";
$x = 0x8C; // Hexadecimal
echo "Hexadecimal: "; var_dump($x); echo "<br>";

// 3. Float
$x = 10.365;
echo "<h3>3. Float</h3>";
var_dump($x);
echo "<br>";

// 4. Boolean
$x = true;
$y = false;
echo "<h3>4. Boolean</h3>";
echo "True: "; var_dump($x); echo "<br>";
echo "False: "; var_dump($y); echo "<br>";

// 5. Array
$cars = array("Volvo","BMW","Toyota");
echo "<h3>5. Array</h3>";
var_dump($cars);
echo "<br>";

// 6. Object
echo "<h3>6. Object</h3>";
class Car {
  public $color;
  public $model;
  public function __construct($color, $model) {
    $this->color = $color;
    $this->model = $model;
  }
  public function message() {
    return "My car is a " . $this->color . " " . $this->model . "!";
  }
}

$myCar = new Car("black", "Volvo");
echo $myCar->message();
echo "<br>";
var_dump($myCar);
echo "<br>";

// 7. NULL
$x = "Hello world!";
$x = null;
echo "<h3>7. NULL</h3>";
echo "Value is cleared.<br>";
var_dump($x);
?>
