<?php
//require "Utilisateurs.php";
//require "UtilisateursManager.php";
require "InclureClasses.php";



$bddPDO = new PDO('mysql:host=localhost; dbname=twister', 'root', '');
$bddPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$manager = new UtilisateursManager($bddPDO);

if(isset($_POST['nom']))
{
    $utilisateur = new Utilisateurs(
        [
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'tel' => $_POST['tel'],
            'mail' => $_POST['mail']
        ]
    );
    if($utilisateur->isUserValide())
    {
        $manager->inserer($utilisateur);

        echo 'Utilisateur enregisté..';
    }
    else{
        $erreurs = $utilisateur->getErreurs();
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription utilisateur</title>
    <link rel="stylesheet" href="inscription.css">
</head>
<body>


<nav>
        <h2>Inscription</h2>
        <ul>
            <!--<li><a href="Inscription.php">Inscrivez-vous</a><br></li>-->
            <li> <a href="Admin.php">Admin</a><br></li>
            <li> <a href="index.php">Accueil</a><br></li>
        </ul>
</nav>


<div class="container">
<p><h1>Formulaire d'inscription</h1></p>


    <form action="inscription.php" method="post">
        <table>

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

            <tr><td><input type="submit" value="Enregistrer" name="enregistrer" /></td></tr>
        </table>
    </form>
</div>
</body>
</html>