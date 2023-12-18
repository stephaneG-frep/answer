<?php 
    
    class UtilisateursManager
    {

        private $bddPDO;

// constructeur de connexion a la base de donnees
    public function __construct(PDO $bddPDO)
        {
            $this->bddPDO = $bddPDO;
        }
//fonction d'insertion a la bdd
    public function inserer(Utilisateurs $utilisateur)
    {
        $requete = $this->bddPDO->prepare('INSERT INTO twister.utilisateur
        (nom, prenom, tel, mail) VALUES
        (:nom, :prenom, :tel, :mail)');
        $requete->bindvalue(':nom', $utilisateur->getNom());
        $requete->bindvalue(':prenom', $utilisateur->getPrenom());
        $requete->bindvalue(':tel', $utilisateur->getTel());
        $requete->bindvalue(':mail', $utilisateur->getMail());

        $requete->execute();
    }
    
    public function getListeUtilisateurs()
    {
        $requete = $this->bddPDO->query('SELECT * FROM twister.utilisateur ORDER BY nom ASC');

        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'utilisateurs');

        $listeUtilisateurs = $requete->fetchAll();

        $requete->closeCursor();

        return $listeUtilisateurs;
    }

    public function getUtilisateur($id)
    {
        $requete = $this->bddPDO->prepare('SELECT * FROM twister.utilisateur WHERE id = :id');

        $requete->bindvalue(':id', (int) $id, PDO::PARAM_INT);

        $requete->execute();

        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'utilisateur');

        $utilisateur = $requete->fetch();

        return $utilisateur;
    }







    }












?>