<?php
echo "<h1>13. OOP Basics</h1>";
echo "<a href='index.php'>Back to Index</a><hr>";

echo "<h2>1. Classes and Objects</h2>";
class Fruit {
  // Properties
  public $name;
  public $color;

  // Methods
  function set_name($name) {
    $this->name = $name;
  }
  function get_name() {
    return $this->name;
  }
}

$apple = new Fruit();
$apple->set_name('Apple');
$banana = new Fruit();
$banana->set_name('Banana');

echo "Object 1: " . $apple->get_name() . "<br>";
echo "Object 2: " . $banana->get_name() . "<br>";
echo "Instance of Fruit? " . ($apple instanceof Fruit ? "Yes" : "No") . "<br>";

echo "<h2>2. Constructor & Destructor</h2>";
class Car {
  public $name;
  public $color;

  // Constructor
  function __construct($name, $color) {
    $this->name = $name;
    $this->color = $color;
    echo "Constructor called for $name.<br>";
  }
  
  // Destructor
  function __destruct() {
    echo "Destructor: The car is {$this->name}.<br>";
  }
}

$volvo = new Car("Volvo", "Black");
echo "Car created: " . $volvo->name . "<br>";

echo "<h2>3. Access Modifiers</h2>";
class Person {
  public $name;       // Accessible from anywhere
  protected $age;     // Accessible within class and derived classes
  private $salary;    // Accessible ONLY within the class

  function __construct($n, $a, $s) {
    $this->name = $n;
    $this->age = $a;
    $this->salary = $s;
  }

  public function getDetails() {
    return "$this->name is $this->age years old.";
  }
}

$p = new Person("Vijay", 25, 5000);
echo "Name (Public): " . $p->name . "<br>";
echo "Function (Public): " . $p->getDetails() . "<br>";
// echo $p->age; // Error
// echo $p->salary; // Error

?>
