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
    private $dateNaissance;

    /*
     * @var date
     */
    private $dateCreation;
    
    
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
     * @var TypeUser
     */
    private $extTypeUser;
    
    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////
           
    public function User($id=-1, $adresse=null,
            $prenom=null,$mail=null,$nom=null, $dateNaissance=null, 
            $dateCreation=null, $affiche=false, $password=null, 
            $pseudo=null, $typeUser=null, $fichier=null)
    {
        $this->id = $id;
        $this->adresse = $adresse;
        $this->affiche = $affiche;
        $this->dateCreation = $dateCreation;
        $this->dateNaissance = $dateNaissance;
        $this->extFichier = $fichier;
        $this->extTypeUser = $typeUser;
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
    
    //GetterSetter extTypeUser
    public function setTypeUser($extTypeUser)
    {
        if(is_int($extTypeUser))
        {
            $this->extTypeUser = TypeUserDAL::findById($extTypeUser);
        }
        else if(is_a($extTypeUser, "TypeUser"))
        {
            $this->extTypeUser = $extTypeUser;
        }
    }
    
    public function getTypeUser()
    {
        $extTypeUser = null;
        
        if(is_int($this->extTypeUser))
        {
            $extTypeUser = TypeUserDAL::findById($this->extTypeUser);
            $this->extTypeUser = $extTypeUser;
        }
        else if(is_a($this->extTypeUser, "TypeUser"))
        {
            $extTypeUser = $this->extTypeUser;
        }
        return $extTypeUser;
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
        $this->extTypeUser = $dataSet['TypUser'];
        $this->mail = $dataSet['mail'];
        $this->nom = $dataSet['nom'];
        $this->password = $dataSet['password'];
        $this->prenom = $dataSet['prenom'];
        $this->pseudo = $dataSet['pseudo'];
    }
}