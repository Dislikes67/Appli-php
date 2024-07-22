<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appli Php</title>
    </head>
    <body>

    <?php include 'navbar.php'; ?>

    <div class="container">
        <h1>Ajouter un produit</h1>
        <!-- The form has an action attribute pointing to traitement.php, meaning the form data will be sent to traitement.php for processing when submitted. -->
        <form action="traitement.php" method="post"> <!--Le formulaire est envoyé en utilisant la requête HTML POST qui ne le stocke pas dans l'url à l'inverse de la méthode GET -->
            <p>
                <label>
                    Nom du produit :
                    <input type="text" name="name">
                </label>
            </p>
            <p>
                <label>
                    Prix du produit :
                    <input type="number" step="any" name="price" value="1" min=1 required>
                </label>
            </p>
            <p>
                <label>
                    Quantité désirée :
                    <input type="number" name="qtt" value="1" min=1 required>
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>
    </div>

    </body>
</html>