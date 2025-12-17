const display = document.getElementById('display');

function appendToDisplay(value) {
    if (display.value === 'Error') {
        clearDisplay();
    }
    display.value += value;
}

function clearDisplay() {
    display.value = '';
}

async function calculate() {
    const expression = display.value;
    if (!expression) return;

    // UI Feedback
    const originalValue = display.value;
    display.value = 'Calculating...';

    try {
        const response = await fetch('api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ expression: expression })
        });

        const data = await response.json();

        if (data.status === 'success') {
            display.value = data.result;
        } else {
            console.error(data.message);
            display.value = 'Error';
            setTimeout(() => display.value = originalValue, 1500);
        }
    } catch (error) {
        console.error('Network Error:', error);
        display.value = 'Error';
    }
}

// Keyboard Support
document.addEventListener('keydown', (e) => {
    const key = e.key;

    // Check if key matches a button's data-key or inner text
    const button = document.querySelector(`button[data-key="${key}"]`);

    if (button) {
        e.preventDefault();
        button.click(); // Trigger click animation/action
        button.classList.add('active'); // Add active state for visual feedback
        setTimeout(() => button.classList.remove('active'), 100);
    } else if (key === 'Backspace') {
        const current = display.value;
        display.value = current.slice(0, -1);
    } else if (key === 'Escape') {
        clearDisplay();
    }
});