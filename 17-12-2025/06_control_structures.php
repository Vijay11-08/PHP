<?php
echo "<h1>06. Control Structures</h1>";
echo "<a href='index.php'>Back to Index</a><hr>";

echo "<h2>1. If...Else...Elseif</h2>";
$t = date("H");
echo "Current Hour: $t <br>";

if ($t < "10") {
  echo "Have a good morning!";
} elseif ($t < "20") {
  echo "Have a good day!";
} else {
  echo "Have a good night!";
}
echo "<br>";

echo "<h2>2. Switch Statement</h2>";
$favcolor = "red";

switch ($favcolor) {
  case "red":
    echo "Your favorite color is red!";
    break;
  case "blue":
    echo "Your favorite color is blue!";
    break;
  case "green":
    echo "Your favorite color is green!";
    break;
  default:
    echo "Your favorite color is neither red, blue, nor green!";
}
echo "<br>";

echo "<h2>3. Match Expression (PHP 8)</h2>";
echo "Match is similar to switch but stricter and returns a value.<br>";

$status = 404;

$message = match ($status) {
    200, 300 => null,
    400 => 'not found',
    500 => 'server error',
    default => 'unknown status code',
};

echo "Status $status: Message is '$message'<br>";
?>
