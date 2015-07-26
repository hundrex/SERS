<?php

/*
 * Description of User
 * 
 * @author Alexis
 */

class User {
    
    ///////////////
    // ATTRIBUTS //
    ///////////////
    
    /*
     * @var int
     */
    private $id;
    
    /*
     * @var string
     */
    private $prenom;
    
    /*
     * @var string
     */
    private $nom;
    
    /*
     * @var string
     */
    private $mail;
    
    /*
     * @var string
     */    
    private $adresse;

    /*
     * @var date
     */
    private $date_naissance;

    /*
     * @var date
     */
    private $date_creation;
    
    
    /*
     * @var string
     */
    private $pseudo;
    
    /*
     * @var string
     */
    private $password;

    /*
     * @var bool
     */
    private $affiche;
    
    /*
     * @var Fichier
     */
    private $extFichier;
    
    /*
     * @var TypeUtilisateur
     */
    private $extTypeUtilisateur;
    
    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////
           
    public function classeBidon($id=-1, $adresse,$prenom,$mail,$nom, $dateNaissance=null, $dateCreation=null, $affiche=true, $password, $pseudo, $typeUtilisateur, $fichier)
    {
        $this->id = $id;
        $this->adresse = $adresse;
        $this->affiche = $affiche;
        $this->dateCreation = $dateCreation;
        $this->dateNaissance = $dateNaissance;
        $this->extFichier = $fichier;
        $this->extTypeUtilisateur = $typeUtilisateur;
        $this->mail = $mail;
        $this->nom = $nom;
        $this->password = $password;
        $this->prenom = $prenom;
        $this->pseudo = $pseudo;
    }
    
    /////////////////////
    // GETTERS&SETTERS //
    /////////////////////
    
    //GetterSetter id
    public function setId($id)
    {
        if(is_int($id))
        {
            $this->id = $id;
        }
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    //GetterSetter prenom
        public function setPrenom($prenom)
    {
        if(is_string($prenom))
        {
            $this->prenom = $prenom;
        }
    }
    
    public function getPrenom()
    {
        return $this->prenom;
    }
    
    //GetterSetter nom
    public function setNom($nom)
    {
        if(is_string($nom))
        {
            $this->nom = $nom;
        }
    }
    
    public function getNom()
    {
        return $this->nom;
    }
    
    //GetterSetter mail
    public function setMail($mail)
    {
        if(is_string($mail))
        {
            $this->mail = $mail;
        }
    }
    
    public function getMail()
    {
        return $this->mail;
    }
    
    //GetterSetter adresse
    public function setAdresse($adresse)
    {
        if(is_string($adresse))
        {
            $this->adresse = $adresse;
        }
    }
    
    public function getAdresse()
    {
        return $this->adresse;
    }
    
    //GetterSetter dateNaissance
    public function setDateNaissance($dateNaissance)
    {
        if(is_a($dateNaissance, "Date"))
        {
            $this->dateNaissance = $dateNaissance;
        }
    }
    
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }
    
    //GetterSetter dateCreation
    public function setDateCreation($dateCreation)
    {
        if(is_a($dateCreation, "Date"))
        {
            $this->dateCreation = $dateCreation;
        }
    }
    
    public function getDateCreation()
    {
        return $this->dateCreation;
    }   
    
    //GetterSetter pseudo
    public function setPseudo($pseudo)
    {
        if(is_string($pseudo))
        {
            $this->pseudo = $pseudo;
        }
    }
    
    public function getPseudo()
    {
        return $this->pseudo;
    }
    
    //GetterSetter password
    public function setPassword($password)
    {
        if(is_string($password))
        {
            $this->password = $password;
        }
    }
    
    public function getPassword()
    {
        return $this->password;
    }

    //GetterSetter affiche
    public function setAffiche($affiche)
    {
        if(is_bool($affiche))
        {
            $this->affiche = $affiche;
        }
    }
    
    public function getAffiche()
    {
        return $this->affiche;
    }
    
    //GetterSetter fichier
    public function setFichier($fichier)
    {
        if(is_int($fichier))
        {
            $this->extFichier = FichierDAL::findById($fichier);
        }
        else if(is_a($fichier, "Fichier"))
        {
            $this->extFichier = $fichier;
        }
    }
    
    public function getFichier()
    {
        $fichier = null;
        
        if(is_int($this->extFichier))
        {
            $fichier = FichierDAL::findById($this->extFichier);
            $this->extFichier = $fichier;
        }
        else if(is_a($this->extFichier, "Fichier"))
        {
            $fichier = $this->extFichier;
        }
        return $fichier;
    }
    
    //GetterSetter extTypeUtilisateur
    public function setTypeUtilisateur($extTypeUtilisateur)
    {
        if(is_int($extTypeUtilisateur))
        {
            $this->extTypeUtilisateur = TypeUtilisateurDAL::findById($extTypeUtilisateur);
        }
        else if(is_a($extTypeUtilisateur, "TypeUtilisateur"))
        {
            $this->extTypeUtilisateur = $extTypeUtilisateur;
        }
    }
    
    public function getTypeUtilisateur()
    {
        $extTypeUtilisateur = null;
        
        if(is_int($this->extTypeUtilisateur))
        {
            $extTypeUtilisateur = TypeUtilisateurDAL::findById($this->extTypeUtilisateur);
            $this->extTypeUtilisateur = $extTypeUtilisateur;
        }
        else if(is_a($this->extTypeUtilisateur, "TypeUtilisateur"))
        {
            $extTypeUtilisateur = $this->extTypeUtilisateur;
        }
        return $extTypeUtilisateur;
    }
    
    //////////////
    // METHODES //
    //////////////
    
    protected function hydrate($dataSet)
    {
        $this->id = $dataSet['id'];
        $this->adresse = $dataSet['adresse'];
        $this->affiche = $dataSet['affiche'];
        $this->dateCreation = $dataSet['dateCreation'];
        $this->dateNaissance = $dataSet['dateNaissance'];
        $this->extFichier = $dataSet['Fichier'];
        $this->extTypeUtilisateur = $dataSet['TypUtilisateur'];
        $this->mail = $dataSet['mail'];
        $this->nom = $dataSet['nom'];
        $this->password = $dataSet['password'];
        $this->prenom = $dataSet['prenom'];
        $this->pseudo = $dataSet['pseudo'];
    }
}
