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


    <!--<p><a href="index.php">Accéder à l'accueil du site</a></p>-->

        <table>
            <tr><th>Nom</th><th>Prenom</th><th>Tel</th><th>Email</th></tr>

            <?php

                foreach ($manager->getListeUtilisateurs() as $utilisateur)
                {
                    echo '<tr><td>', $utilisateur->getNom(),'</td><td>',
                    $utilisateur->getPrenom(),'</td><td>',
                    $utilisateur->getTel(),'</td><td>',
                    $utilisateur->getMail(),'</td></tr>';
                }

            ?>
        </table>
</body>
</html>