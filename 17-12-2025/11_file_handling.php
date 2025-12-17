<?php
echo "<h1>11. File Handling</h1>";
echo "<a href='index.php'>Back to Index</a><hr>";

echo "<h2>1. Reading Files (readfile)</h2>";
echo "The readfile() function reads a file and writes it to the output buffer.<br>";
// We'll create a temporary file to read
$filename = "webdictionary.txt";
file_put_contents($filename, "AJAX = Asynchronous JavaScript and XML\nCSS = Cascading Style Sheets\nHTML = Hyper Text Markup Language");

echo "<b>Reading $filename:</b><br>";
echo "<pre>";
readfile($filename);
echo "</pre>";

echo "<h2>2. Open/Read/Close (fopen, fread, fclose)</h2>";
$myfile = fopen($filename, "r") or die("Unable to open file!");
echo "File opened successfully.<br>";
echo "<b>One line:</b> " . fgets($myfile) . "<br>"; // Reads first line
// Reset pointer isn't easy without reopening or fseek, let's reopen for simplicity of example or just read next
echo "<b>Next line:</b> " . fgets($myfile) . "<br>";

// Check end of file
echo "<b>Reading until End of File (feof):</b><br>";
$myfile = fopen($filename, "r");
while(!feof($myfile)) {
  echo fgets($myfile) . "<br>";
}
fclose($myfile);

echo "<h2>3. Creating/Writing (fopen w/ 'w')</h2>";
$newFile = "testfile.txt";
$myfile = fopen($newFile, "w") or die("Unable to open file!");
$txt = "Mickey Mouse\n";
fwrite($myfile, $txt);
$txt = "Minnie Mouse\n";
fwrite($myfile, $txt);
fclose($myfile);
echo "Wrote to $newFile. Content:<br>";
readfile($newFile);

echo "<h2>4. Appending (fopen w/ 'a')</h2>";
$myfile = fopen($newFile, "a") or die("Unable to open file!");
$txt = "Donald Duck\n";
fwrite($myfile, $txt);
fclose($myfile);
echo "<br><b>After Appending:</b><br>";
readfile($newFile);

// Cleanup
unlink($filename);
unlink($newFile);
echo "<br><br><i>Temporary files deleted.</i>";
?>
