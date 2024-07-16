<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appli Php</title>
    </head>
    <body>
    
    <h1>Ajouter un produit</h1>
    <!-- The form has an action attribute pointing to traitement.php, meaning the form data will be sent to traitement.php for processing when submitted. -->
    <form action="traitement.php" method="post"> <!--the form data will be sent using the HTTP POST method.-->
        <p>
                <label>
                    Nom du produit :
                    <input type="text" name="name">
                </label>
        </p>
        <p>
            <label>
                Prix du produit :
                <input type="number" step="any" name="price">
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


    </body>
</html>