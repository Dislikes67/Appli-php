<?php
session_start();        //Session_start démarre la session et enregistre les informations coté serveur jusqu'à la fermeture ou l'arrêt de la session
    // var_dump ($_SESSION);die; 
    if (isset($_POST['submit'])){


        // Sanitize and validate inputs
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

        // Une faille XSS est une faille de sécurité dans le code d'une application web, elle peut être exploitée par l'utilisateur pour récupèrer des données sensibles et/ou injecter du code malveillant, il faut alors filtrer à l'aide de filter_input (html special chars, html entitie*/

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


