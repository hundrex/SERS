<?php

/**
 * Description of Fichier
 *
 * @author Alexis
 */
class Fichier {

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
    private $nom;

    /*
     * @var date
     */
    private $dateCreation;

    /*
     * @var bool
     */
    private $affiche;

    /*
     * @var TypeFichier
     */
    private $extTypeFichier;

    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////

    public function User($id = -1, $nom = null, $dateCreation = null, $affiche = false, $typeFichier = null)
    {
        $this->id = $id;
        $this->affiche = $affiche;
        $this->dateCreation = $dateCreation;
        $this->extTypeFichier = $typeFichier;
        $this->nom = $nom;
    }

    /////////////////////
    // GETTERS&SETTERS //
    /////////////////////
    public function setId($id)
    {
        if (is_int($id))
        {
            $this->id = $id;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNom($nom)
    {
        if (is_string($nom))
        {
            $this->nom = $nom;
        }
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setDateCreation($dateCreation)
    {
        if (is_a($dateCreation, "Date"))
        {
            $this->dateCreation = $dateCreation;
        }
    }

    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    public function setAffiche($affiche)
    {
        if (is_bool($affiche))
        {
            $this->affiche = $affiche;
        }
    }

    public function getAffiche()
    {
        return $this->affiche;
    }

    public function setTypeFichier($typeFichier)
    {
        if (is_int($typeFichier))
        {
            $this->extTypeFichier = TypeFichierDAL::findById($typeFichier);
        }
        else if (is_a($typeFichier, "TypeFichier"))
        {
            $this->extTypeFichier = $typeFichier;
        }
    }

    public function getTypeFichier()
    {
        $typeFichier = null;
        if (is_int($this->extTypeFichier))
        {
            $typeFichier = TypeFichierDAL::findById($this->extTypeFichier);
            $this->extTypeFichier = $typeFichier;
        }
        else if (is_a($this->extTypeFichier, "TypeFichier"))
        {
            $typeFichier = $this->extTypeFichier;
        }
        return $typeFichier;
    }

}
