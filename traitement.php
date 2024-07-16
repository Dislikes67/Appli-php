<?php 
    session_start();

    if (isset($_POST['submit'])){


        // Sanitize and validate inputs
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

        // Check if all inputs are valid
        if($name && $price && $qtt){

            $product = [
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price * $qtt
            ];

            // Add product to the session array
            $_SESSION['products'][] = $product;
        }
    }
// Redirect back to the index page
header("Location:index.php");
exit(); // Ensure no further code is executed after the redirect

