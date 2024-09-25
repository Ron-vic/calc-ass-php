<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <style>
        .calc-error { color: red; }
        .calc-results { color: green; }
    </style>
</head>
<body style="background-color: grey;">
    
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="number" name="num1" placeholder="First Number" step="any" required>
    <select name="operator">
        <option value="add">+</option>
        <option value="subtract">-</option>
        <option value="multiply">*</option>
        <option value="divide">/</option>
        <option value="exponentiation">^</option>
        <option value="percentage">%</option>
        <option value="squareroot">sqrt</option>
        <option value="modulus">mod</option>
    </select>
    <input type="number" name="num2" placeholder="Second Number" step="any" required>
    <button type="submit">Calculate</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get sanitized inputs
    $num1 = filter_input(INPUT_POST, "num1", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $num2 = filter_input(INPUT_POST, "num2", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $operator = htmlspecialchars($_POST["operator"]);

    // Initialize result
    $value = 0;
    
    // Perform the calculation
    switch ($operator) {
        case "add":
            $value = $num1 + $num2;
            break;
        case "subtract":
            $value = $num1 - $num2;
            break;
        case "multiply":
            $value = $num1 * $num2;
            break;
        case "divide":
            if ($num2 != 0) {
                $value = $num1 / $num2;
            } else {
                echo "<p class='calc-error'>Error: Division by zero!</p>";
                exit;
            }
            break;
        case "exponentiation":
            $value = pow($num1, $num2);
            break;
        case "percentage":
            $value = ($num1 * $num2) / 100;
            break;
        case "squareroot":
            if ($num1 >= 0) {
                $value = sqrt($num1);
            } else {
                echo "<p class='calc-error'>Error: Cannot take the square root of a negative number!</p>";
                exit;
            }
            break;
        case "modulus":
            $value = $num1 % $num2;
            break;
        default:
            echo "<p class='calc-error'>Something went wrong!</p>";
            exit;
    }
    
    // Display the result
    echo "<p class='calc-results'>Result = " . $value . "</p>";
}
?>

</body>
</html>










