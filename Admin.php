<?php
//require "Utilisateurs.php";
//require "UtilisateursManager.php";
require "InclureClasses.php";



$bddPDO = new PDO('mysql:host=localhost; dbname=twister', 'root', '');
$bddPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$manager = new UtilisateursManager($bddPDO);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<nav>
        <h2>Admin</h2>
        <ul>
            <li><a href="Inscription.php">Inscrivez-vous</a><br></li>
            <!--<li> <a href="Admin.php">Admin</a><br></li>-->
            <li> <a href="index.php">Accueil</a><br></li>
        </ul>
    </nav>



<!--<p><h1>Formulaire de modification</h1></p>-->

    <form action="admin.php" method="post">
        <table class="formulaire">

        <?php if(isset($erreurs) && in_array(Utilisateurs::NOM_INVALIDE, $erreurs))
        echo "Nom invalide..<br>" ?>
            <tr><td>Nom: </td><td><input type="text" name="nom" /></td></tr>

        <?php if(isset($erreurs) && in_array(Utilisateurs::PRENOM_INVALIDE, $erreurs))
        echo "Prenom invalide..<br>" ?>
            <tr><td>Prenom: </td><td><input type="text" name="prenom" /></td></tr>
            
            <tr><td>Telephone: </td><td><input type="text" name="tel" /></td></tr>

        <?php if(isset($erreurs) && in_array(Utilisateurs::MAIL_INVALIDE, $erreurs))
        echo "Email invalide..<br>" ?>
            <tr><td>Email: </td><td><input type="text" name="mail" /></td></tr>

            <tr><td><input type="submit" value="Modifier" name="modifier" /></td></tr>
        </table>
    </form>


        <table class="table">
            <tr><th>Nom</th><th>Prenom</th><th>Tel</th><th>Email</th><th>Modifications</th></tr>

            <?php

                foreach ($manager->getListeUtilisateurs() as $utilisateur)
                {
                    echo '<tr><td>
                    ', $utilisateur->getNom(),'
                    </td><td>
                    ',$utilisateur->getPrenom(),'
                    </td><td>
                    ',$utilisateur->getTel(),'
                    </td><td>
                    ',$utilisateur->getMail(),'
                    </td><td><a href="?modifier=',$utilisateur->getId(),'">Modifier</a></td>
                    </tr>';
                }

            ?>
        </table>

</body>
</html>