<?php
/**
 * PHP Deep Dive Documentation & Examples
 * Created: 17-12-2025
 * 
 * This file contains comprehensive examples of PHP concepts from basics to advanced.
 * Run this file in your browser to see the output.
 */

echo "<h1>PHP Comprehensive Documentation</h1>";
echo "<hr>";

// ==========================================
// 1. VARIABLES & CONSTANTS
// ==========================================
echo "<h2>1. Variables & Constants</h2>";

// Rules: Starts with $, case-sensitive, must start with letter or underscore
$stringVar = "Hello World";
$intVar = 42;
$floatVar = 10.5;
$boolVar = true;
$arrayVar = ['Apple', 'Banana'];
$nullVar = null;

// Constants (Global scope, cannot be changed)
define("SITE_NAME", "My PHP Learning");
const PI = 3.14159;

echo "String: $stringVar <br>";
echo "Constant defined with define(): " . SITE_NAME . "<br>";
echo "Constant defined with const: " . PI . "<br>";

// Variable Scope
$globalX = 5; // Global scope

function checkScope() {
    // echo $globalX; // Error: Undefined variable
    global $globalX; // accessing global variable
    echo "Accessing global inside function: $globalX <br>";
    
    static $staticCount = 0; // Persists between calls
    $staticCount++;
    echo "Static Counter: $staticCount <br>";
}

checkScope();
checkScope();

// ==========================================
// 2. DATA TYPES & TYPE CASTING
// ==========================================
echo "<h2>2. Data Types & Casting</h2>";

$x = 5;
var_dump($x); // Check type and value
echo "<br>";

$y = "10";
$z = (int)$y; // Casting string to integer
var_dump($z);
echo "<br>";

// Compound Types: Arrays, Objects
// Special Types: NULL, Resource

// ==========================================
// 3. STRINGS (Deep Dive)
// ==========================================
echo "<h2>3. String Manipulation</h2>";

$text = "The quick brown fox jumps over the lazy dog";
echo "Original: '$text' <br>";
echo "Length (strlen): " . strlen($text) . "<br>";
echo "Word Count (str_word_count): " . str_word_count($text) . "<br>";
echo "Reverse (strrev): " . strrev($text) . "<br>";
echo "Position of 'fox' (strpos): " . strpos($text, "fox") . "<br>";
echo "Replace 'dog' with 'cat' (str_replace): " . str_replace("dog", "cat", $text) . "<br>";
echo "To Upper (strtoupper): " . strtoupper($text) . "<br>";
echo "Substring (substr - start at 4, length 5): " . substr($text, 4, 5) . "<br>";

// Explode & Implode
$csv = "apple,banana,cherry";
$fruitsArray = explode(",", $csv);
echo "Explode CSV to Array: <pre>" . print_r($fruitsArray, true) . "</pre>";
echo "Implode Array to String: " . implode(" | ", $fruitsArray) . "<br>";

// ==========================================
// 4. OPERATORS
// ==========================================
echo "<h2>4. Operators</h2>";

$a = 10;
$b = 3;

echo "Arithmetic: 10 % 3 = " . ($a % $b) . " (Modulus)<br>";
echo "Exponentiation: 10 ** 3 = " . ($a ** $b) . "<br>";

// Comparison (Deep vs Shallow)
$num = 5;
$strNum = "5";
echo "Equal (==): " . ($num == $strNum ? "True" : "False") . " (Values match)<br>";
echo "Identical (===): " . ($num === $strNum ? "True" : "False") . " (Types don't match)<br>";

// Spaceship Operator (<=>) (PHP 7+)
// Returns -1 if less, 0 if equal, 1 if greater
echo "Spaceship (5 <=> 10): " . (5 <=> 10) . "<br>";
echo "Spaceship (10 <=> 10): " . (10 <=> 10) . "<br>";
echo "Spaceship (15 <=> 10): " . (15 <=> 10) . "<br>";

