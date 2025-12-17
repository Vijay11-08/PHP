<?php
echo "<h1>14. OOP Advanced</h1>";
echo "<a href='index.php'>Back to Index</a><hr>";

echo "<h2>1. Inheritance</h2>";
class Fruit {
  public $name;
  public $color;
  public function __construct($name, $color) {
    $this->name = $name;
    $this->color = $color;
  }
  public function intro() {
    echo "The fruit is {$this->name} and the color is {$this->color}.<br>";
  }
}

// Strawberry inherits from Fruit
class Strawberry extends Fruit {
  public function message() {
    echo "Am I a fruit or a berry? <br>";
  }
}

$berry = new Strawberry("Strawberry", "red");
$berry->message();
$berry->intro();

echo "<h2>2. Overriding Inherited Methods</h2>";
// Final keyword prevents overriding or inheritance (final class ... or final public function ...)

echo "<h2>3. Class Constants</h2>";
class Goodbye {
  const LEAVING_MESSAGE = "Thank you for visiting W3Schools.com!";
}
echo Goodbye::LEAVING_MESSAGE . "<br>";

echo "<h2>4. Abstract Classes</h2>";
echo "Abstract classes cannot be instantiated, only inherited. They must contain at least one abstract method.<br>";

abstract class Car {
  public $name;
  public function __construct($name) {
    $this->name = $name;
  }
  abstract public function intro() : string;
}

class Audi extends Car {
  public function intro() : string {
    return "Choose German quality! I'm an $this->name!";
  }
}

$audi = new Audi("Audi");
echo $audi->intro() . "<br>";


echo "<h2>5. Interfaces</h2>";
echo "Interfaces specify what methods a class MUST implement.<br>";

interface Animal {
  public function makeSound();
}

class Cat implements Animal {
  public function makeSound() {
    echo "Meow <br>";
  }
}

$myCat = new Cat();
$myCat->makeSound();

echo "<h2>6. Traits</h2>";
echo "Traits are used to declare methods that can be used in multiple classes.<br>";

trait message1 {
  public function msg1() {
      echo "OOP is fun! ";
  }
}

class Welcome {
  use message1;
}

$obj = new Welcome();
$obj->msg1();
echo "<br>";

echo "<h2>7. Static Methods/Properties</h2>";
class pi {
  public static $value = 3.14159;
  public static function welcome() {
    echo "Hello World Static!";
  }
}

// Call without creating an instance
echo "Static Value: " . pi::$value . "<br>";
pi::welcome();
?>
