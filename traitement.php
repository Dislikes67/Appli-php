<?php
session_start();        //Session_start démarre la session et enregistre les informations coté serveur jusqu'à la fermeture ou l'arrêt de la session
    
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
    // Vérifie si une action est spécifiée dans l'URL
    if(isset($_GET['action'])){

        switch ($_GET['action']){
            case "delete":
                
                if (isset($_GET['index'])) {
                    //Supprime le produit à l'index spécifié
                    $index = intval($_GET['index']);
                    if (isset($_SESSION['product'][$index])){
                        unset($_SESSION['product'][$index]);
                        // Réindexe le tableau pour éviter les trous
                        $_SESSION['products'] = array_values($_SESSION['products']);
                    }
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
    
// Redirect back to the index page
header("Location:recap.php");
exit(); // Ensure no further code is executed after the redirect