// Null Coalescing (??)
$user = $_GET['user'] ?? 'Guest'; // If $_GET['user'] doesn't exist, use 'Guest'
echo "Current User: $user <br>";

// ==========================================
// 5. CONTROL STRUCTURES
// ==========================================
echo "<h2>5. Control Structures</h2>";

$t = date("H");

if ($t < "10") {
    echo "Have a good morning!";
} elseif ($t < "20") {
    echo "Have a good day!";
} else {
    echo "Have a good night!";
}
echo "<br>";

// Switch
$favColor = "red";
switch ($favColor) {
    case "red":
        echo "Your favorite color is red!";
        break;
    case "blue":
        echo "Your favorite color is blue!";
        break;
    default:
        echo "Your favorite color is neither red nor blue!";
}

// Match Expression (PHP 8.0+) - stricter and returns a value
$status = 200;
$message = match ($status) {
    200 => 'OK',
    400 => 'Bad Request',
    404 => 'Not Found',
    500 => 'Server Error',
    default => 'Unknown Status',
};
echo "<br>Match Expression Result: $message";

// ==========================================
// 6. LOOPS
// ==========================================
echo "<h2>6. Loops</h2>";

echo "<b>For Loop:</b> ";
for ($x = 0; $x <= 5; $x++) {
    echo "$x ";
}
echo "<br>";

echo "<b>Foreach (Associative Array):</b><br>";
$age = ["Peter" => "35", "Ben" => "37", "Joe" => "43"];
foreach ($age as $key => $val) {
    echo "$key = $val<br>";
}

echo "<b>While Loop:</b> ";
$i = 1;
while($i <= 3) {
    echo $i++ . " ";
}
echo "<br>";

// ==========================================
// 7. ARRAYS (Deep Dive)
// ==========================================
echo "<h2>7. Arrays</h2>";

// Multi-dimensional Array
$cars = [
    ["Volvo", 22, 18],
    ["BMW", 15, 13],
    ["Saab", 5, 2],
    ["Land Rover", 17, 15]
];

echo "Row 0: " . $cars[0][0] . ", Stock: " . $cars[0][1] . ", Sold: " . $cars[0][2] . "<br>";

// Useful Array Functions
$numbers = [4, 6, 2, 22, 11];
sort($numbers); // Sort ascending
echo "Sorted Numbers: " . implode(", ", $numbers) . "<br>";

$mapped = array_map(fn($n) => $n * $n, $numbers); // Square each number
echo "Mapped (Squared): " . implode(", ", $mapped) . "<br>";

$filtered = array_filter($numbers, fn($n) => $n > 10); // Keep numbers > 10
echo "Filtered (>10): " . implode(", ", $filtered) . "<br>";

// Merging
$a1 = ['a' => 'red', 'b' => 'green'];
$a2 = ['c' => 'blue', 'b' => 'yellow']; // Key 'b' overwrites in merge
$merged = array_merge($a1, $a2); 
echo "Merged: <pre>" . print_r($merged, true) . "</pre>";

// ==========================================
// 8. FUNCTIONS
// ==========================================
echo "<h2>8. Functions</h2>";

// Strict Types (declare(strict_types=1); must be at top of file to enforce)
// Here we just demo type hinting

function addNumbers(int $a, int $b): int {
    return $a + $b;
}
echo "Type Hinted Add (5 + 10): " . addNumbers(5, 10) . "<br>";

// Pass by Reference (&)
function addFive(&$value) {
    $value += 5;
}
$num = 2;
addFive($num);
echo "Pass by Reference result: $num (should be 7)<br>";

// Variadic Functions (...$nums)
function sumAll(...$nums) {
    return array_sum($nums);
}
echo "Variadic Sum (1, 2, 3, 4): " . sumAll(1, 2, 3, 4) . "<br>";

// Anonymous Functions / Closures
$greet = function($name) {
    echo "Hello $name <br>";
};
$greet("World");

