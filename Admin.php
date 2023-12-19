<?php
//require "Utilisateurs.php";
//require "UtilisateursManager.php";
require "InclureClasses.php";



$bddPDO = new PDO('mysql:host=localhost; dbname=twister', 'root', '');
$bddPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$manager = new UtilisateursManager($bddPDO);

if(isset($_GET['modifier']))
{
    $utilisateur = $manager->getUtilisateur((int) $_GET['modifier']);
}
if(isset($_POST['nom']))
{
    $utilisateur = new Utilisateurs(
        [
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'tel' => $_POST['tel'],
            'mail' => $_POST['mail'],
        ]
    );
    if(isset($_POST['id']))
    {
        $utilisateur->setId($_POST['id']);
    }
    if($utilisateur->isUserValide())
    {
        $manager->mettreAjour($utilisateur);
        $message = 'Utilisateur bien modifier';
    }
    else
    {
        $erreur = $utilisateur->getErreurs();
    }
}
if(isset($_GET['supprimer']))
{
    $manager->supprimer((int) $_GET['supprimer']);
    $message = 'utilisateur bien supprimer';
}



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
<?php if(isset($message)){echo $message;} ?>
<nav>
        <h2>Admin</h2>
        <ul>
            <li><a href="Inscription.php">Inscrivez-vous</a><br></li>
            <!--<li> <a href="Admin.php">Admin</a><br></li>-->
            <li> <a href="index.php">Accueil</a><br></li>
        </ul>
    </nav>

<?php if(isset($message)) {echo $message;}?>

    <form action="admin.php" method="post">
        <table class="formulaire">


        <?php if(isset($erreurs) && in_array(Utilisateurs::NOM_INVALIDE, $erreurs))
        echo "Nom invalide..<br>" ?>
            <tr><td>Nom: </td><td><input type="text" name="nom" value="<?php if(isset ($utilisateur)) echo
            $utilisateur->getNom();?>"/></td></tr>

        <?php if(isset($erreurs) && in_array(Utilisateurs::PRENOM_INVALIDE, $erreurs))
        echo "Prenom invalide..<br>" ?>
            <tr><td>Prenom: </td><td><input type="text" name="prenom"  value="<?php if(isset ($utilisateur)) echo
            $utilisateur->getPrenom(); ?>"/></td></tr>
            
            <tr><td>Telephone: </td><td><input type="text" name="tel"  value="<?php if(isset ($utilisateur)) echo
            $utilisateur->getTel(); ?>"/></td></tr>

        <?php if(isset($erreurs) && in_array(Utilisateurs::MAIL_INVALIDE, $erreurs))
        echo "Email invalide..<br>" ?>
            <tr><td>Email: </td><td><input type="text" name="mail"  value="<?php if(isset ($utilisateur)) echo
            $utilisateur->getMail(); ?>"/></td></tr>

        <?php 
        if(isset($utilisateur)) 
        {
            ?>
            <input type="hidden" name="id" value="<?=$utilisateur->getId()?>"/>
            <?php
        }
        ?>
        
            <tr><td><input type="submit" value="Modifier" name="modifier" /></td></tr>
        </table>
        
    </form>


        <table class="table">

            <tr><th>Nom</th><th>Prenom</th><th>Tel</th><th>Email</th><th>Modifications</th><th>Supprimer</th></tr>

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
                    </td><td><a href="?supprimer=',$utilisateur->getId(),'">Supprimer</a></td>
                    </tr>';
                }

            ?>
        </table>
        
</body>
</html>