<?php
echo "<h1>07. Loops</h1>";
echo "<a href='index.php'>Back to Index</a><hr>";

echo "<h2>1. While Loop</h2>";
echo "Executes code as long as the condition is true.<br>";
$x = 1;
while($x <= 3) {
  echo "The number is: $x <br>";
  $x++;
}

echo "<h2>2. Do...While Loop</h2>";
echo "Executes the code ONCE, then checks condition.<br>";
$x = 1;
do {
  echo "The number is: $x <br>";
  $x++;
} while ($x <= 3);

echo "<h2>3. For Loop</h2>";
echo "Used when you know how many times to run.<br>";
for ($x = 0; $x <= 5; $x++) {
  echo "The number is: $x <br>";
}

echo "<h2>4. Foreach Loop</h2>";
echo "Used ONLY on arrays.<br>";
$colors = array("red", "green", "blue", "yellow");

echo "<b>Simple Foreach:</b><br>";
foreach ($colors as $value) {
  echo "$value <br>";
}

echo "<b>Foreach with Keys:</b><br>";
$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
foreach($age as $x => $val) {
  echo "$x = $val<br>";
}

echo "<h2>5. Break and Continue</h2>";
echo "<b>Break at 3:</b> ";
for ($x = 0; $x < 10; $x++) {
  if ($x == 3) { break; }
  echo "$x ";
}
echo "<br><b>Continue at 3 (skip 3):</b> ";
for ($x = 0; $x < 5; $x++) {
  if ($x == 3) { continue; }
  echo "$x ";
}
?>
