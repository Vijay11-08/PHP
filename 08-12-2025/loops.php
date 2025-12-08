<h1>Looping in PHP</h1>
<li>while loop</li>
<li>do...while loop</li>
<li>for loop</li>
<li>foreach loop</li>

<h3>Output Of Looping in PHP</h3>
<?php

// 1. while loop
// - loops through a block of code as long as the specified condition is true
echo "<h4>While Loop Example</h4>";
$x = 1; //initialization
while($x <= 5) //condition
{
        echo "The number is: $x <br>";
        $x++; //counter
}
echo "<br>";


// 2. do...while loop
// - loops through a block of code once, and then repeats the loop as long as the specified condition is true
echo "<h4>Do...While Loop Example</h4>";
$x = 1;
do {
        echo "The number is: $x <br>";
        $x++;
} while ($x <= 1);
echo "<br>";


// 3. for loop
// - loops through a block of code a specified number of times
echo "<h4>For Loop Example</h4>";
for ($x = 0; $x <= 10; $x++)
    {
    echo "The number is: $x <br>";
}
echo "<br>";


// 4. foreach loop
// - loops through a block of code for each element in an array
echo "<h4>Foreach Loop Example</h4>";
$colors = array("red", "green", "blue", "yellow");
foreach ($colors as $value)
{
        echo "$value <br>";
}
echo "<br>";


?>