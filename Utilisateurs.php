<?php 
//Classe des utilisateurs
class Utilisateurs {

    private $erreurs = [],
            $id,
            $nom,
            $prenom,
            $tel,
            $mail;
// Constente d'invaliditee
    const NOM_INVALIDE = 1;
    const PRENOM_INVALIDE = 2;
    const MAIL_INVALIDE = 3;

//constructeur objet appel de la fonction hydrater
    public function __construct($donnees = [])
    {
        if(!empty($donnees))
        {
            $this->hydrater($donnees);
        }
    }
// Fonction hydrater pour assigner les valeurs de l'objet(pour eviter tros de setters au constructeur)
    public function hydrater($donnees)
    {
        foreach ($donnees as $attribut => $valeur)
        {
            $methodeSetters = 'set'.ucfirst($attribut);
            $this->$methodeSetters($valeur);
        }
    }
// Les setters
    public function setId($id)
    {
        if(!empty($id))
        {
            $this->id = (int) $id;
        }
    }
    public function setNom($nom)
    {
        if(!is_string($nom) || empty($nom))
        {
            $this->erreurs[] = self::NOM_INVALIDE;
        }
        else
        {
            $this->nom = $nom;
        }
    }
    public function setPrenom($prenom)
    {
        if(!is_string($prenom) || empty($prenom))
        {
            $this->erreurs[] = self::PRENOM_INVALIDE;
        }
        else
        {
            $this->prenom = $prenom;
        }
    }
    public function setTel($tel)
    {
        $this->tel = $tel;
    }
    public function setMail($mail)
    {
        if(filter_var($mail, FILTER_VALIDATE_EMAIL))
        {
            $this->mail = $mail;
        }
        else
        {
            $this->erreurs[] = self::MAIL_INVALIDE;
        }
    }

// Les gettrers
    public function getId()
    {
        return $this->id;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function getTel()
    {
        return $this->tel;
    }
    public function getmail()
    {
        return $this->mail;
    }
    public function getErreurs()
    {
        return $this->erreurs;
    }

// Fonction de validitee utilisateur
    public function isUserValide()
    {
        return !(empty($this->nom) || empty($this->prenom)
        || empty($this->mail));
    }




}











?>