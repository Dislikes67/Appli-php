<?php
session_start(); // Start the session to store product data

if (isset($_POST['submit'])) {

    // Sanitize and validate inputs
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

    // Ensure all inputs are valid
    if ($name && $price && $qtt) {

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

// Check if an action is specified in the URL
if (isset($_GET['action'])) {

    switch ($_GET['action']) {
        case "add":
            // Code for adding (already handled above, but could be expanded here)
            break;
            
        case "delete":
            // Ensure index is set and is valid
            if (isset($_GET['index'])) {
                $index = intval($_GET['index']);
                if (isset($_SESSION['products'][$index])) {
                    unset($_SESSION['products'][$index]);
                    // Re-index the array to avoid gaps
                    $_SESSION['products'] = array_values($_SESSION['products']);
                } else {
                    // Debug information
                    echo "Index not found in session products array.";
                }
            } else {
                // Debug information
                echo "Index not set in URL.";
            }
            break;

        case "clear":
            // Clear all products
            $_SESSION['products'] = [];
            break;

        case "up-qtt":
            if (isset($_GET['index'])) {
                $index = intval($_GET['index']);
                if (isset($_SESSION['products'][$index])) {
                    $_SESSION['products'][$index]['qtt']++;
                    // Update total price
                    $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $_SESSION['products'][$index]['qtt'];
                }
            }
            break;

        case "down-qtt":
            if (isset($_GET['index'])) {
                $index = intval($_GET['index']);
                if (isset($_SESSION['products'][$index]) && $_SESSION['products'][$index]['qtt'] > 1) {
                    $_SESSION['products'][$index]['qtt']--;
                    // Update total price
                    $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $_SESSION['products'][$index]['qtt'];
                }
            }
            break;
    }
}

// Redirect back to the recap page
header("Location: recap.php");
exit(); // Ensure no further code is executed after the redirect
?>