// Arrow Functions (PHP 7.4+)
$multiply = fn($x, $y) => $x * $y;
echo "Arrow Function (10 * 10): " . $multiply(10, 10) . "<br>";

// ==========================================
// 9. SUPERGLOBALS
// ==========================================
echo "<h2>9. Superglobals</h2>";

echo "Server Name: " . $_SERVER['SERVER_NAME'] . "<br>";
echo "Script Filename: " . $_SERVER['SCRIPT_FILENAME'] . "<br>";
echo "User Agent: " . $_SERVER['HTTP_USER_AGENT'] . "<br>";
// $_GET, $_POST, $_SESSION, $_COOKIE are also superglobals used for input/state.

// ==========================================
// 10. OBJECT ORIENTED PROGRAMMING (OOP)
// ==========================================
echo "<h2>10. OOP Deep Dive</h2>";

// Interface
interface Animal {
    public function makeSound();
}

// Abstract Class
abstract class Creature {
    protected $name;
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    abstract public function move();
}

// Trait
trait Logger {
    public function log($msg) {
        echo "[LOG]: $msg <br>";
    }
}

// Class implementing inheritance, interface, and using traits
class Dog extends Creature implements Animal {
    use Logger; // Using the trait
    
    private $breed;
    
    // Constant inside class
    const TYPE = "Mammal";
    
    // Static property
    public static $count = 0;
    
    public function __construct($name, $breed) {
        parent::__construct($name); // Call parent constructor
        $this->breed = $breed;
        self::$count++; // Access static property
    }
    
    public function makeSound() {
        echo "{$this->name} says: Woof! <br>";
    }
    
    public function move() {
        echo "{$this->name} is running. <br>";
    }
    
    // Static Method
    public static function getCount() {
        return self::$count;
    }
    
    public function __destruct() {
        // echo "The dog {$this->name} is leaving memory...<br>";
    }
}

$dog1 = new Dog("Buddy", "Golden Retriever");
$dog1->makeSound();
$dog1->move();
$dog1->log("Dog created successfully."); // Using Trait method

$dog2 = new Dog("Rex", "German Shepherd");

echo "Static Access (Count): " . Dog::getCount() . "<br>";
echo "Class Constant: " . Dog::TYPE . "<br>";

// ==========================================
// 11. ERROR HANDLING
// ==========================================
echo "<h2>11. Error Handling Exceptions</h2>";

function divide($dividend, $divisor) {
    if($divisor == 0) {
        throw new Exception("Division by zero");
    }
    return $dividend / $divisor;
}

try {
    echo divide(5, 0);
} catch(Exception $e) {
    echo "Caught exception: " . $e->getMessage() . "<br>";
} finally {
    echo "Process complete.<br>";
}

// ==========================================
// 12. DATE & TIME
// ==========================================
echo "<h2>12. Date & Time</h2>";
echo "Today is " . date("Y/m/d") . "<br>";
echo "Time is " . date("h:i:sa") . "<br>";

// Creating a date from string
$d = strtotime("tomorrow");
echo "Tomorrow is " . date("Y-m-d h:i:sa", $d) . "<br>";

// ==========================================
// 13. FILE HANDLING (Basics)
// ==========================================
echo "<h2>13. File Handling</h2>";
$filename = "testfile.txt";
file_put_contents($filename, "Hello from PHP file handling!");
echo "File created/written: $filename <br>";
echo "File content read: " . file_get_contents($filename) . "<br>";
// Cleaning up
unlink($filename);
echo "File deleted.<br>";

// ==========================================
// 14. JSON HANDLING
// ==========================================
echo "<h2>14. JSON</h2>";
$data = ["name" => "John", "age" => 30];
$json = json_encode($data);
echo "Encoded JSON: $json <br>";
$decoded = json_decode($json, true); // true for associative array
echo "Decoded Name: " . $decoded['name'] . "<br>";

echo "<br><br><br>";

?>
