<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Récapitulatif des produits</title>
</head>
<body>
    <?php
        // checks if the products array exists in the session and is not empty.
        if (!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo "<p>Aucun produit en session...</p>";
        } else {
            echo "<table class='table table-bordered table-striped'>",
                    "<thead>",
                        "<tr>",
                            "<th>#</th>",
                            "<th>Nom</th>",
                            "<th>Prix</th>",
                            "<th>Quantité</th>",
                            "<th>Total</th>",
                            "<th>Actions</th>",
                        "</tr>",
                    "</thead>",
                    "<tbody>";
            $totalGeneral = 0;
            foreach ($_SESSION['products'] as $index => $product) {
                echo "<tr>",
                        "<td>".($index + 1)."</td>", // Incrementing index to start from 1
                        "<td>".$product['name']."</td>",
                        "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "<td>".$product['qtt']."</td>",
                        "<td>".number_format($product['price'] * $product['qtt'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "<td>",
                            "<a href='traitement.php?action=delete&index=".$index."' class='btn btn-danger btn-sm'>Supprimer</a>",
                        "</td>",
                     "</tr>";
                $totalGeneral += $product['price'] * $product['qtt'];
            }
            echo "<tr>",
                    "<td colspan='4'>Total général : </td>",
                    "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                    "</tr>",
                "</tbody>",
            "</table>";
        }
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
