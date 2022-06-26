<!DOCTYPE html>
<html>
<head>
    <title>Result</title>
</head>
<body>
<?php

if (isset($_GET["num1"], $_GET["num2"], $_GET["operation"])) {
    $num1 = (float) $_GET["num1"];
    $num2 = (float) $_GET["num2"];
    $operation = $_GET["operation"];
    if ($operation == "addition") {
        $result = $num1 + $num2;
        echo htmlentities("$num1 + $num2 = $result");
    } elseif ($operation == "subtraction") {
        $result = $num1 - $num2;
        echo htmlentities("$num1 - $num2 = $result");
    } elseif ($operation == "multiplication") {
        $result = $num1 * $num2;
        echo htmlentities("$num1 * $num2 = $result");
    } else {
        if ($num2 == 0) {
            echo htmlentities("Divisor cannot be 0!");
        } else {
            $result = $num1 / $num2;
            echo htmlentities("$num1 / $num2 = $result");
        }
    }
} else {
    if (!isset($_GET["num1"])) {
        print("Please Enter the First Number!");
    }
    if (!isset($_GET["num2"])) {
        print("Please Enter the Second Number!");
    }
    if (!isset($_GET["operation"])) {
        print("Please Choose the Operation!");
    }
}

?>
</body>
</html>