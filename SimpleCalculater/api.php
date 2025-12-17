<?php
require_once 'Calculator.php';

header('Content-Type: application/json');

try {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['expression'])) {
        throw new Exception("No expression provided");
    }

    $calc = new Calculator();
    $result = $calc->calculate($input['expression']);
    
    echo json_encode(['status' => 'success', 'result' => $result]);

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
} catch (ParseError $e) {
    // Catches syntax errors from eval if they slip through regex
    echo json_encode(['status' => 'error', 'message' => 'Invalid Formula']);
} catch (DivisionByZeroError $e) {
    echo json_encode(['status' => 'error', 'message' => 'Cannot divide by zero']);
}
?>
