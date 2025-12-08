<h1>Strings in PHP</h1>
<li>A string is a sequence of characters, like "Hello world!".</li>
<li>In PHP, strings are enclosed in either single quotes (' ') or double quotes (" ").</li>
<li>Strings in PHP are mutable, meaning they can be changed after they are created.</li>
<li>String has some commonly used functions to manipulate strings.</li>
<br>

<h3>Output Of Strings</h3>
<?php

  $str = "This is Testing";
  
  echo $str[0] . "<br>";
  print $str[2] . "<br>";
  print $str . "<br>";

?>

<h1>String Functions</h1>
<li>strlen() - Returns the length of a string</li>
<li>str_word_count() - Counts the number of words in a string</li>
<li>strrev() - Reverses a string</li>
<li>strpos() - Searches for a specific text within a string</li>
<li>str_replace() - Replaces some characters with some other characters in a string</li>
<li>ucfirst() - Capitalizes the first character of a string</li>
<li>ucwords() - Capitalizes the first character of each word in a string</li>
<li>strtoupper() - Converts a string to uppercase</li>
<li>strtolower() - Converts a string to lowercase</li>

<h3>Output Of String Functions</h3>
<?php

  $str = "hello world! welcome to php string functions.";

  echo "Length of string: " . strlen($str) . "<br>";
  echo "Number of words: " . str_word_count($str) . "<br>";
  echo "Reversed string: " . strrev($str) . "<br>";
  echo "Position of 'php': " . strpos($str, "php") . "<br>";
  echo "After replacing 'php' with 'PHP': " . str_replace("php", "PHP", $str) . "<br>";
  echo "Capitalized first character: " . ucfirst($str) . "<br>";
  echo "Capitalized first character of each word: " . ucwords($str) . "<br>";
  echo "Uppercase string: " . strtoupper($str) . "<br>";
  echo "Lowercase string: " . strtolower($str) . "<br>";

?>
