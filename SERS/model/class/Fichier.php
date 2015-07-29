<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/TypeFichierDAL.php');

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
    private $type;

    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////

    public function User($id = -1, $nom = "name file default", $dateCreation = "0000-00-00", $affiche = 1, $type = 1)
    {
        $this->id = $id;
        $this->affiche = $affiche;
        $this->dateCreation = $dateCreation;
        $this->type = $type;
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
        if (is_string($dateCreation))
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

    public function setType($type)
    {
        if (is_int($type))
        {
            $this->type = TypeFichierDAL::findById($type);
        }
        else if (is_a($type, "TypeFichier"))
        {
            $this->type = $type;
        }
    }

    public function getType()
    {
        $type = null;
        if (is_int($this->type))
        {
            $type = TypeFichierDAL::findById($this->type);
            $this->type = $type;
        }
        else if (is_a($this->type, "TypeFichier"))
        {
            $type = $this->type;
        }
        return $type;
    }

    //////////////
    // METHODES //
    //////////////

    protected function hydrate($dataSet)
    {
        $this->id = $dataSet['id'];
        $this->dateCreation = $dataSet['date_creation'];
        $this->affiche = $dataSet['affiche'];
        $this->nom = $dataSet['nom'];
        $this->type = $dataSet['type_fichier_id'];
    }
}
