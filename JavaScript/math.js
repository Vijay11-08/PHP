// 1. Math.round() – Rounds to nearest integer
console.log("Math.round(4.7) =", Math.round(4.7));   // Output: 5


// 2. Math.floor() – Rounds DOWN to the nearest integer
console.log("Math.floor(4.7) =", Math.floor(4.7));   // Output: 4


// 3. Math.ceil() – Rounds UP to the nearest integer
console.log("Math.ceil(4.2) =", Math.ceil(4.2));     // Output: 5
console.log("Math.ceil(3.9) =", Math.ceil(3.9));     // Output: 4


// 4. Math.random() – Generates random number between 0 and 1
console.log("Math.random() =", Math.random());        // Output: random (0 to 1)


// 5. Math.abs() – Converts negative to positive
console.log("Math.abs(-10) =", Math.abs(-10));       // Output: 10


// 6. Math.sqrt() – Square root of a number
console.log("Math.sqrt(16) =", Math.sqrt(16));       // Output: 4


// 7. Math.max() & Math.min() – Highest and lowest values
console.log("Math.max(5, 10, 20) =", Math.max(5, 10, 20));   // Output: 20
console.log("Math.min(5, 10, 20) =", Math.min(5, 10, 20));   // Output: 5


// 8. Math.pow() – Base^Exponent
console.log("Math.pow(2, 3) =", Math.pow(2, 3));     // Output: 8


// 9. Math.PI and Math.E – Constants
console.log("Math.PI =", Math.PI);                   // Output: 3.141592653589793
console.log("Math.E =", Math.E);                     // Output: 2.718281828459045


// 10. Trigonometric Functions (sin, cos, tan)
// Convert 45 degrees to radians
let radians = (45 * Math.PI) / 180;

console.log("Math.sin(45°) =", Math.sin(radians));   // Output: 0.7071...
console.log("Math.cos(45°) =", Math.cos(radians));   // Output: 0.7071...
console.log("Math.tan(45°) =", Math.tan(radians));   // Output: ~1


// 11. Math.log(), Math.log10(), Math.exp()
// Natural log (base e)
console.log("Math.log(10) =", Math.log(10));         // Output: 2.30258...

// Base-10 log
console.log("Math.log10(10) =", Math.log10(10));     // Output: 1

// e^x
console.log("Math.exp(2) =", Math.exp(2));           // Output: 7.389056...
