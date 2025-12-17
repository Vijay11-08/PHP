<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="calculator">
    <input type="text" id="display" placeholder="0" readonly>
    <div class="buttons">
        <button class="btn-clear" onclick="clearDisplay()" data-key="Delete">C</button>
        <button class="btn-op" onclick="appendToDisplay('(')" data-key="(">(</button>
        <button class="btn-op" onclick="appendToDisplay(')')" data-key=")">)</button>
        <button class="btn-op" onclick="appendToDisplay('/')" data-key="/">÷</button>

        <button onclick="appendToDisplay('7')" data-key="7">7</button>
        <button onclick="appendToDisplay('8')" data-key="8">8</button>
        <button onclick="appendToDisplay('9')" data-key="9">9</button>
        <button class="btn-op" onclick="appendToDisplay('*')" data-key="*">×</button>

        <button onclick="appendToDisplay('4')" data-key="4">4</button>
        <button onclick="appendToDisplay('5')" data-key="5">5</button>
        <button onclick="appendToDisplay('6')" data-key="6">6</button>
        <button class="btn-op" onclick="appendToDisplay('-')" data-key="-">−</button>

        <button onclick="appendToDisplay('1')" data-key="1">1</button>
        <button onclick="appendToDisplay('2')" data-key="2">2</button>
        <button onclick="appendToDisplay('3')" data-key="3">3</button>
        <button class="btn-op" onclick="appendToDisplay('+')" data-key="+">+</button>

        <button onclick="appendToDisplay('0')" data-key="0">0</button>
        <button onclick="appendToDisplay('.')" data-key=".">.</button>
        <button class="btn-equal" onclick="calculate()" data-key="Enter">=</button>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
