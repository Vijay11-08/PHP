<?php
echo "<h1>15. Error Handling & Exceptions</h1>";
echo "<a href='index.php'>Back to Index</a><hr>";

echo "<h2>1. Basic Error Handling (die)</h2>";
if (!file_exists("missing.txt")) {
    // die("File not found"); // This would stop the script
    echo "Warning: File not found (Handled gracefully).<br>";
}

echo "<h2>2. Exceptions (Try...Catch...Finally)</h2>";
echo "Exceptions are used to change the normal flow of the script if a specified error (exceptional) condition occurs.<br>";

function divide($dividend, $divisor) {
  if($divisor == 0) {
    throw new Exception("Division by zero");
  }
  return $dividend / $divisor;
}

// Try block
try {
  echo divide(5, 0);
} catch(Exception $e) {
  // Catch block
  echo "<b>Caught Exception:</b> " . $e->getMessage() . "<br>";
  echo "File: " . $e->getFile() . " on line " . $e->getLine() . "<br>";
} finally {
  // Finally block
  echo "Process complete (This always runs).<br>";
}

echo "<h2>3. Custom Exceptions</h2>";
class CustomException extends Exception {
  public function errorMessage() {
    return "Error: " . $this->getMessage(). " is not a valid email address.";
  }
}

$email = "someone@example...com";

try {
  // Check if
  if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
    // Throw exception if email is not valid
    throw new CustomException($email);
  }
} catch (CustomException $e) {
  // display custom message
  echo $e->errorMessage() . "<br>";
}
?>
