<?php
echo "<h1>04. Strings & String Functions</h1>";
echo "<a href='index.php'>Back to Index</a><hr>";

$str = "The quick brown fox jumps over the lazy dog";

echo "<b>Original String:</b> '$str'<br><br>";

echo "<h2>Common Functions</h2>";

// strlen
echo "<b>strlen()</b> - String Length:<br>";
echo strlen($str) . "<br><br>";

// str_word_count
echo "<b>str_word_count()</b> - Count Words:<br>";
echo str_word_count($str) . "<br><br>";

// strrev
echo "<b>strrev()</b> - Reverse String:<br>";
echo strrev($str) . "<br><br>";

// strpos
echo "<b>strpos()</b> - Find text position ('fox'):<br>";
echo strpos($str, "fox") . "<br><br>";

// str_replace
echo "<b>str_replace()</b> - Replace text ('dog' with 'cat'):<br>";
echo str_replace("dog", "cat", $str) . "<br><br>";

// strtoupper & strtolower
echo "<b>strtoupper()</b> - To Uppercase:<br>";
echo strtoupper($str) . "<br><br>";
echo "<b>strtolower()</b> - To Lowercase:<br>";
echo strtolower("HELLO WORLD") . "<br><br>";

// substr
echo "<b>substr()</b> - Substring (start at 4, length 5):<br>";
echo substr($str, 4, 5) . "<br><br>";

// trim
$dirty = "   Hello World   ";
echo "<b>trim()</b> - Remove whitespace:<br>";
echo "Original: '$dirty' (Length: " . strlen($dirty) . ")<br>";
echo "Trimmed: '" . trim($dirty) . "' (Length: " . strlen(trim($dirty)) . ")<br><br>";

// explode
echo "<b>explode()</b> - String to Array:<br>";
$csv = "Apple, Banana, Kiwi";
print_r(explode(", ", $csv));
echo "<br><br>";

// implode
echo "<b>implode()</b> - Array to String:<br>";
$arr = ["Hello", "World", "PHP"];
echo implode(" ", $arr);
?>
