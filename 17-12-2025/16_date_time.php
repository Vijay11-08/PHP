<?php
echo "<h1>16. Date & Time</h1>";
echo "<a href='index.php'>Back to Index</a><hr>";

// Set timezone
date_default_timezone_set("Asia/Kolkata");
echo "Timezone set to: " . date_default_timezone_get() . "<br>";

echo "<h2>1. Date() Function</h2>";
echo "Today is " . date("Y/m/d") . "<br>";
echo "Today is " . date("Y.m.d") . "<br>";
echo "Today is " . date("Y-m-d") . "<br>";
echo "Today is " . date("l") . " (Day of week)<br>";

echo "<h2>2. Time</h2>";
echo "The time is " . date("h:i:sa") . "<br>";

echo "<h2>3. Mktime() - Create Date</h2>";
$d = mktime(11, 14, 54, 8, 12, 2014);
echo "Created date (8/12/2014) is " . date("Y-m-d h:i:sa", $d) . "<br>";

echo "<h2>4. Strtotime() - String to Time</h2>";
$d = strtotime("10:30pm April 15 2014");
echo "10:30pm April 15 2014 is " . date("Y-m-d h:i:sa", $d) . "<br>";

$d = strtotime("tomorrow");
echo "Tomorrow is " . date("Y-m-d h:i:sa", $d) . "<br>";

$d = strtotime("next Saturday");
echo "Next Saturday is " . date("Y-m-d h:i:sa", $d) . "<br>";

$d = strtotime("+3 Months");
echo "+3 Months is " . date("Y-m-d h:i:sa", $d) . "<br>";
?>
