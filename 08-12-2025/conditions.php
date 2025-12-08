<h1>Conditions In PHP</h1>
<li>If</li>
<li>If...Else</li>
<li>If...Elseif...Else</li>
<li>Switch</li>

<h3>Output Of Conditions In PHP</h3>

<?php
// 1. if statement 
// - executes some code if one condition is true
echo "<h4>If Statement Example</h4>";
$t = date("H");
if ($t < "20") {
        echo "Have a good day!";
}
echo "<br>";

// 2. if...else statement
// - executes some code if a condition is true and another code if that condition is false
echo "<h4>If...Else Statement Example</h4>";
$t = date("H");
if ($t < "20"){
        echo "Have a good day!";
}
else{
  echo "Good Night";
}
echo "<br>";


// 3. if...elseif...else statement
// - executes different codes for more than two conditions
echo "<h4>If...Elseif...Else Statement Example</h4>";
$t = date("H");
if ($t < 13)
        echo "Have a good Morning!";
elseif ($t < 20)
{
  echo "Good Afternoon";
}
else
{
  echo "Good Night";
}
echo "<br>";


// 4. switch statement
// - selects one of many blocks of code to be executed
echo "<h4>Switch Statement Example</h4>";
$favcolor = "blue";
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


?>


