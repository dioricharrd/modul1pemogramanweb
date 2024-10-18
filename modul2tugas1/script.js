let display = document.getElementById('display');
let currentInput = '0'; 
let resultDisplayed = false;
let operators = ['+', '-', '*', '/', '%', '^']; 

function append(value) {
    if (resultDisplayed) {
        clearDisplay();
        resultDisplayed = false;
    }

    
    if (currentInput === '0' && !isNaN(value)) {
        currentInput = value; 
    } 
   
    else if (operators.includes(value) && operators.includes(currentInput.slice(-1))) {
        currentInput = currentInput.slice(0, -1) + value; 
    } 
    else {
        currentInput += value; 
    }

    display.innerText = currentInput;
}

function clearDisplay() {
    currentInput = '0';
    display.innerText = currentInput;
}

function calculate() {
    let expression = currentInput.replace('^', '**'); 
    try {
        currentInput = eval(expression).toString();
        display.innerText = currentInput;
        resultDisplayed = true;
    } catch (error) {
        display.innerText = 'Error';
        currentInput = '';
    }
}
